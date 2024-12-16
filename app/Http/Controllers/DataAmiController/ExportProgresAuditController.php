<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportProgresAuditController extends Controller
{
    public function export(Request $request)
    {
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');

        // jika tidak ada request data dari dropdown
        if (!$selectedJadwalAmiId) {
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
            $selectedNamaPeriode = $periodeTerbaru ? $periodeTerbaru->nama_periode_ami : null;
        }


        // Data dari backend progress audit
        $dataIndikator = Unit::with([
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                $query->where('jadwal_ami_id', $selectedJadwalAmiId);
            }
        ])
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();

        $dataPengisian = $dataIndikator->map(function ($unit) {
            $totalIndikator = $unit->indikator_ikuk->count();
            $filledIndikator = $unit->indikator_ikuk->filter(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
            })->count();

            $persentase = $totalIndikator > 0 ? round(($filledIndikator / $totalIndikator) * 100, 2) : 0;

            $statusFinalisasiAudite = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
            }) ? '✔' : '✖';

            $statusFinalisasiAuditor1 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
            }) ? '✔' : '✖';

            $statusFinalisasiAuditor2 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
            }) ? '✔' : '✖';

            return [
                'nama_unit' => $unit->nama_unit,
                'audite' => ($unit->audite[0]['user_audite']['nama'] ?? 'User Audite Belum di set!') . " $statusFinalisasiAudite",
                'auditor1' => ($unit->auditor->auditor1->nama ?? 'Auditor 1 Belum di set!') . " $statusFinalisasiAuditor1",
                'auditor2' => ($unit->auditor->auditor2->nama ?? 'Auditor 2 Belum di set!') . " $statusFinalisasiAuditor2",
                'persentase_audite' => $persentase . '%',
            ];
        });

        // Membuat file Excel
        $spreadsheet = new Spreadsheet();
        $periode = PeriodePelaksanaan::find($selectedJadwalAmiId);
        if ($periode) {
            $nama_periode = $periode->nama_periode_ami;
        } else {
            $nama_periode = '-';
        }
        $sheet = $spreadsheet->getActiveSheet();

        // Title
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Progres Pengisian Audit');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Header
        $header = ['No', 'Unit', 'Finalisasi Audite', 'Persentase Pengisian Audite', 'Verifikasi Auditor 1', 'Verifikasi Auditor 2'];
        $sheet->fromArray($header, null, 'A2');

        // Styling Header
        $headerStyleArray = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => '4CAF50']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A2:F2')->applyFromArray($headerStyleArray);

        // Isi Data
        $row = 3;
        foreach ($dataPengisian as $index => $data) {
            $sheet->setCellValue("A{$row}", $index + 1)
                ->setCellValue("B{$row}", $data['nama_unit'])
                ->setCellValue("C{$row}", $data['audite'])
                ->setCellValue("D{$row}", $data['persentase_audite'])
                ->setCellValue("E{$row}", $data['auditor1'])
                ->setCellValue("F{$row}", $data['auditor2']);

            // Format warna untuk centang dan silang di kolom status
            $this->applyConditionalFormatting($sheet, "C{$row}");
            $this->applyConditionalFormatting($sheet, "E{$row}");
            $this->applyConditionalFormatting($sheet, "F{$row}");

            $row++;
        }

        // Styling Isi Data
        $dataStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle("A3:F{$row}")->applyFromArray($dataStyleArray);

        // Auto Width untuk Kolom
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Membuat file
        $writer = new Xlsx($spreadsheet);
        $fileName = "Progress_Pengisian_Audit_" . ($nama_periode ?? 'Semua') . ".xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    private function applyConditionalFormatting($sheet, $cell)
    {
        $conditionalStyles = $sheet->getStyle($cell)->getConditionalStyles();

        // Kondisi untuk centang hijau tua
        $conditionalGreen = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
        $conditionalGreen->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CONTAINSTEXT)
            ->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_CONTAINSTEXT)
            ->setText('✔')
            ->getStyle()->getFont()->getColor()->setARGB('006400'); // Hijau tua

        // Kondisi untuk silang merah
        $conditionalRed = new \PhpOffice\PhpSpreadsheet\Style\Conditional();
        $conditionalRed->setConditionType(\PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CONTAINSTEXT)
            ->setOperatorType(\PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_CONTAINSTEXT)
            ->setText('✖')
            ->getStyle()->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $conditionalStyles[] = $conditionalGreen;
        $conditionalStyles[] = $conditionalRed;

        $sheet->getStyle($cell)->setConditionalStyles($conditionalStyles);
    }

}
