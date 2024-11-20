<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Ambil jadwal periode 
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
        $units = Unit::orderBy('nama_unit')->get();

        // Ambil Nilai dari dropdown
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');
        $selectedUnitId = $request->input('unit_id');

        if (!$selectedJadwalAmiId || $selectedUnitId) {
            $data_indikator = null;
            $nama_unit = '-';
        } else {
            $data_indikator = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($selectedJadwalAmiId) {
                    $query->where('jadwal_ami_id', $selectedJadwalAmiId);
                }
            ])->where('unit_id', $selectedUnitId)
                ->first();

            $nama_unit = $units->where('unit_id', $selectedUnitId)->first()->nama_unit ?? '-';

        }

        // Hitung jumlah berdasarkan kondisi
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;

        if ($data_indikator) {
            foreach ($data_indikator->indikator_ikuk as $indikator) {
                foreach ($indikator->transaksiDataIkuk as $transaksi) {
                    if ($transaksi->realisasi_ikuk > $indikator->target_ikuk) {
                        $melampauiTarget++;
                    } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk) {
                        $memenuhi++;
                    } elseif ($transaksi->realisasi_ikuk < $indikator->target_ikuk) {
                        $belumMemenuhi++;
                    }
                }
            }
        }

        $totalKinerja = $melampauiTarget + $memenuhi + $belumMemenuhi;
       
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
            'totalKinerja' => $totalKinerja,
        ]);
    }
}
