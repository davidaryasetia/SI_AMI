<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgresAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $progres_indikator = Unit::with('')
        return view("data_ami.progres_audit.progres", [
            'title' => 'Progress Audit'
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
