<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use App\Models\Unit;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data_auditor = Auditor::with([
            'units:unit_id,nama_unit',
            'users_auditor1:user_id,nama', 
            'users_auditor2:user_id,nama', 
            'units.units_cabang:unit_cabang_id,unit_id,nama_unit_cabang'
        ])->get();

        // dump($data_auditor->toArray());
        return view('data_ami.daftar_auditor.auditor', [
            'title' => 'Daftar Auditor', 
            'daftar_auditor' => $data_auditor,
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
