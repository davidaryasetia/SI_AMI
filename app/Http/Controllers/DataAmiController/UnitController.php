<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\UnitCabang;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_unit = Unit::with([
            'units_cabang:unit_cabang_id,unit_id,nama_unit_cabang'
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
        // dd($request->all());
        $tipe_data = $request->input('tipe_data');

        if ($tipe_data === 'unit_kerja') {
            // Validasi dan simpan data unit kerja
            $validatedData = $request->validate([
                'nama_unit_kerja' => 'required|array|min:1',
                'nama_unit_kerja.*' => 'required|unique:unit,nama_unit|min:4'
            ]);

            $units = [];
            foreach ($validatedData['nama_unit_kerja'] as $nama_unit) {
                $units[] = ['nama_unit' => $nama_unit, 'created_at' => now(), 'updated_at' => now()];
            }
            Unit::insert($units);

            return redirect('/unit_kerja')->with('success', 'Unit Kerja berhasil ditambahkan');
        } elseif ($tipe_data === 'departemen_kerja') {

            $validatedData = $request->validate([
                'nama_departemen' => 'required|unique:unit,nama_unit|min:4',
                'nama_unit_cabang' => 'nullable|array',
                'nama_unit_cabang.*' => 'nullable|min:3'
            ]);

            // Simpan departemen
            $unit = Unit::create([
                'nama_unit' => $validatedData['nama_departemen'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Simpan prodi sebagai unit cabang
            if (!empty($validatedData['nama_unit_cabang'])) {
                $unitCabangs = [];
                foreach ($validatedData['nama_unit_cabang'] as $nama_unit_cabang) {
                    if (!is_null($nama_unit_cabang)) {
                        $unitCabangs[] = [
                            'unit_id' => $unit->unit_id,
                            'nama_unit_cabang' => $nama_unit_cabang,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
                UnitCabang::insert($unitCabangs);
            }

            return redirect('/unit_kerja')->with('success', 'Departemen dan Prodi berhasil ditambahkan');
        } else {
            return redirect('/unit_kerja')->with('error', 'Tipe data tidak valid');
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
    public function edit($id)
    {
        $data_unit = Unit::with('units_cabang')->findOrFail($id);

        return view('data_ami.unit_kerja.edit', [
            'title' => 'P4MP - Edit',
            'data_unit' => $data_unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        // Validasi
        $request->validate([
            'tipe_data' => 'required',
            'nama_unit' => 'required_if:tipe_data,unit_kerja',
            'nama_unit_dept' => 'required_if:tipe_data,departement_kerja',
            'nama_unit_cabang.*' => 'sometimes|required_if:tipe_data,departement_kerja',
        ]);

        try {
            // Update data unit
            if ($request->tipe_data == 'unit_kerja') {
                $unit->nama_unit = $request->nama_unit;
            } else {
                $unit->nama_unit = $request->nama_unit_dept;
            }
            $unit->tipe_data = $request->tipe_data;
            $unit->save();

            // Update unit cabang jika tipe data adalah departemen_kerja
            if ($request->tipe_data == 'departement_kerja') {
                // Simpan atau perbarui data unit cabang (prodi)
                if ($request->has('nama_unit_cabang')) {
                    foreach ($request->nama_unit_cabang as $key => $nama_unit_cabang) {
                        if (!is_null($nama_unit_cabang)) {
                            // Cek apakah unit cabang dengan ID tertentu sudah ada
                            $existingCabang = UnitCabang::where('unit_id', $unit->unit_id)->skip($key)->first();

                            if ($existingCabang) {
                                // Update unit cabang yang ada
                                $existingCabang->update([
                                    'nama_unit_cabang' => $nama_unit_cabang,
                                    'updated_at' => now(),
                                ]);
                            } else {
                                // Insert data baru untuk unit cabang
                                UnitCabang::create([
                                    'unit_id' => $unit->unit_id,
                                    'nama_unit_cabang' => $nama_unit_cabang,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }
            }

            // Jika berhasil melakukan update
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Diperbarui !!!');

        } catch (\Exception $e) {
            // Jika terjadi kesalahan, logika gagal
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
