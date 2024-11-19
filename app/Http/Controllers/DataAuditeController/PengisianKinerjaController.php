<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;

class PengisianKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitId = session('audite.unit.unit_id');

        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->back()->with('error', 'Tidak ada periode pelaksanaan yang aktif');
        }

        // Get Data Indikator 
        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        $data_indikator = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])
            ->where('unit_id', $unitId)
            ->first();


        // dump($data_indikator->toArray());

        // Hitung jumlah data berdasarkan kondisi
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;
        
        foreach ($data_indikator->indikator_ikuk as $indikator){
            foreach ($indikator->transaksiDataIkuk as $transaksi){
                if ($transaksi->realisasi_ikuk > $indikator->target_ikuk){
                    $melampauiTarget++;
                } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk){
                    $memenuhi++;
                } elseif ($transaksi->realisasi_ikuk < $indikator->target_ikuk){
                    $belumMemenuhi++;
                }
            }
        }

        $totalKinerja = $melampauiTarget + $memenuhi + $belumMemenuhi;

        return view('data_audite.pengisian_kinerja.pengisian_kinerja', [
            'title' => 'Pengisian Kinerja',
            'data_indikator' => $data_indikator,
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
        // dd($request->all());
        $request->validate([
            'realisasi_ikuk' => 'nullable|numeric',
            'analisis_usulan_keberhasilan' => 'nullable|string',
            'usulan_target_tahun_depan' => 'nullable|string',
            'strategi_pencapaian' => 'nullable|string',
            'sarpras_yang_dibutuhkan' => 'nullable|string',
            'faktor_pendukung' => 'nullable|string',
            'faktor_penghambat' => 'nullable|string',
            'akar_masalah' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'data_dukung' => 'nullable|string', 
        ]);

        // update_data_transaksi
        $transaksi = TransaksiData::findOrFail($id);

        $transaksi->update([
            'realisasi_ikuk' => $request->input('realisasi_ikuk'),
            'analisis_usulan_keberhasilan' => $request->input('analisis_usulan_keberhasilan'),
            'usulan_target_tahun_depan' => $request->input('usulan_target_tahun_depan'),
            'strategi_pencapaian' => $request->input('strategi_pencapaian'),
            'sarpras_yang_dibutuhkan' => $request->input('sarpras_yang_dibutuhkan'),
            'faktor_pendukung' => $request->input('faktor_pendukung'),
            'faktor_penghambat' => $request->input('faktor_penghambat'),
            'akar_masalah' => $request->input('akar_masalah'),
            'tindak_lanjut' => $request->input('tindak_lanjut'),
            'status_pengisian_audite' => true,
            'data_dukung' => $request->input('data_dukung'), 
        ]);

        return redirect()->route('pengisian_kinerja.index')->with('success', 'Data Kinerja Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
