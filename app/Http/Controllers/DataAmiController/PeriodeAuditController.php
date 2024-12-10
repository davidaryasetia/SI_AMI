<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use Illuminate\Http\Request;

class PeriodeAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data_periode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get(); // Mengurutkan data secara ascending

        // Edit Data Periode
        $editPeriode = null;
        if ($request->has('id')) {
            $editPeriode = PeriodePelaksanaan::find($request->id);
        }

        return view('data_ami.periode_audit.periode', [
            'data_periode' => $data_periode,
            'title' => 'Pengaturan Periode Audit',
            'edit_periode' => $editPeriode,
        ]);
    }

    // Ambil data 
    // Fungsi untuk menyimpan data periode baru
        public function store(Request $request)
        {
            $existingPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')->exists();

            if ($existingPeriode) {
                return redirect()->route('periode_audit.index')->with('error', 'Tidak dapat menambah periode baru. Masih ada periode dengan status "Sedang Berjalan".');
            }


            $request->validate([
                'nama_periode_ami' => 'required|string|max:255',
                'tanggal_pembukaan_ami' => 'required|date',
                'tanggal_penutupan_ami' => 'required|date',
            ]);

            $periode = PeriodePelaksanaan::create([
                'nama_periode_ami' => $request->nama_periode_ami,
                'tanggal_pembukaan_ami' => $request->tanggal_pembukaan_ami,
                'tanggal_penutupan_ami' => $request->tanggal_penutupan_ami,
                'status' => 'Sedang Berjalan',
            ]);

            $indikators = IndikatorKinerjaUnitKerja::all();

            foreach ($indikators as $indikator) {
                TransaksiData::create([
                    'indikator_kinerja_unit_kerja_id' => $indikator->indikator_kinerja_unit_kerja_id,
                    'jadwal_ami_id' => $periode->jadwal_ami_id,
                    'realisasi_ikuk' => null,
                    'analisis' => null,
                    'target_lama' => null,
                    'target_tahun_depan' => null,
                    'strategi_pencapaian' => null,
                    'sarpras_yang_dibutuhkan' => null,
                    'faktor_pendukung' => null,
                    'faktor_penghambat' => null,
                    'akar_masalah' => null,
                    'tindak_lanjut' => null,
                    'status' => 'Belum Diisi',
                    'data_dukung' => null,
                    'status_pengisian_audite' => false, 
                    'status_pengisian_auditor' => false, 
                    'status_finalisasi_audite' => false, 
                    'status_finalisasi_auditor1' => false, 
                    'status_finalisasi_auditor2' => false, 
                ]);
            }

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
            'tanggal_pembukaan_ami' => $request->tanggal_pembukaan_ami,
            'tanggal_penutupan_ami' => $request->tanggal_penutupan_ami,
        ]);

        return redirect()->route('periode_audit.index')->with('success', 'Periode audit berhasil diperbarui.');
    }

    // Fungsi untuk menghapus data
    public function destroy($id)
    {
        $periode = PeriodePelaksanaan::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode_audit.index')->with('success', 'Periode audit berhasil dihapus.');
    }

    // Tutup jadwal 
    public function close($id)
    {
        $periode = PeriodePelaksanaan::findOrFail($id);
        $periode->update([
            'status' => 'Tutup'
        ]);

        return redirect()->route(route: 'periode_audit.index')->with('success', 'Periode audit berhasil ditutup');
    }
}
