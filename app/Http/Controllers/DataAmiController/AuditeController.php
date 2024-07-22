<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       $data_audite = Unit::with([
        'units_cabang:unit_cabang_id,unit_id,nama_unit_cabang',
        'users_audite:user_id,unit_id,unit_cabang_id,nama',
        'units_cabang.users_cabang:user_id,unit_id,unit_cabang_id,nama',
       ])->get();
    //    dump($data_audite->toArray());

        return view('data_ami.daftar_audite.audite', [
            'title' => 'Daftar Audite',
            'daftar_audite' => $data_audite, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.daftar_audite.create', [
            'title' => 'Tambah Audite',

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
