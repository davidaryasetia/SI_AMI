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
        $data_unit = Unit::with([
            'units_cabang:unit_id,unit_cabang_id,nama_unit_cabang', 
            'users_audite:user_id,unit_id,unit_cabang_id,nama',
            'units_cabang.users_cabang:user_id,unit_id,unit_cabang_id,nama',
            'auditors:auditor_id,unit_id,auditor_1,auditor_2',
            'auditors.users_auditor1:user_id,nama', 
            'auditors.users_auditor2:user_id,nama',
            ])->get();


        // dump($data_unit->toArray());
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
            'nama_unit' => 'required|array|min:1',
            'nama_unit.*' => 'required|unique:unit,nama_unit|min:4'
        ]);

        $units = [];
        foreach ($validatedData['nama_unit'] as $nama_unit) {
            $units[] = ['nama_unit' => $nama_unit, 'created_at' => now(), 'updated_at' => now()];
        }

        $insertUnits = Unit::insert($units);

        if ($insertUnits) {
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Ditambahkan !!!');
        } else {
            return redirect('/unit_kerja')->with('error', 'Data Unit Kerja Gagal Ditambahkan !!!');
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
        $update_unit = $unit->update($validatedData);

        if ($update_unit) {
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Diperbarui !!!');
        } else {
            return redirect('/unit_kerja')->with('error', 'Data Unit Kerja Gagal Diperbarui !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($unit_id)
    {
        $data_unit = Unit::destroy($unit_id);

        if ($data_unit) {
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Dihapus !!!');
        } else {
            return redirect('/unit_kerja')->with('error', 'Data Unit Kerja Gagal Dihapus !!!');
        }
    }
}
