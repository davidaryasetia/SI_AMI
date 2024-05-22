<?php

namespace App\Http\Controllers;
use App\Models\IndikatorKinerjaUnit;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display sting of the resource.
     */
    public function index()
    {
        return view('data_audit.indikator_unit_kerja.indikator', [
            'title' => 'Indikator Kinerja Unit',
            'units' => Unit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_audit.indikator_unit_kerja.create', [
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
    public function show(IndikatorKinerjaUnit $indikatorKinerjaUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IndikatorKinerjaUnit $indikatorKinerjaUnitindikator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorKinerjaUnit $indikatorKinerjaUnitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorKinerjaUnit $indikatorKinerjaUnit)
    {
        //
    }
}
