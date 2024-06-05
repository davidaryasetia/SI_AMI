<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data_unit = Unit::select(
            'unit.unit_id as unit_id',
            'unit.nama_unit as nama_unit',
            'usr.nama as audite',
            'usr1.nama as auditor1',
            'usr2.nama as auditor2'
        )
            ->leftJoin('auditor', 'unit.unit_id', '=', 'auditor.unit_id')
            ->leftJoin('user as usr1', 'auditor.auditor_1', '=', 'usr1.user_id')
            ->leftJoin('user as usr2', 'auditor.auditor_2', '=', 'usr2.user_id')
            ->leftJoin('user as usr', 'unit.unit_id', '=', 'usr.unit_id')
            ->get();


        return view('data_ami.unit_kerja.unit', [
            'title' => 'Unit Kerja',
            'data_unit' => $data_unit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.unit_kerja.create', [
            'title' => 'Tambah Unit Kerja',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_unit' => 'required|unique:unit|min:4'
        ]);

        $unit = Unit::create($validatedData);

        if($unit){
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Ditambahkan');
        } else {
            return redirect('/unit_kerja')->with('error', 'Data Gagal Di input');
        }
        
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


        $data_unit = Unit::select(
            'unit.unit_id as unit_id',
            'unit.nama_unit as nama_unit',
            'usr.nama as audite',
            'usr1.nama as auditor1',
            'usr2.nama as auditor2'
        )
            ->join('auditor', 'unit.unit_id', '=', 'auditor.unit_id')
            ->leftJoin('user as usr1', 'auditor.auditor_1', '=', 'usr1.user_id')
            ->leftJoin('user as usr2', 'auditor.auditor_2', '=', 'usr2.user_id')
            ->leftJoin('user as usr', 'unit.unit_id', '=', 'usr.unit_id')
            ->where('unit.unit_id', $id)
            ->first();

        $unit = Unit::where('unit_id', $id)->firstOrFail();
        // dd($data_unit);
        return view('data_ami.unit_kerja.edit', [

            'unit' => $unit,
            'data_unit' => $data_unit, 
            'title' => 'Edit Unit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nama_unit)
    {
        $unit = Unit::where('nama_unit', $nama_unit)->firstOrFail();
        $rules = [
            'nama_unit' => 'required|unique:unit|min:3',
        ];

        if ($request->nama_unit === $unit->nama_unit) {
            return redirect('/unit_kerja')->with('success', 'Tidak ada perubahan pada nama unit');
        }

        $validatedData = $request->validate($rules);
        $unit->update($validatedData);
        return redirect('/unit_kerja')->with('success', 'Unit Kerja Berhasil Diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($unit_id)
    {
        Unit::destroy($unit_id);
        return redirect('/unit_kerja');
    }
}
