<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
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

        $data_indikator = Unit::with('indikator_ikuk')
            ->where('unit_id', $unitId)
            ->first();

        // dump($data_indikator['indikator_ikuk']->toArray());

        return view('data_audite.pengisian_kinerja.pengisian_kinerja', [
            'title' => 'Pengisian Kinerja',
            'data_indikator' => $data_indikator, 
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
