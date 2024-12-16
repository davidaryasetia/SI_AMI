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
        $unitId = session('audite.unit_id');
        $nama_unit = session('audite.unit.nama_unit');
        // dump(session()->all());
        $auditor1 = null;
        $auditor2 = null;

        // Mendapatkan data Auditor
        $auditorData = Auditor::where('unit_id', $unitId)->first();
        if ($auditorData) {
            $auditor_1 = User::find($auditorData->auditor_1);
            $auditor_2 = User::find($auditorData->auditor_2);

            $auditor1 = $auditor_1 ? $auditor_1->nama : 'Auditor 1 Belum di set!';
            $auditor2 = $auditor_2 ? $auditor_2->nama : 'Auditor 2 Belum di set!';
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

        if (!$jadwalAmiId) {
            // Jika tidak ada jadwal, tetap kembalikan view dengan data kosong
            return view('data_audite.home_audite.beranda', [
                'title' => 'Audite',
                'current_periode' => '',
                'auditor1' => [
                    'nama' => $auditor1,
                    'status' => 'Ketua Auditor',
                    'status_finalisasi' => 'Belum Finalisasi',
                ],
                'auditor2' => [
                    'nama' => $auditor2,
                    'status' => 'Anggota Auditor',
                    'status_finalisasi' => 'Belum Finalisasi',
                ],
                'melampauiTarget' => 0,
                'memenuhi' => 0,
                'belumMemenuhi' => 0,
                'totalCapaian' => 0,
                'persentaseMelampaui' => 0,
                'persentaseMemenuhi' => 0,
                'persentaseBelumMemenuhi' => 0,
                'persentase_audite' => 0,
                'totalIndikator' => 0,
                'filledIndikator' => 0,
            ]);
        }

        // Mengambil data unit dan relasi terkait
        $dataUnit = Unit::with([
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])
        ->where('jadwal_ami_id', $jadwalAmiId)
        ->where('unit_id', $unitId)
        ->first();

        if (!$dataUnit) {
            return view('data_audite.home_audite.beranda', [
                'title' => 'Audite',
                'current_periode' => $currentPeriode,
                'auditor1' => [
                    'nama' => $auditor1,
                    'status' => 'Ketua Auditor',
                    'status_finalisasi' => false ,
                ],
                'auditor2' => [
                    'nama' => $auditor2,
                    'status' => 'Anggota Auditor',
                    'status_finalisasi' => false ,
                ],
                'melampauiTarget' => 0,
                'memenuhi' => 0,
                'belumMemenuhi' => 0,
                'totalCapaian' => 0,
                'persentaseMelampaui' => 0,
                'persentaseMemenuhi' => 0,
                'persentaseBelumMemenuhi' => 0,
                'persentase_audite' => 0,
                'totalIndikator' => 0,
                'filledIndikator' => 0,
            ]);
        }


        // Hitung persentase pengisian dan status finalisasi
        $totalIndikator = $dataUnit->indikator_ikuk->count();
        $filledIndikator = $dataUnit->indikator_ikuk->filter(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
        })->count();

        $persentase = $totalIndikator > 0 ? round(($filledIndikator / $totalIndikator) * 100, 2) : 0;

        // Status Finalisasi Audite, Auditor1, dan Auditor2
        $statusFinalisasiAuditor1 = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
        });

        $statusFinalisasiAuditor2 = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
        });

        $statusFinalisasiAudite = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
        });

        // Inisialisasi variabel untuk menghitung capaian
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;

        foreach ($dataUnit->indikator_ikuk as $indikator) {
            foreach ($indikator->transaksiDataIkuk as $transaksi) {
                if ($transaksi->realisasi_ikuk > $indikator->target_ikuk) {
                    $melampauiTarget++;
                } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk) {
                    $memenuhi++;
                } else {
                    $belumMemenuhi++;
                }
            }
        }
        // dump($statusFinalisasiAudite);
        // dump($dataUnit);

        // Hitung total capaian dan persentase
        $totalCapaian = $melampauiTarget + $memenuhi + $belumMemenuhi;
        $persentaseMelampaui = $totalCapaian > 0 ? round(($melampauiTarget / $totalCapaian) * 100, 2) : 0;
        $persentaseMemenuhi = $totalCapaian > 0 ? round(($memenuhi / $totalCapaian) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalCapaian > 0 ? round(($belumMemenuhi / $totalCapaian) * 100, 2) : 0;
        // dump($persentase);
        return view('data_audite.home_audite.beranda', [
            'title' => 'Audite',
            'current_periode' => $currentPeriode,
            'auditor1' => [
                'nama' => $auditor1,
                'status' => 'Ketua Auditor',
                'status_finalisasi' => $statusFinalisasiAuditor1 ? true : false,
            ],
            'auditor2' => [
                'nama' => $auditor2,
                'status' => 'Anggota Auditor',
                'status_finalisasi' => $statusFinalisasiAuditor2 ? true : false,
            ],
            'statusFinalisasiAudite' => $statusFinalisasiAudite, 
            
            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'totalCapaian' => $totalCapaian,
            'persentaseMelampaui' => $persentaseMelampaui,
            'persentaseMemenuhi' => $persentaseMemenuhi,
            'persentaseBelumMemenuhi' => $persentaseBelumMemenuhi,
            'persentase_audite' => $persentase,
            'totalIndikator' => $totalIndikator,
            'filledIndikator' => $filledIndikator,
        ]);
    }


}
