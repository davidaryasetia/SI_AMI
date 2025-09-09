<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\Audite;
use App\Models\Auditor;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use App\Models\UnitCabang;
use App\Models\User;
use Illuminate\Http\Request;

class ClonePlotingAmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // -------------------------------- Logic untuk Mendapatkan periode Terbaru------------------
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();
        $selectedJadwalAmiId = $request->input('jadwal_ami_id');

        // jika tidak ada request data dari dropdown
        if (!$selectedJadwalAmiId) {
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
        }

        $data_ploting = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama'
        ])
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->get();
        // dump($data_ploting->toArray());

        return view('data_ami.ploating_ami.ploting', [
            'title' => 'Daftar Audite',
            'jadwalPeriode' => $jadwalPeriode,
            'jadwal_ami_id' => $selectedJadwalAmiId,
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
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;

        // Ambil data unit berdasarkan ID
        $data_unit = Unit::where('jadwal_ami_id', $selectedJadwalAmiId)
            ->findOrFail($id);

        // Ambil user yang memiliki is_audite = true
        $audite_users = User::where('is_audite', true)->get();

        // Ambil user yang memiliki is_auditor = true
        $auditor_users = User::where('is_auditor', true)->get();
        // dump($data_unit->toArray());
        return view('data_ami.ploating_ami.edit', [
            'title' => 'Edit Data Unit',
            'data_unit' => $data_unit,
            'audite_users' => $audite_users,  // Pass user dengan is_audite = true ke view
            'auditor_users' => $auditor_users, // Pass user dengan is_auditor = true ke view
        ]);
    }

    public function editAll()
    {
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;

        // Ambil semua unit kerja dan departemen kerja berdasarkan jadwal AMI terbaru
        $data_units = Unit::where('jadwal_ami_id', $selectedJadwalAmiId)
            ->whereIn('tipe_data', ['unit_kerja', 'departemen_kerja'])
            ->get();

        // Ambil user yang memiliki is_audite = true
        $audite_users = User::where('is_audite', true)->get();

        // Ambil user yang memiliki is_auditor = true
        $auditor_users = User::where('is_auditor', true)->get();

        return view('data_ami.ploating_ami.edit_all', [
            'title' => 'Edit Semua Data Unit',
            'data_units' => $data_units,
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

        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


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
        $unit = Unit::where('unit_id', $id)
            ->where('jadwal_ami_id', $selectedJadwalAmiId)
            ->firstOrFail();

        // Hanya update audite dan auditor tanpa mengubah nama unit cabang
        if ($unit->tipe_data == 'unit_kerja') {
            // Update Audite untuk unit kerja
            $audite = Audite::where('unit_id', $unit->unit_id)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->first();

            if ($audite) {
                // Jika Audite sudah ada, update user_id
                $audite->update(attributes: [
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'user_id' => $request->audite
                ]);

            } else {
                // Jika Audite belum ada, buat baru
                Audite::create([
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'unit_id' => $unit->unit_id,
                    'user_id' => $request->audite,
                ]);
            }

            // Update Auditor 1 dan Auditor 2 untuk unit kerja
            $auditor = Auditor::where('unit_id', $unit->unit_id)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->first();

            if ($auditor) {
                // Jika auditor sudah ada, update auditor1 dan auditor2
                $auditor->update([
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'auditor_1' => $request->auditor1_unit,
                    'auditor_2' => $request->auditor2_unit,
                ]);
            } else {
                // Jika auditor belum ada, buat baru
                Auditor::create([
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'unit_id' => $unit->unit_id,
                    'auditor_1' => $request->auditor1_unit,
                    'auditor_2' => $request->auditor2_unit,
                ]);
            }
        }


        if ($unit->tipe_data == 'departemen_kerja') {
            if ($request->has('kadep')) {
                $auditeKadep = Audite::where('unit_id', $unit->unit_id)
                    ->where('jadwal_ami_id', $selectedJadwalAmiId)
                    ->whereNull('unit_cabang_id')
                    ->first();

                if ($auditeKadep) {
                    $auditeKadep->update([
                        'jadwal_ami_id' => $selectedJadwalAmiId,
                        'user_id' => $request->kadep
                    ]);
                } else {
                    Audite::create([
                        'jadwal_ami_id' => $selectedJadwalAmiId,
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
                        $audite = Audite::where('unit_cabang_id', $unitCabang->unit_cabang_id)
                            ->where('jadwal_ami_id', $selectedJadwalAmiId)
                            ->first();

                        if ($audite) {
                            $audite->update([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'user_id' => $user_id
                            ]);
                        } else {
                            Audite::create([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'unit_id' => $unit->unit_id,
                                'unit_cabang_id' => $unitCabang->unit_cabang_id,
                                'user_id' => $user_id,
                            ]);
                        }
                    }
                }
            }

            // Update Auditor 1 dan Auditor 2 yang sama untuk semua unit cabang
            $auditor = Auditor::where('unit_id', $unit->unit_id)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->first();

            if ($auditor) {
                $auditor->update([
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'auditor_1' => $request->auditor1_departemen,
                    'auditor_2' => $request->auditor2_departemen,
                ]);
            } else {
                Auditor::create([
                    'jadwal_ami_id' => $selectedJadwalAmiId,
                    'unit_id' => $unit->unit_id,
                    'auditor_1' => $request->auditor1_departemen,
                    'auditor_2' => $request->auditor2_departemen,
                ]);
            }
        }

        return redirect()->route('ploting_ami.index')->with('success', 'Data Unit berhasil diperbarui.');
    }

    public function updateAll(Request $request)
    {
        // dd($request->all());
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;

        $data = $request->input('units', []);

        foreach ($data as $unitId => $unitData) {
            $unit = Unit::find($unitId);

            if ($unit) {
                // Handle Unit Kerja
                if ($unit->tipe_data == 'unit_kerja') {
                    // Update Audite
                    if (isset($unitData['audite'])) {
                        $audite = Audite::where('unit_id', $unitId)
                            ->where('jadwal_ami_id', $selectedJadwalAmiId)
                            ->first();

                        if ($audite) {
                            $audite->update(['user_id' => $unitData['audite']]);
                        } else {
                            Audite::create([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'unit_id' => $unitId,
                                'user_id' => $unitData['audite'],
                            ]);
                        }
                    }

                    // Update Auditor
                    if (isset($unitData['auditor1']) || isset($unitData['auditor2'])) {
                        $auditor = Auditor::where('unit_id', $unitId)
                            ->where('jadwal_ami_id', $selectedJadwalAmiId)
                            ->first();

                        if ($auditor) {
                            $auditor->update([
                                'auditor_1' => $unitData['auditor1'] ?? $auditor->auditor_1,
                                'auditor_2' => $unitData['auditor2'] ?? $auditor->auditor_2,
                            ]);
                        } else {
                            Auditor::create([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'unit_id' => $unitId,
                                'auditor_1' => $unitData['auditor1'] ?? null,
                                'auditor_2' => $unitData['auditor2'] ?? null,
                            ]);
                        }
                    }
                }

                // Handle Departemen Kerja
                if ($unit->tipe_data == 'departemen_kerja') {
                    // Update Kepala Departemen (Kadep)
                    if (isset($unitData['kadep'])) {
                        $auditeKadep = Audite::where('unit_id', $unitId)
                            ->where('jadwal_ami_id', $selectedJadwalAmiId)
                            ->whereNull('unit_cabang_id')
                            ->first();

                        if ($auditeKadep) {
                            $auditeKadep->update(['user_id' => $unitData['kadep']]);
                        } else {
                            Audite::create([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'unit_id' => $unitId,
                                'unit_cabang_id' => null,
                                'user_id' => $unitData['kadep'],
                            ]);
                        }
                    }

                    // Update Audite untuk Unit Cabang
                    if (isset($unitData['audite_cabang']) && is_array($unitData['audite_cabang'])) {
                        foreach ($unitData['audite_cabang'] as $cabangId => $userId) {
                            $unitCabang = UnitCabang::find($cabangId);

                            if ($unitCabang) {
                                $audite = Audite::where('unit_cabang_id', $unitCabang->unit_cabang_id)
                                    ->where('jadwal_ami_id', $selectedJadwalAmiId)
                                    ->first();

                                if ($audite) {
                                    $audite->update(['user_id' => $userId]);
                                } else {
                                    Audite::create([
                                        'jadwal_ami_id' => $selectedJadwalAmiId,
                                        'unit_id' => $unitId,
                                        'unit_cabang_id' => $unitCabang->unit_cabang_id,
                                        'user_id' => $userId,
                                    ]);
                                }
                            }
                        }
                    }

                    // Update Auditor untuk Departemen
                    if (isset($unitData['auditor1']) || isset($unitData['auditor2'])) {
                        $auditor = Auditor::where('unit_id', $unitId)
                            ->where('jadwal_ami_id', $selectedJadwalAmiId)
                            ->first();

                        if ($auditor) {
                            $auditor->update([
                                'auditor_1' => $unitData['auditor1'] ?? $auditor->auditor_1,
                                'auditor_2' => $unitData['auditor2'] ?? $auditor->auditor_2,
                            ]);
                        } else {
                            Auditor::create([
                                'jadwal_ami_id' => $selectedJadwalAmiId,
                                'unit_id' => $unitId,
                                'auditor_1' => $unitData['auditor1'] ?? null,
                                'auditor_2' => $unitData['auditor2'] ?? null,
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('ploting_ami.index')->with('success', 'Semua data berhasil diperbarui.');
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
        // Mendapatkan jadwal_ami_id dari request atau periode terbaru
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


        if (!$selectedJadwalAmiId) {
            return redirect()->route('ploting_ami.index')->with('error', 'Tidak ada jadwal AMI yang tersedia untuk direset.');
        }

        Audite::where('jadwal_ami_id', $selectedJadwalAmiId)->update(['user_id' => null]);
        Auditor::where('jadwal_ami_id', $selectedJadwalAmiId)->update([
            'auditor_1' => null,
            'auditor_2' => null,
        ]);
        return redirect()->route('ploting_ami.index')->with('success', 'Ploting Ami Berhasil Di reset');
    }

    // Cek beban 
    public function cekBeban(Request $request)
    {
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        $selectedJadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


        $auditors = User::where('is_auditor', true)->get();

        $data = $auditors->map(function ($auditor) use ($selectedJadwalAmiId) {
            $auditor1Units = Auditor::where('auditor_1', $auditor->user_id)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
                ->with('units') // Pastikan relasi `units` ada di model Auditor
                ->get()
                ->pluck('units.nama_unit')
                ->toArray();

            $auditor2Units = Auditor::where('auditor_2', $auditor->user_id)
                ->where('jadwal_ami_id', $selectedJadwalAmiId)
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

