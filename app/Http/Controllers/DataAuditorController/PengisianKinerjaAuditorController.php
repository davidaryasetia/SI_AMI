<?php

namespace App\Http\Controllers\DataAuditorController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class PengisianKinerjaAuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $unitId = $request->input('unit_id');
        
        // dump($unitId);
        

        return view('data_auditor.pengisian_kinerja.pengisian_kinerja_auditor', [
            'title' => 'Pengisian Kinerja Auditor', 
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
