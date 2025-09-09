<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExportDataIndikatorController extends Controller
{
    public function export(Request $request)
    {
        $unitId = $request->input('unit_id');
        $jadwalAmiId = $request->input('jadwal_ami_id');

        $spreadsheet = new Spreadsheet();

        if ($unitId && $jadwalAmiId) {
            $this->generateSheet($spreadsheet, $unitId, $jadwalAmiId);
        } else {
            $units = Unit::all();
            foreach ($units as $index => $unit) {
                $sheet = $index === 0 ? $spreadsheet->getActiveSheet() : $spreadsheet->createSheet();
                $sheet->setTitle($unit->nama_unit);
                $this->generateSheet($spreadsheet, $unit->unit_id, $jadwalAmiId, $sheet);
            }
        }

        $fileName = 'Data_Indikator_Unit.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    private function generateSheet($spreadsheet, $unitId, $jadwalAmiId, $sheet = null)
    {
        $data = IndikatorKinerjaUnitKerja::select(
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target1',
            'target2',
            'link',
            'tipe'
        )
            ->where('unit_id', $unitId)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->get();

        if (!$sheet) {
            $sheet = $spreadsheet->getActiveSheet();
        }

        // Tambahkan Logo
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo PENS');
        $drawing->setPath(public_path('assets/images/logos/short-logo.png'));
        $drawing->setHeight(70);
        $drawing->setCoordinates('A1');
        $drawing->setWorksheet($sheet);

        // Judul Laporan
        $sheet->mergeCells('B1:G1');
        $sheet->setCellValue('B1', 'AUDIT MUTU INTERNAL');
        $sheet->mergeCells('B2:G2');
        $sheet->setCellValue('B2', 'POLITEKNIK ELEKTRONIKA NEGERI SURABAYA');
        $sheet->mergeCells('B3:G3');
        $sheet->setCellValue('B3', 'UNIT: ' . Unit::find($unitId)->nama_unit);

        // Style Judul
        $sheet->getStyle('B1:G3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Header Tabel
        $headers = ['Kode', 'Indikator Kinerja Unit Kerja (IKUK)', 'Satuan', 'Target 1', 'Target 2', 'Link', 'Tipe'];
        $sheet->fromArray($headers, NULL, 'A5');

        // Data Tabel
        $sheet->fromArray($data->toArray(), NULL, 'A6');

        // Styling Header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];
        $sheet->getStyle('A5:G5')->applyFromArray($headerStyle);

        // Border Data
        $dataRowCount = count($data) + 5;
        $sheet->getStyle("A5:G{$dataRowCount}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(10);

        // Auto size columns
        $sheet->getStyle('B6:B' . $dataRowCount)->getAlignment()->setWrapText(true);
    }
}
