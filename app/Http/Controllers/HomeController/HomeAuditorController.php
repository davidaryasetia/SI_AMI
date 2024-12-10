<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class HomeAuditorController extends Controller
{
    public function HomeAuditor(Request $request)
    {
        // -------------------------------Logic Untuk Mendapatkan data periode Terbaru-----------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        // Jika tidak ada periode berjalan, ambil periode terakhir jika ada
        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }
        // Jika tidak ada periode  sama sekali, set data default
        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


        // -----------------------------Data Untuk Mendapatkan hasil Unit Yang Di Audit----------------------------------
        $auditorUnits = collect(session('auditor'))->pluck('units.unit_id')->unique();
        $units = Unit::whereIn('unit_id', values: $auditorUnits)->orderBy('unit_id')->get();
        $userId = session('user_id');
        $dataIndikator = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])
            ->whereIn('unit_id', $auditorUnits) // Filter berdasarkan unit_id dari session auditor
            ->get();

        $dataTransaksi = $dataIndikator->map(function ($unit) use ($userId) {
            $totalIndikator = $unit->indikator_ikuk->count();
            $filledIndikator = $unit->indikator_ikuk->filter(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
            })->count();
            $persentase = $totalIndikator > 0 ? round(($filledIndikator / $totalIndikator) * 100, 2) : 0;

            $isKetuaAuditor = false;
            $isAnggotaAuditor = false;

            // Periksa apakah user adalah auditor1 (ketua auditor)
            if (isset($unit->auditor->auditor1) && $unit->auditor->auditor1->user_id == $userId) {
                $isKetuaAuditor = true;
            }

            // Periksa apakah user adalah auditor2 (anggota auditor)
            if (isset($unit->auditor->auditor2) && $unit->auditor->auditor2->user_id == $userId) {
            $isAnggotaAuditor = true;
            }

            
            $statusFinalisasiAudite = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
            });

            return [
                'unit_id' => $unit->unit_id,
                'nama_unit' => $unit->nama_unit,
                'is_ketua_auditor' => $isKetuaAuditor,
                'is_anggota_auditor' => $isAnggotaAuditor,
                'totalIndikator' => $totalIndikator, 
                'filledIndikator'=> $filledIndikator,
                'persentase' => $persentase, 
                'auditor1' => $unit->auditor->auditor1->nama ?? null,
                'auditor2' => $unit->auditor->auditor2->nama ?? null,
                'statusFinalisasiAudite' => $statusFinalisasiAudite, 
            ];
        });

        // dump($dataTransaksi->toArray());



        // -----------------------------------Logic untuk mendapatkan data statistic periode--------------------------------
        $unitId = $request->input('unit_id');
        $data_indikator = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])
            ->where('unit_id', $unitId)
            ->first();

        // Ambil nama unit berdasarkan unitId
        if ($unitId) {
            $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        } else {
            $nama_unit = "- [ Pilih Unit Kerja Terlebih Dahulu ]";
        }

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
        $totalCapaian = $melampauiTarget + $memenuhi + $belumMemenuhi;
        $persentaseMelampaui = $totalCapaian > 0 ? round(($melampauiTarget / $totalCapaian) * 100, 2) : 0;
        $persentaseMemenuhi = $totalCapaian > 0 ? round(($memenuhi / $totalCapaian) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalCapaian > 0 ? round(($belumMemenuhi / $totalCapaian) * 100, 2) : 0;

        return view('data_auditor.home_auditor.beranda', [
            'title' => 'Auditor',
            'current_periode' => $periodeTerbaru,
            'dataTransaksi' => $dataTransaksi, 
            'nama_unit' => $nama_unit,
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
