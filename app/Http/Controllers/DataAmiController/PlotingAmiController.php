<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Audite;
use App\Models\Auditor;
use App\Models\Unit;
use App\Models\UnitCabang;
use App\Models\User;
use Illuminate\Http\Request;

class PlotingAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_ploting = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama'
        ])->get();
        // dump($data_ploting->toArray());

        return view('data_ami.ploating_ami.ploting', [
            'title' => 'Daftar Audite',
            'data_ploting' => $data_ploting,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data_ami.ploating_ami.ploating', [
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
        // Ambil data unit berdasarkan ID
        $data_unit = Unit::findOrFail($id);

        // Ambil user yang memiliki is_audite = true
        $audite_users = User::where('is_audite', true)->get();

        // Ambil user yang memiliki is_auditor = true
        $auditor_users = User::where('is_auditor', true)->get();

        return view('data_ami.ploating_ami.edit', [
            'title' => 'Edit Data Unit',
            'data_unit' => $data_unit,
            'audite_users' => $audite_users,  // Pass user dengan is_audite = true ke view
            'auditor_users' => $auditor_users, // Pass user dengan is_auditor = true ke view
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'audite' => 'nullable|exists:user,user_id',
            'kadep' => 'nullable|exists:user,user_id',
            'auditor1_departemen' => 'nullable|exists:user,user_id',
            'auditor2_departemen' => 'nullable|exists:user,user_id',
            'auditor1_unit' => 'nullable|exists:user,user_id',
            'auditor2_unit' => 'nullable|exists:user,user_id',
            'audite_cabang.*' => 'nullable|exists:user,user_id',
        ]);

        // Temukan unit yang akan di-update
        $unit = Unit::findOrFail($id);

        // Hanya update audite dan auditor tanpa mengubah nama unit cabang
        if ($unit->tipe_data == 'unit_kerja') {
            // Update Audite untuk unit kerja
            $audite = Audite::where('unit_id', $unit->unit_id)->first();
            if ($audite) {
                // Jika Audite sudah ada, update user_id
                $audite->update(['user_id' => $request->audite]);
            } else {
                // Jika Audite belum ada, buat baru
                Audite::create([
                    'unit_id' => $unit->unit_id,
                    'user_id' => $request->audite,
                ]);
            }

            // Update Auditor 1 dan Auditor 2 untuk unit kerja
            $auditor = Auditor::where('unit_id', $unit->unit_id)->first();
            if ($auditor) {
                // Jika auditor sudah ada, update auditor1 dan auditor2
                $auditor->update([
                    'auditor_1' => $request->auditor1_unit,
                    'auditor_2' => $request->auditor2_unit,
                ]);
            } else {
                // Jika auditor belum ada, buat baru
                Auditor::create([
                    'unit_id' => $unit->unit_id,
                    'auditor_1' => $request->auditor1,
                    'auditor_2' => $request->auditor2,
                ]);
            }
        }


        if ($unit->tipe_data == 'departemen_kerja') {
            if ($request->has('kadep')) {
                $auditeKadep = Audite::where('unit_id', $unit->unit_id)->whereNull('unit_cabang_id')->first();
                if ($auditeKadep) {
                    $auditeKadep->update(['user_id' => $request->kadep]);
                } else {
                    Audite::create([
                        'unit_id' => $unit->unit_id,
                        'unit_cabang_id' => null,
                        'user_id' => $request->kadep,
                    ]);
                }
            }

            // Tidak mengubah nama unit cabang, hanya update audite per cabang
            if ($request->has('audite_cabang')) {
                foreach ($request->audite_cabang as $key => $user_id) {
                    $unitCabang = UnitCabang::find($key);
                    if ($unitCabang) {
                        // Update audite untuk unit cabang
                        $audite = Audite::where('unit_cabang_id', $unitCabang->unit_cabang_id)->first();
                        if ($audite) {
                            $audite->update(['user_id' => $user_id]);
                        } else {
                            Audite::create([
                                'unit_id' => $unit->unit_id,
                                'unit_cabang_id' => $unitCabang->unit_cabang_id,
                                'user_id' => $user_id,
                            ]);
                        }
                    }
                }
            }

            // Update Auditor 1 dan Auditor 2 yang sama untuk semua unit cabang
            $auditor = Auditor::where('unit_id', $unit->unit_id)->first();
            if ($auditor) {
                $auditor->update([
                    'auditor_1' => $request->auditor1_departemen,
                    'auditor_2' => $request->auditor2_departemen,
                ]);
            } else {
                Auditor::create([
                    'unit_id' => $unit->unit_id,
                    'auditor_1' => $request->auditor1_departemen,
                    'auditor_2' => $request->auditor2_departemen,
                ]);
            }
        }

        return redirect()->route('ploting_ami.index')->with('success', 'Data Unit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Reset semua data ploting 
    public function resetPloting()
    {
        Audite::query()->update(['user_id' => null]);
        Auditor::query()->update(['auditor_1' => null, 'auditor_2' => null]);

        return redirect()->route('ploting_ami.index')->with('success', 'Ploting Ami Berhasil Di reset');
    }

    // Cek beban 
    public function cekBeban(Request $request)
    {
        $auditors = User::where('is_auditor', true)->get();

        $data = $auditors->map(function ($auditor) {
            $auditor1Units = Auditor::where('auditor_1', $auditor->user_id)
                ->with('units') // Pastikan relasi `units` ada di model Auditor
                ->get()
                ->pluck('units.nama_unit')
                ->toArray();

            $auditor2Units = Auditor::where('auditor_2', $auditor->user_id)
                ->with('units')
                ->get()
                ->pluck('units.nama_unit')
                ->toArray();

            $jumlahAuditor1 = count($auditor1Units);
            $jumlahAuditor2 = count($auditor2Units);
            $total = $jumlahAuditor1 + $jumlahAuditor2;

            return [
                'nama' => $auditor->nama,
                'jumlahAuditor1' => $jumlahAuditor1,
                'jumlahAuditor2' => $jumlahAuditor2,
                'auditor1Units' => $auditor1Units, // Unit untuk Auditor 1
                'auditor2Units' => $auditor2Units, // Unit untuk Auditor 2
                'total' => $total,
            ];
        });

        return response()->json($data);
    }

}

