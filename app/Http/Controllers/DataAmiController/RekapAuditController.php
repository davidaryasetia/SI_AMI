<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RekapAuditController extends Controller
{
    public function index(Request $request)
    {
        // -------------------------------- Logic untuk Mendapatkan periode Terbaru------------------
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
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
        if ($selectedJadwalAmiId) {
            $data_transaksi = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                    $query->where('jadwal_ami_id', $selectedJadwalAmiId);
                }
            ])
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->get();
        }

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
                'unit_id' => $unit->unit_id,
                'nama_unit' => $unit->nama_unit,
                'melampauiTarget' => $melampauiTarget,
                'memenuhi' => $memenuhi,
                'belumMemenuhi' => $belumMemenuhi,
                'belumMengisi' => $belumMengisi,
                'totalDataIkuk' => $melampauiTarget + $memenuhi + $belumMemenuhi + $belumMengisi,
                'indikator_ikuk' => $unit->indikator_ikuk->map(function ($indikator) {
                    return [
                        'kode_ikuk' => $indikator->kode_ikuk,
                        'isi_indikator_kinerja_unit_kerja' => $indikator->isi_indikator_kinerja_unit_kerja,
                        'target1' => $indikator->target1,
                        'target2' => $indikator->target2,
                        'link' => $indikator->link,
                        'tipe' => $indikator->tipe,
                        'transaksi' => $indikator->transaksiDataIkuk->first(),
                    ];
                })
            ];
        });
        // dump($data_transaksi->pluck('indikator_ikuk')->flatten()->toArray());
        // dump($rekapByUnit->toArray());
        return view('data_ami.rekap_audit.rekap', [
            'jadwalPeriode' => $jadwalPeriode,
            'dataTransaksi' => $data_transaksi,
            'indikatorIkuk' => $data_transaksi->pluck('indikator_ikuk')->flatten(),
            'jadwal_ami_id' => $selectedJadwalAmiId,
            'rekapByUnit' => $rekapByUnit,
        ]);
    }

    public function export(Request $request)
    {
        $jadwalAmiId = $request->query('jadwal_ami_id');

        if (!$jadwalAmiId) {
            return redirect()->route('rekap_audit.index')->with('error', 'Silakan pilih Periode AMI terlebih dahulu.');
        }

        // Ambil data berdasarkan jadwal_ami_id
        $data_transaksi = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])->get();

        $rekapByUnit = $data_transaksi->map(function ($unit) use ($jadwalAmiId) {
            $indikatorId = $unit->indikator_ikuk->pluck('indikator_kinerja_unit_kerja_id');

            $melampauiTarget = 0;
            $memenuhi = 0;
            $belumMemenuhi = 0;
            $belumMengisi = 0;

            $melampauiTarget = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->where('hasil_audit', 'Melampaui')
                ->count();

            $memenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->where('hasil_audit', 'Memenuhi')
                ->count();

            $belumMemenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->where('hasil_audit', 'Belum Memenuhi')
                ->count();

            $belumMengisi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->where('hasil_audit', NULL)
                ->count();

            return [
                'nama_unit' => $unit->nama_unit,
                'totalDataIkuk' => $melampauiTarget + $memenuhi + $belumMemenuhi,
                'melampauiTarget' => $melampauiTarget,
                'memenuhi' => $memenuhi,
                'belumMemenuhi' => $belumMemenuhi,
                'belumMengisi' => $belumMengisi,
            ];
        });

        // Membuat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Kolom
        $headers = ['No', 'Unit', 'Total Indikator', 'Melampaui', 'Memenuhi', 'Belum Memenuhi', 'Belum Mengisi'];
        $columnIndex = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '1', $header);
            $columnIndex++;
        }

        // Isi Data
        $rowIndex = 2;
        foreach ($rekapByUnit as $index => $data) {
            $sheet->setCellValue('A' . $rowIndex, $index + 1);
            $sheet->setCellValue('B' . $rowIndex, $data['nama_unit']);
            $sheet->setCellValue('C' . $rowIndex, $data['totalDataIkuk']);
            $sheet->setCellValue('F' . $rowIndex, $data['melampauiTarget']);
            $sheet->setCellValue('E' . $rowIndex, $data['memenuhi']);
            $sheet->setCellValue('D' . $rowIndex, $data['belumMemenuhi']);
            $sheet->setCellValue('D' . $rowIndex, $data['belumMengisi']);
            $rowIndex++;
        }

        // Atur Nama File
        $fileName = 'Rekap_Audit_AMI_Per_' . now()->format('Ymd_His') . '.xlsx';

        // Kirim File ke Browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

}
