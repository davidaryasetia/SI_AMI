<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportRiwayatController extends Controller
{
    public function export(Request $request)
    {
        $selectedJadwalAmiId = $request->query('jadwal_ami_id');
        $selectedUnitId = $request->query('unit_id');

        if (!$selectedJadwalAmiId) {
            return redirect()->route('riwayat.index')->with('error', 'Pilih periode AMI terlebih dahulu.');
        }

        $periode = PeriodePelaksanaan::find($selectedJadwalAmiId);
        if ($periode) {
            $nama_periode = $periode->nama_periode_ami;
            $tanggal_pembukaan_ami = Carbon::parse($periode->tanggal_pembukaan_ami)->format('d F Y');
            $tanggal_penutupan_ami = Carbon::parse($periode->tanggal_penutupan_ami)->format('d F Y');
        } else {
            $nama_periode = '-';
            $tanggal_pembukaan_ami = '-';
            $tanggal_penutupan_ami = '-';
        }

        $unit = Unit::find($selectedUnitId);
        if ($unit) {
            $nama_unit = $unit->nama_unit;
        } else {
            $nama_unit = '-';
        }

        $spreadsheet = new Spreadsheet();

        // Export untuk semua unit
        if ($selectedUnitId == 'all') {
            $units = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                    $query->where('jadwal_ami_id', $selectedJadwalAmiId);
                }
            ])->get();

            foreach ($units as $index => $unit) {
                $sheet = ($index == 0) ? $spreadsheet->getActiveSheet() : $spreadsheet->createSheet();
                $this->generateSheet($sheet, $unit);
            }
        } else {
            $unit = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                    $query->where('jadwal_ami_id', $selectedJadwalAmiId);
                }
            ])->find($selectedUnitId);

            if (!$unit) {
                return redirect()->route('riwayat.index')->with('error', 'Pilih Data Unit Terlebih Dahulu !!');
            }

            $sheet = $spreadsheet->getActiveSheet();
            $this->generateSheet($sheet, $unit);
        }

        if ($selectedUnitId == 'all') {
            // Set nama file
            $fileName = 'Riwayat_Progress_Kinerja_' . $nama_periode . " - $tanggal_pembukaan_ami sd $tanggal_penutupan_ami - Seluruh Unit" . '.xlsx';
        } else {
            // Set nama file
            $fileName = 'Riwayat_Progress_Kinerja_' . $nama_unit . " - $tanggal_pembukaan_ami sd $tanggal_penutupan_ami" . '.xlsx';
        }

        // Kirim file ke browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }

    private function generateSheet($sheet, $unit)
    {
        $headers = [
            'No',
            'Kode IKUK',
            'Indikator Kinerja',
            'Target',
            'Capaian',
            'Status Capaian',
            'Analisis Keberhasilan',
            'Usulan Target Tahun Depan',
            'Strategi Pencapaian',
            'Sarpras yang Dibutuhkan',
            'Faktor Pendukung',
            'Faktor Penghambat',
            'Akar Masalah',
            'Tindak Lanjut',
            'Data Dukungan'
        ];

        $columnWidths = [
            5,
            12,
            50,
            10,
            10,
            15,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            30,
            30
        ];

        // Judul
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue('A1', 'Riwayat Progress Capaian Kinerja Unit ' . $unit->nama_unit);
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Header
        $columnIndex = 'A';
        foreach ($headers as $key => $header) {
            $sheet->setCellValue($columnIndex . '2', $header);
            $sheet->getStyle($columnIndex . '2')->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4CAF50']],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            ]);
            $sheet->getColumnDimension($columnIndex)->setWidth($columnWidths[$key]);
            $columnIndex++;
        }

        // Tambahkan data
        $rowIndex = 3;
        $no = 1;

        foreach ($unit->indikator_ikuk as $indikator) {
            foreach ($indikator->transaksiDataIkuk as $transaksi) {
                $statusCapaian = 'Belum Memenuhi';
                if ($transaksi->realisasi_ikuk > $indikator->target_ikuk) {
                    $statusCapaian = 'Melampaui';
                } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk) {
                    $statusCapaian = 'Memenuhi';
                }

                $sheet->setCellValue('A' . $rowIndex, $no++);
                $sheet->setCellValue('B' . $rowIndex, $indikator->kode_ikuk);
                $sheet->setCellValue('C' . $rowIndex, $indikator->isi_indikator_kinerja_unit_kerja);
                $sheet->setCellValue('D' . $rowIndex, $indikator->target_ikuk);
                $sheet->setCellValue('E' . $rowIndex, $transaksi->realisasi_ikuk ?? '-');
                $sheet->setCellValue('F' . $rowIndex, $statusCapaian);
                $sheet->setCellValue('G' . $rowIndex, $transaksi->analisis_keberhasilan ?? '-');
                $sheet->setCellValue('H' . $rowIndex, $transaksi->usulan_target_tahun_depan ?? '-');
                $sheet->setCellValue('I' . $rowIndex, $transaksi->strategi_pencapaian ?? '-');
                $sheet->setCellValue('J' . $rowIndex, $transaksi->sarpras_yang_dibutuhkan ?? '-');
                $sheet->setCellValue('K' . $rowIndex, $transaksi->faktor_pendukung ?? '-');
                $sheet->setCellValue('L' . $rowIndex, $transaksi->faktor_penghambat ?? '-');
                $sheet->setCellValue('M' . $rowIndex, $transaksi->akar_masalah ?? '-');
                $sheet->setCellValue('N' . $rowIndex, $transaksi->tindak_lanjut ?? '-');
                $sheet->setCellValue('O' . $rowIndex, $transaksi->data_dukungan ?? '-');

                // Wrap text untuk kolom tertentu
                $sheet->getStyle('C' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setWrapText(true);
                $sheet->getStyle('A' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $rowIndex++;
            }
        }

        // Styling border
        $sheet->getStyle('A3:O' . ($rowIndex - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Ubah nama tab
        $sheet->setTitle($unit->nama_unit);
    }
}
