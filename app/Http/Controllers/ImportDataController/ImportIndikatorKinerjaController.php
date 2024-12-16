<?php

namespace App\Http\Controllers\ImportDataController;

use App\Http\Controllers\Controller;
use App\Models\IndikatorKinerjaUnitKerja;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportIndikatorKinerjaController extends Controller
{
    public function importData(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx',
        ]);

        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheetNames = $spreadsheet->getSheetNames(); // Ambil semua nama sheet

        // -------------------------------- Cek Periode "Sedang Berjalan" --------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->back()->with('error', 'Tidak ada periode yang terbuka. Silakan buat periode terlebih dahulu.');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        foreach ($sheetNames as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            $rows = $sheet->toArray();

            if (!empty($rows)) {
                unset($rows[0]); // Hapus header baris pertama
                unset($rows[1]); // Hapus header baris kedua

                foreach ($rows as $rowIndex => $row) {
                    if (empty($row[0]) || empty($row[1])) {
                        continue; // Skip jika data kosong
                    }

                    // Cek Unit berdasarkan nama_unit
                    $unit = Unit::where('nama_unit', $sheetName)
                        ->where('jadwal_ami_id', $jadwalAmiId)
                        ->first();

                    // Jika Unit tidak ditemukan, buat Unit baru
                    if (!$unit) {
                        return redirect()->back()->with('error', 'Data Unit Pada Indikator Kinerja Unit Tidak Tersedia');
                    }

                    // Tambahkan Data ke Indikator Kinerja Unit Kerja
                    $indikator = IndikatorKinerjaUnitKerja::create([
                        'jadwal_ami_id' => $jadwalAmiId,
                        'kode_ikuk' => $row[0],
                        'isi_indikator_kinerja_unit_kerja' => $row[1],
                        'satuan_ikuk' => $row[2],
                        'target_ikuk' => $row[3],
                        'unit_id' => $unit->unit_id,
                    ]);

                    // Tambahkan Data ke Transaksi Data berdasarkan Periode Terbuka
                    TransaksiData::create([
                        'indikator_kinerja_unit_kerja_id' => $indikator->indikator_kinerja_unit_kerja_id,
                        'jadwal_ami_id' => $jadwalAmiId,
                        'realisasi_ikuk' => null,
                        'analisis_usulan_keberhasilan' => null,
                        'target_lama' => null,
                        'target_tahun_depan' => null,
                        'strategi_pencapaian' => null,
                        'sarpras_yang_dibutuhkan' => null,
                        'faktor_pendukung' => null,
                        'faktor_penghambat' => null,
                        'akar_masalah' => null,
                        'tindak_lanjut' => null,
                        'data_dukung' => null,
                        'status_pengisian_audite' => false,
                        'status_finalisasi_audite' => false,
                        'status_finalisasi_auditor' => false,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diimpor dan ditambahkan ke transaksi!');
    }


}
