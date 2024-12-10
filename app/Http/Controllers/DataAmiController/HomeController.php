<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil periode yang sedang berjalan 
        $currentPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$currentPeriode) {
            $currentPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $jadwalAmiId = $currentPeriode->jadwal_ami_id;

        // Ambil data unit dengan relasi untuk audite, auditor, dan transaksi data
        $dataIndikator = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])
        ->get();

        // Hitung persentase pengisian untuk setiap unit
        $dataPengisian = collect(); // Default sebagai collection kosong

        if ($jadwalAmiId) {
            $dataPengisian = $dataIndikator->map(function ($unit) {
                $totalIndikator = $unit->indikator_ikuk->count();
                $filledIndikator = $unit->indikator_ikuk->filter(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
                })->count();

                $persentase = $totalIndikator > 0 ? round(($filledIndikator / $totalIndikator) * 100, 2) : 0;

                $statusFinalisasiAuditor1 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
                });

                $statusFinalisasiAuditor2 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
                });

                $statusFinalisasiAudite = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
                });

                return [
                    'nama_unit' => $unit->nama_unit,
                    'audite' => $unit->audite[0]['user_audite']['nama'] ?? null,
                    'auditor1' => $unit->auditor->auditor1->nama ?? null,
                    'auditor2' => $unit->auditor->auditor2->nama ?? null,
                    'persentase_audite' => $persentase,
                    'status_finalisasi_audite' => $statusFinalisasiAudite,
                    'status_finalisasi_auditor1' => $statusFinalisasiAuditor1,
                    'status_finalisasi_auditor2' => $statusFinalisasiAuditor2,
                ];
            });


        } else {
            $dataPengisian = collect();
        }

        // dump($dataPengisian->toArray());
        // dump($data_unit->toArray());
        return view('data_ami.home_admin.beranda', [
            'title' => 'Home',
            'current_periode' => $currentPeriode,
            'dataPengisian' => $dataPengisian,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
