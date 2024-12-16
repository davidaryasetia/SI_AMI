<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class RiwayatAuditeController extends Controller
{
    public function index(Request $request)
    {
        // dump(session()->all());
        // Ambil data dropdown
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
        $unitId = session('audite.unit_id');
        $units = Unit::orderBy('nama_unit')->get();

        // Ambil nilai parameter dari query string
        $jadwalAmiId = $request->query('jadwal_ami_id');
        if ($jadwalAmiId) {
            $jadwalAmi = PeriodePelaksanaan::find($jadwalAmiId);

            if (!$jadwalAmi) {
                return redirect()->route('riwayat_audite.index')->with('error', 'Jadwal AMI Pada Periode Tersebut Tidak Ditemukan, silahkan pilih jadwal yang tersedia.');
            }
        }

        $data_indikator = null;
        if ($jadwalAmiId) {
            $data_indikator = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                    $query->where('jadwal_ami_id', $jadwalAmiId);
                }
            ])
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->where('unit_id', $unitId)->first();

        }
        $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        // dump($data_indikator->toArray());

        // Hitung jumlah indikator berdasarkan kondisi (opsional)
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
        $persentaseMelampaui = $totalKinerja > 0 ? round(($melampauiTarget / $totalKinerja) * 100, 2) : 0;
        $persentaseMemenuhi = $totalKinerja > 0 ? round(($memenuhi / $totalKinerja) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalKinerja > 0 ? round(($belumMemenuhi / $totalKinerja) * 100, 2) : 0;

        return view('data_audite.riwayat_audite.riwayat_audite', [
            'jadwalPeriode' => $jadwalPeriode,
            'nama_unit' => $nama_unit,
            'data_indikator' => $data_indikator,
            'jadwalAmiId' => $jadwalAmiId,


            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'totalKinerja' => $totalKinerja,
            'persentaseMelampaui' => $persentaseMelampaui,
            'persentaseMemenuhi' => $persentaseMemenuhi,
            'persentaseBelumMemenuhi' => $persentaseBelumMemenuhi,
        ]);
    }
}
