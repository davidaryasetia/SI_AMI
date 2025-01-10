<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // -------------------------------- Logic untuk Mendapatkan periode Terbaru------------------
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');
        $selectedUnitId = $request->query('unit_id');

        // jika tidak ada request data dari dropdown
        if (!$selectedJadwalAmiId) {
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();


            // Jika tidak ada periode yang "Sedang Berjalan", cari periode terakhir (status apa saja)
            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
        }


        $units = Unit::orderBy('unit_id', 'asc')
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();


        if (!$selectedJadwalAmiId || !$selectedUnitId) {
            // Jika salah satu parameter tidak ada, tampilkan halaman kosong
            $data_indikator = null;
            $nama_unit = '-';
        } else {
            // Ambil data indikator berdasarkan unit_id dan jadwal_ami_id
            $data_indikator = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                    $query->where('jadwal_ami_id', $selectedJadwalAmiId);
                }
            ])->where('unit_id', $selectedUnitId)
                ->first();

            $nama_unit = $units->where('unit_id', $selectedUnitId)->first()->nama_unit ?? '-';
        }

        // Hitung jumlah indikator berdasarkan kondisi (opsional)
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;
        $belumMengisi = 0;

        // Get Data Indikator Id 
        $indikatorId = $data_indikator && $data_indikator->indikator_ikuk ? $data_indikator->indikator_ikuk->pluck('indikator_kinerja_unit_kerja_id') : collect() ;

        $melampauiTarget = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->where('hasil_audit', 'Melampaui')
            ->count();

        $memenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
            ->where('jadwal_ami_id', $selectedUnitId)
            ->where('hasil_audit', 'Memenuhi')
            ->count();

        $belumMemenuhi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->where('hasil_audit', 'belumMemenuhi')
            ->count();

        $belumMengisi = TransaksiData::whereIn('indikator_kinerja_unit_kerja_id', $indikatorId)
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->where('hasil_audit', NULL)
            ->count();

        $totalKinerja = $melampauiTarget + $memenuhi + $belumMemenuhi + $belumMengisi;
        $persentaseMelampaui = $totalKinerja > 0 ? round(($melampauiTarget / $totalKinerja) * 100, 2) : 0;
        $persentaseMemenuhi = $totalKinerja > 0 ? round(($memenuhi / $totalKinerja) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalKinerja > 0 ? round(($belumMemenuhi / $totalKinerja) * 100, 2) : 0;

        return view('data_ami.riwayat.riwayat', [
            'title' => 'Riwayat Data Unit',
            'jadwalPeriode' => $jadwalPeriode,
            'units' => $units,
            'data_indikator' => $data_indikator,
            'selectedJadwalAmiId' => $selectedJadwalAmiId,
            'selectedUnitId' => $selectedUnitId,
            'nama_unit' => $nama_unit,
            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'belumMengisi' => $belumMengisi, 
            'totalKinerja' => $totalKinerja,
            'persentaseMelampaui' => $persentaseMelampaui,
            'persentaseMemenuhi' => $persentaseMemenuhi,
            'persentaseBelumMemenuhi' => $persentaseBelumMemenuhi,
        ]);
    }
}
