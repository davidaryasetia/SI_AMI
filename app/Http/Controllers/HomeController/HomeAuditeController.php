<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeAuditeController extends Controller
{
    public function HomeAudite()
    {
        // Mendapatkan unit_id dari session audite
        $unitId = session('audite.unit.unit_id');
        $nama_unit = session('audite.unit.nama_unit');

        $auditor1 = null;
        $auditor2 = null;

        // Mendapatkan data Auditor
        $auditorData = Auditor::where('unit_id', $unitId)->first();

        if ($auditorData) {
            $auditor_1 = User::find($auditorData->auditor_1);
            $auditor_2 = User::find($auditorData->auditor_2);

            $auditor1 = $auditor_1 ? $auditor_1->nama : null;
            $auditor2 = $auditor_2 ? $auditor_2->nama : null;
        }

        // Mendapatkan data Jadwal Pelaksanaan yang sedang berjalan terakhir
        $currentPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        // Jika tidak ada periode berjalan, ambil periode terakhir (jika ada)
        if (!$currentPeriode) {
            $currentPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        // Jika tidak ada periode sama sekali, set data default
        $jadwalAmiId = $currentPeriode ? $currentPeriode->jadwal_ami_id : null;

        // Mendapatkan data indikator
        $data_indikator = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                if ($jadwalAmiId) {
                    $query->where('jadwal_ami_id', $jadwalAmiId);
                }
            }
        ])->where('unit_id', $unitId)->first();

        // Inisialisasi variabel untuk menghitung capaian
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;

        if ($data_indikator && $data_indikator->indikator_ikuk) {
            foreach ($data_indikator->indikator_ikuk as $indikator) {
                if ($indikator->transaksiDataIkuk) {
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
        }

        // Hitung total capaian dan persentase
        $totalCapaian = $melampauiTarget + $memenuhi + $belumMemenuhi;
        $persentaseMelampaui = $totalCapaian > 0 ? round(($melampauiTarget / $totalCapaian) * 100, 2) : 0;
        $persentaseMemenuhi = $totalCapaian > 0 ? round(($memenuhi / $totalCapaian) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalCapaian > 0 ? round(($belumMemenuhi / $totalCapaian) * 100, 2) : 0;

        // Return ke view dengan data
        return view('data_audite.home_audite.beranda', [
            'title' => 'Audite',
            'current_periode' => $currentPeriode,
            'auditor1' => $auditor1,
            'auditor2' => $auditor2,
            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'totalCapaian' => $totalCapaian,
            'persentaseMelampaui' => $persentaseMelampaui,
            'persentaseMemenuhi' => $persentaseMemenuhi,
            'persentaseBelumMemenuhi' => $persentaseBelumMemenuhi,
        ]);
    }

}
