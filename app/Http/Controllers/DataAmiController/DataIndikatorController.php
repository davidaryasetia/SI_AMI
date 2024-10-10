<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnit;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\Unit;
use Illuminate\Http\Request;

class DataIndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data semua unit untuk ditampilkan di dropdown
        $units = Unit::orderBy('unit_id')->paginate(10);

        // Mendapatkan nilai unit_id dari input form
        $unitId = $request->input('unit_id');

        $data_ami = IndikatorKinerjaUnitKerja::select(
            'indikator_kinerja_unit_kerja_id', 
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target_ikuk',
            'unit.nama_unit as nama_unit', 
            'unit.unit_id as unit_id'
        )
        ->join('unit', 'indikator_kinerja_unit_kerja.unit_id', '=', 'unit.unit_id');
        
        if ($unitId) {
            // Anda harus menentukan tabel untuk kolom unit_id di dalam klausa where
            $data_ami->where('indikator_kinerja_unit_kerja.unit_id', $unitId);
        }
        
        // Ambil data yang sudah difilter dan kirimkan ke view
        $filteredDataAMI = $data_ami->get();

        return view('data_ami.data_indikator.indikator', [
            'title' => 'Instrument IKUK',
            'units' => $units, 
            'data_ami' => $filteredDataAMI, 
            'unit_id' => $unitId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.data_indikator.create', [
            'title' => 'Tambah Indikator Unit Kerja',
        ]);
    }

    public function create_ikuk_id(string $id)
    {
        $data_unit = Unit::select(
            'unit_id', 
            'nama_unit'
        )
        ->where('unit.unit_id', $id)
        ->first();

     return view('data_ami.data_indikator.create', [
        'title' => 'Tambah Indikator Kinerja Unit Kerja', 
        'data' => $data_unit
     ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required', 
            'kode_ikuk' => 'required|array', 
            'isi_indikator_kinerja_unit_kerja' => 'required|array', 
            'satuan_ikuk' => 'required|array', 
            'target_ikuk' => 'required|array', 
            'target_ikuk.*' => 'required|integer' // memastikan setiap target_ikuk adalah integer
        ]);
    

        $unit_id = $request->input('unit_id');
        $kode_ikuk = $request->input('kode_ikuk');
        $isi_indikator_kinerja_unit_kerja = $request->input('isi_indikator_kinerja_unit_kerja');
        $satuan_ikuk = $request->input('satuan_ikuk');
        $target_ikuk = $request->input('target_ikuk');
    
        $data_indikator_kinerja_unit = [];
        foreach ($kode_ikuk as $index => $kode) {
            $data_indikator_kinerja_unit[] = [
                'unit_id' => $unit_id,
                'kode_ikuk' => $kode,
                'isi_indikator_kinerja_unit_kerja' => $isi_indikator_kinerja_unit_kerja[$index],
                'satuan_ikuk' => $satuan_ikuk[$index],
                'target_ikuk' => $target_ikuk[$index],
                'created_at' => now(), 
                'updated_at' => now()
            ];
        }
    
        $insert_ikuk = IndikatorKinerjaUnitKerja::insert($data_indikator_kinerja_unit);
        if($insert_ikuk){
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('success', 'Data Indikator Kinerja Unit Berhasil Ditambahkan !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('error', 'Data Indikator Kinerja Unit Gagal Ditambahkan !!!');
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
        $edit_data_ami = IndikatorKinerjaUnitKerja::select(
            'indikator_kinerja_unit_kerja_id', 
            'kode_ikuk',
            'isi_indikator_kinerja_unit_kerja',
            'satuan_ikuk',
            'target_ikuk',
            'unit.nama_unit as nama_unit', 
            'unit.unit_id as unit_id'
        )
        ->where('indikator_kinerja_unit_kerja_id', $id)
        ->join('unit', 'indikator_kinerja_unit_kerja.unit_id', '=', 'unit.unit_id')
        ->first();

        $data_ikuk = IndikatorKinerjaUnitKerja::where('indikator_kinerja_unit_kerja_id', $id)->firstOrFail();
        return view('data_ami.data_indikator.edit', [
            'title' => 'Edit Data Indikator', 
            'data' => $edit_data_ami, 
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_ikuk' => 'required', 
            'isi_indikator_kinerja_unit_kerja' => 'required', 
            'satuan_ikuk' => 'required', 
            'target_ikuk' => 'required|integer'
        ]);

        $data_indikator = IndikatorKinerjaUnitKerja::where('indikator_kinerja_unit_kerja_id', $id)->firstOrFail();
        
        $unit_id = $request->input('unit_id');

        $data_indikator->update([
            'kode_ikuk' => $request->input('kode_ikuk'),
            'isi_indikator_kinerja_unit_kerja' => $request->input('isi_indikator_kinerja_unit_kerja'),
            'satuan_ikuk' => $request->input('satuan_ikuk'),
            'target_ikuk' => $request->input('target_ikuk')
        ]);

        if($data_indikator){
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('success', 'Data Indikator Kinerja Unit Berhasil Diperbarui !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('error', 'Data Indikator Kinerja Unit Gagal Diperbarui !!!');
        }      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyWithUnit($indikator_id, $unit_id)
    {
        $delete_data_ikuk = IndikatorKinerjaUnitKerja::destroy($indikator_id);

        if($delete_data_ikuk){
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('success', 'Data Indikator Kinerja Unit Berhasil Dihapus !!!');
        } else {
            return redirect()->to('/data_indikator?unit_id='. $unit_id )->with('error', 'Data Indikator Kinerja Unit Gagal Dihapus !!!');
        }      
    }
}
