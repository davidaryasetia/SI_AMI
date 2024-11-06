<?php

namespace App\Http\Controllers\DataAuditorController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\Unit;
use Illuminate\Http\Request;

class PengisianKinerjaAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data unit 
        $auditorUnits = collect(session('auditor'))->pluck('units.unit_id')->unique();
        $units = Unit::whereIn('unit_id', $auditorUnits)->orderBy('unit_id')->get();
        $unitId = $request->input('unit_id');

        // Jika unit_id tida ada di (state awal)
        if (!$unitId && $units->isNotEmpty()) {
            $unitId = $units->first()->unit_id;
        }

        $data_ami = IndikatorKinerjaUnitKerja::select(
            'indikator_kinerja_unit_kerja_id',
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target_ikuk',
            'unit.nama_unit as nama_unit',
            'unit.unit_id as unit_id'
        )
            ->join('unit', 'indikator_kinerja_unit_kerja.unit_id', '=', 'unit.unit_id')
            ->where('indikator_kinerja_unit_kerja.unit_id', $unitId)
            ->get();


        $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        return view('data_auditor.pengisian_kinerja.pengisian_kinerja_auditor', [
            'title' => 'Pengisian Kinerja Auditor',
            'units' => $units, 
            'data_ami' => $data_ami, 
            'unit_id' => $unitId, 
            'nama_unit' => $nama_unit, 
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
