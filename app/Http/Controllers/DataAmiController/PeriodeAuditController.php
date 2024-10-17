<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use Illuminate\Http\Request;

class PeriodeAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_periode = PeriodePelaksanaan::all(); // Mengambil semua data dari tabel periode audit
        return view('data_ami.periode_audit.periode', [
            'data_periode' => $data_periode,
            'title' => 'Pengaturan Periode Audit'
        ]);
    }

    // Fungsi untuk menyimpan data periode baru
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_periode_ami' => 'required|string|max:255',
            'tanggal_pembukaan_ami' => 'required|date',
            'tanggal_penutupan_ami' => 'required|date',
        ]);

        PeriodePelaksanaan::create([
            'nama_periode_ami' => $request->nama_periode_ami,
            'tanggal_pembukaan_ami' => $request->tanggal_pembukaan_ami,
            'tanggal_penutupan_ami' => $request->tanggal_penutupan_ami,
        ]);

        return redirect()->route('periode_audit.index')->with('success', 'Periode Audit Berhasil Dibuat !!!');
    }

    // Fungsi untuk menampilkan form edit data
    public function edit($id)
    {
        $periode = PeriodePelaksanaan::findOrFail($id);
        return view('data_ami.periode_audit.edit', [
            'periode' => $periode,
            'title' => 'Edit Periode Audit'
        ]);
    }

    // Fungsi untuk update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode_ami' => 'required|string|max:255',
            'tanggal_pembukaan_ami' => 'required|date',
            'tanggal_penutupan_ami' => 'required|date|after_or_equal:mulai',
        ]);

        $periode = PeriodePelaksanaan::findOrFail($id);
        $periode->update([
            'nama_periode_ami' => $request->nama_periode_ami,
            'tanggal_pembukaan_ami' => $request->mulai,
            'tanggal_penutupan_ami' => $request->selesai,
        ]);

        return redirect()->route('periode_audit.edit')->with('success', 'Periode audit berhasil diperbarui.');
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $periode = PeriodePelaksanaan::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode_audit.index')->with('success', 'Periode audit berhasil dihapus.');
    }
}
