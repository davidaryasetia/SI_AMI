<?php

namespace App\Http\Controllers\DataAuditorController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class PengisianKinerjaAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil unit yang terkait dengan auditor dari session
        $auditorUnits = collect(session('auditor'))->pluck('units.unit_id')->unique();
        $units = Unit::whereIn('unit_id', $auditorUnits)->orderBy('unit_id')->get();
        $unitId = $request->input('unit_id');

        // Jika unit belum dipilih, kosongkan data_indikator
        if (!$unitId) {
            $data_indikator = null;
            $nama_unit = '-';
        } else {
            // Ambil periode pelaksanaan terbaru
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                return redirect()->back()->with('error', 'Tidak ada periode pelaksanaan yang aktif');
            }

            // Ambil data indikator berdasarkan unit_id dan jadwal_ami_id
            $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

            $data_indikator = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                    $query->where('jadwal_ami_id', $jadwalAmiId);
                }
            ])
                ->where('unit_id', $unitId)
                ->first();

            // Ambil nama unit berdasarkan unitId
            $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
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
        // dump($data_indikator->toArray());
        // Ambil nama unit berdasarkan unitId

        $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        return view('data_auditor.pengisian_kinerja.pengisian_kinerja_auditor', [
            'title' => 'Pengisian Kinerja Auditor',
            'units' => $units,
            'data_indikator' => $data_indikator,
            'unit_id' => $unitId,
            'nama_unit' => $nama_unit,
            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'totalKinerja' => $totalKinerja,
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
