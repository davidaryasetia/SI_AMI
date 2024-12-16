<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use App\Models\UnitCabang;
use Illuminate\Http\Request;

class DataUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil Semua Jadwal Periode Terurut
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();

        // Ambil Jadwal AMI ID dari Request atau Default Terbaru
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');
        if (!$selectedJadwalAmiId) {
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
        }

        // Ambil Unit Type dari Request
        $unit_type = $request->input('unit_type', 'all'); // Default ke 'all'

        // Query Unit Berdasarkan Jadwal dan Unit Type
        $query = Unit::with(['units_cabang:unit_cabang_id,unit_id,nama_unit_cabang'])
            ->where('jadwal_ami_id', $selectedJadwalAmiId);

        if ($unit_type !== 'all') {
            $query->where('tipe_data', $unit_type);
        }

        $data_unit = $query->get();

        // Return View dengan Data
        return view('data_ami.data_unit.unit', [
            'title' => 'Unit Kerja',
            'data_unit' => $data_unit,
            'unit_type' => $unit_type,
            'jadwal_ami_id' => $selectedJadwalAmiId,
            'jadwalPeriode' => $jadwalPeriode,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.data_unit.create', [
            'title' => 'Tambah Unit Kerja',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // -------------------------------- Cek Periode "Sedang Berjalan" --------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->to('/data_unit')->with('error', 'Tidak ada periode terbuka. Silakan buat periode terlebih dahulu.');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        // Ambil tipe data dari input
        $tipe_data = $request->input('tipe_data');

        // -------------------------------- Tambah Unit Kerja --------------------------------
        if ($tipe_data === 'unit_kerja') {
            // Validasi dan simpan data unit kerja
            $validatedData = $request->validate([
                'nama_unit_kerja' => 'required|array|min:1',
                'nama_unit_kerja.*' => 'required|unique:unit,nama_unit|min:4'
            ]);

            $units = [];
            foreach ($validatedData['nama_unit_kerja'] as $nama_unit) {
                $units[] = [
                    'nama_unit' => $nama_unit,
                    'tipe_data' => $tipe_data,
                    'jadwal_ami_id' => $jadwalAmiId, // Tambahkan jadwal_ami_id
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            Unit::insert($units);

            return redirect('/data_unit')->with('success', 'Unit Kerja berhasil ditambahkan');
        }
        // -------------------------------- Tambah Departemen Kerja --------------------------------
        elseif ($tipe_data === 'departemen_kerja') {
            // Validasi data departemen dan prodi
            $validatedData = $request->validate([
                'nama_departemen' => 'required|unique:unit,nama_unit|min:4',
                'nama_unit_cabang' => 'nullable|array',
                'nama_unit_cabang.*' => 'nullable|min:3'
            ]);

            // Simpan data departemen
            $unit = Unit::create([
                'nama_unit' => $validatedData['nama_departemen'],
                'tipe_data' => $tipe_data,
                'jadwal_ami_id' => $jadwalAmiId, // Tambahkan jadwal_ami_id
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
                            'jadwal_ami_id' => $jadwalAmiId, // Tambahkan jadwal_ami_id
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                    }
                }
                UnitCabang::insert($unitCabangs);
            }

            return redirect('/data_unit')->with('success', 'Departemen dan Prodi berhasil ditambahkan');
        }
        // -------------------------------- Error untuk Tipe Data Tidak Valid --------------------------------
        else {
            return redirect('/data_unit')->with('error', 'Tipe data tidak valid');
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

        return view('data_ami.data_unit.edit', [
            'title' => 'P4MP - Edit',
            'data_unit' => $data_unit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // -------------------------------- Cek Periode "Sedang Berjalan" --------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->to('/data_unit')->with('error', 'Tidak ada periode terbuka. Silakan buat periode terlebih dahulu.');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        $unit = Unit::where('jadwal_ami_id', $jadwalAmiId)
            ->findOrFail($id);

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
            if ($request->tipe_data == 'departemen_kerja') {
                // Hapus unit cabang jika ID tidak ada dalam request
                UnitCabang::where('unit_id', $unit->unit_id)
                    ->whereNotIn('unit_cabang_id', $request->unit_cabang_id ?? [])
                    ->delete();

                // Simpan atau perbarui data unit cabang (prodi)
                if ($request->has('nama_unit_cabang')) {
                    foreach ($request->nama_unit_cabang as $key => $nama_unit_cabang) {
                        $unitCabangId = $request->unit_cabang_id[$key] ?? null;

                        if ($unitCabangId) {
                            // Jika ada unit cabang ID, maka update
                            $existingCabang = UnitCabang::find($unitCabangId);
                            if ($existingCabang) {
                                $existingCabang->update([
                                    'nama_unit_cabang' => $nama_unit_cabang,
                                ]);
                            }
                        } else {
                            // Jika tidak ada unit cabang ID, buat baru
                            UnitCabang::create([
                                'unit_id' => $unit->unit_id,
                                'nama_unit_cabang' => $nama_unit_cabang,
                            ]);
                        }
                    }
                }
            }

            return redirect('/data_unit')->with('success', 'Data Unit Kerja Berhasil Diperbarui !!!');

        } catch (\Exception $e) {
            return redirect('/data_unit')->with('error', 'Data Unit Kerja Gagal Diperbarui !!!');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($unit_id)
    {
        $data_unit = Unit::destroy($unit_id);

        if ($data_unit) {
            return redirect('/data_unit')->with('success', 'Data Unit Kerja Berhasil Dihapus !!!');
        } else {
            return redirect('/data_unit')->with('error', 'Data Unit Kerja Gagal Dihapus !!!');
        }
    }
}
