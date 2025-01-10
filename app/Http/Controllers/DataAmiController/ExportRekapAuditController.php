<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExportRekapAuditController extends Controller
{
    public function exportRekapPerUnit(Request $request)
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
        }

        $data_transaksi = collect();
        // Ambil data berdasarkan jadwal_ami_id
        $data_transaksi = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                $query->where('jadwal_ami_id', $selectedJadwalAmiId);
            }
        ])
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();

        $rekapByUnit = $data_transaksi->map(function ($unit) use ($selectedJadwalAmiId) {
            $indikatorId = $unit->indikator_ikuk->pluck('indikator_kinerja_unit_kerja_id');

            $melampauiTarget = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->where('hasil_audit', 'Melampaui')
                ->count();

            $memenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->where('hasil_audit', 'Memenuhi')
                ->count();

            $belumMemenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->where('hasil_audit', 'Belum Memenuhi')
                ->count();

            $belumMengisi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->where('hasil_audit', NULL)
                ->count();

            return [
                'nama_unit' => $unit->nama_unit,
                'melampauiTarget' => $melampauiTarget,
                'memenuhi' => $memenuhi,
                'belumMemenuhi' => $belumMemenuhi,
                'belumMengisi' => $belumMengisi,
                'totalDataIkuk' => $melampauiTarget + $memenuhi + $belumMemenuhi + $belumMengisi,
            ];
        });

        // Membuat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $periode = PeriodePelaksanaan::find($selectedJadwalAmiId);
        if ($periode) {
            $nama_periode = $periode->nama_periode_ami;
        } else {
            $nama_periode = '-';
        }
        $sheet = $spreadsheet->getActiveSheet();

        // Header Utama
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'Rekap Audit Unit - Periode ' . $nama_periode);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Header Kolom
        $headers = ['No', 'Unit', 'Total Indikator', 'Melampaui', 'Memenuhi', 'Belum Memenuhi', 'Belum Mengisi'];
        $columnIndex = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '2', $header);
            $sheet->getStyle($columnIndex . '2')->getFont()->setBold(true)->setSize(12);
            $sheet->getStyle($columnIndex . '2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getColumnDimension($columnIndex)->setAutoSize(true);
            $columnIndex++;
        }

        // Styling Warna Header Kolom
        $sheet->getStyle('A2:G2')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFCCE5FF'); // Warna biru muda

        // Border untuk Header
        $sheet->getStyle('A2:G2')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Isi Data
        $rowIndex = 3;
        foreach ($rekapByUnit as $index => $data) {
            $sheet->setCellValue('A' . $rowIndex, $index + 1);
            $sheet->setCellValue('B' . $rowIndex, $data['nama_unit']);
            $sheet->setCellValue('C' . $rowIndex, $data['totalDataIkuk']);
            $sheet->setCellValue('D' . $rowIndex, $data['melampauiTarget']);
            $sheet->setCellValue('E' . $rowIndex, $data['memenuhi']);
            $sheet->setCellValue('F' . $rowIndex, $data['belumMemenuhi']);
            $sheet->setCellValue('G' . $rowIndex, $data['belumMengisi']);
            $rowIndex++;
        }

        // Border untuk Isi Data
        $sheet->getStyle('A3:G' . ($rowIndex - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Atur Nama File

        $fileName = 'Rekap Audit Unit - Periode AMI ' . $nama_periode . '.xlsx';

        // Kirim File ke Browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    public function exportRekapPerIndikator(Request $request)
    {
        $jadwalAmiId = $request->query('jadwal_ami_id');

        if (!$jadwalAmiId) {
            return redirect()->to('/rekap_audit')->with('error', 'Silakan pilih Periode AMI terlebih dahulu.');
        }

        $indikatorIkuk = IndikatorKinerjaUnitKerja::with([
            'transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])
        ->where('jadwal_ami_id', $jadwalAmiId)
        ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Kolom
        $headers = ['No', 'Kode Ikuk', 'Indikator IKUK', 'Target 1', 'Target 2', 'Link', 'Tipe', 'Realisasi', 'Analisis Tindak Lanjut'];
        $columnWidths = [5, 10, 50, 10, 10, 10, 10, 10, 50]; // Atur lebar kolom secara manual

        $columnIndex = 'A';
        foreach ($headers as $index => $header) {
            $sheet->setCellValue($columnIndex . '1', $header);

            // Styling Header
            $sheet->getStyle($columnIndex . '1')->applyFromArray([
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4CAF50']],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);

            // Set Width for Columns
            $sheet->getColumnDimension($columnIndex)->setWidth($columnWidths[$index]);
            $columnIndex++;
        }

        // Isi Data
        $rowIndex = 2;
        foreach ($indikatorIkuk as $index => $indikator) {
            $sheet->setCellValue('A' . $rowIndex, $index + 1); // Nomor
            $sheet->setCellValue('B' . $rowIndex, $indikator->kode_ikuk); // Kode IKUK
            $sheet->setCellValue('C' . $rowIndex, $indikator->isi_indikator_kinerja_unit_kerja); // Indikator
            $sheet->setCellValue('D' . $rowIndex, $indikator->target1); // Target
            $sheet->setCellValue('E' . $rowIndex, $indikator->target2); // Target
            $sheet->setCellValue('F' . $rowIndex, $indikator->link); // Target
            $sheet->setCellValue('G' . $rowIndex, $indikator->tipe); // Target
            $sheet->setCellValue('H' . $rowIndex, $indikator->transaksiDataIkuk->first()->realisasi_ikuk ?? '-'); // Capaian
            $sheet->setCellValue('I' . $rowIndex, $indikator->transaksiDataIkuk->first()->tindak_lanjut ?? '-'); // Analisis

            // Apply Wrapping Text untuk kolom tertentu
            $sheet->getStyle('C' . $rowIndex)->getAlignment()->setWrapText(true);
            $sheet->getStyle('F' . $rowIndex)->getAlignment()->setWrapText(true);

            $rowIndex++;
        }

        // Apply Border untuk Data
        $sheet->getStyle('A2:I' . ($rowIndex - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Set Row Height Auto
        $sheet->getDefaultRowDimension()->setRowHeight(-1); // Auto height

        // Nama File
        $fileName = "Rekap_Audit_Indikator_Per_" . now()->format('Ymd_His') . ".xlsx";

        // Kirim File ke Browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

}
