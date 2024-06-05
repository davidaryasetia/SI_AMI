<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_auditor = Unit::select('unit.nama_unit', 'usr1.nama as auditor1', 'usr2.nama as auditor2')
        ->join('auditor', 'unit.unit_id', '=', 'auditor.unit_id')
        ->leftJoin('user as usr1', 'auditor.auditor_1', '=', 'usr1.user_id')
        ->leftJoin('user as usr2', 'auditor.auditor_2', '=', 'usr2.user_id')
        ->get();
        
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
