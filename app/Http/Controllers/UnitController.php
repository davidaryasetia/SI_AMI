<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data_audit.unit_kerja.unit', [
            'title' => 'Unit Kerja',
            'units' => Unit::orderBy('unit_id')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_audit.unit_kerja.create', [
            'title' => 'Tambah Data Unit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_unit' => 'required|unique:unit|min:3'
        ]);

        Unit::create($validatedData);
        return redirect('data_audit/unit_kerja/')->with('success', 'Unit Kerja Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nama_unit)
    {
        $unit = Unit::where('nama_unit', $nama_unit)->firstOrFail();
        return view('data_audit.unit_kerja.edit', [
            'unit' => $unit,
            'title' => 'Edit Unit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nama_unit)
    {
        $unit = Unit::where('nama_unit', $nama_unit)->firstOrFail();
        $rules = [
            'nama_unit' => 'required|unique:unit|min:3',
        ];

        if($request->nama_unit === $unit->nama_unit){
            return redirect('data_audit/unit_kerja')->with('success', 'Tidak ada perubahan pada Nama Unit');
        }

        $validatedData = $request->validate($rules);
        $unit->update($validatedData);
        return redirect('data_audit/unit_kerja')->with('success', 'Unit Kerja Berhasil Diperbaharui');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($unit_id)
    {
        Unit::destroy($unit_id);
        return redirect('data_audit/unit_kerja/')->with('success', 'Data Unit Kerja Berhasil Dihapus');
    }
}
