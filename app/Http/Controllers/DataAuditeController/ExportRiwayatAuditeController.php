<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
class ExportRiwayatAuditeController extends Controller
{
    public function exportRiwayatAudite(Request $request)
    {
        $jadwalAmiId = $request->query('jadwal_ami_id');

        // Validasi input
        if (!$jadwalAmiId) {
            return redirect()->route('riwayat_audite.index')->with('error', 'Pilih jadwal AMI terlebih dahulu.');
        }

        $unitId = session('audite.unit.unit_id');
        $unit = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])->find($unitId);

        if (!$unit) {
            return redirect()->route('riwayat_audite.index')->with('error', 'Data unit tidak ditemukan.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set nama worksheet sesuai unit
        $sheet->setTitle($unit->nama_unit);

        // Header Excel
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

        // Set lebar kolom manual
        $columnWidths = [
            5,  // No
            12, // Kode IKUK
            50, // Indikator Kinerja
            10, // Target
            10, // Capaian
            15, // Status Capaian
            30, // Analisis Keberhasilan
            30, // Usulan Target Tahun Depan
            30, // Strategi Pencapaian
            30, // Sarpras yang Dibutuhkan
            30, // Faktor Pendukung
            30, // Faktor Penghambat
            30, // Akar Masalah
            30, // Tindak Lanjut
            30  // Data Dukungan
        ];

        // Tambahkan judul
        $sheet->mergeCells('A1:O1');
        $sheet->setCellValue('A1', 'Riwayat Progress Capaian Kinerja Unit ' . $unit->nama_unit);
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ]);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Tambahkan header
        $columnIndex = 'A';
        foreach ($headers as $key => $header) {
            $sheet->setCellValue($columnIndex . '2', $header);
            $sheet->getStyle($columnIndex . '2')->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
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

                // Wrap text and align vertically
                $sheet->getStyle('C' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setWrapText(true);
                $sheet->getStyle('A' . $rowIndex . ':O' . $rowIndex)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $rowIndex++;
            }
        }

        // Apply border styling for data
        $sheet->getStyle('A3:O' . ($rowIndex - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Set nama file
        $fileName = 'Riwayat_Progress_Kinerja_Unit_' . $unit->nama_unit . '_' . now()->format('Ymd_His') . '.xlsx';

        // Kirim file ke browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }


}
