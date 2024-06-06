<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnit;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\Unit;
use Illuminate\Http\Request;

class IndikatorKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_ami = IndikatorKinerjaUnitKerja::select(
            'kode_ikuk', 
            'isi_indikator_kinerja_unit_kerja', 
            'satuan_ikuk', 
            'target_ikuk', 
        )->get();

        return view('data_ami.indikator_unit_kerja.indikator', [
            'title' => 'Indikator Kinerja', 
            'units' => Unit::orderBy('unit_id')->paginate(15), 
            'data_ami' => $data_ami
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.indikator_unit_kerja.create', [
            'title' => 'Tambah Indikator Unit Kerja', 
        ]);
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
