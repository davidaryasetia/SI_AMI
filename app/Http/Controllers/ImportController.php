<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Unit;
use App\Models\IndikatorKinerjaUnitKerja;
use Illuminate\Support\Facades\Log; // Untuk logging

class ImportController extends Controller
{
    public function importData(Request $request)
    {
        // Validasi file
        $request->validate([
            'excel_file' => 'required|file|mimes:xls,xlsx',
        ]);

        // Ambil file yang diupload
        $file = $request->file('excel_file');

        // Baca file menggunakan PHPSpreadsheet
        $spreadsheet = IOFactory::load($file->getRealPath());

        // Ambil sheet aktif
        $sheet = $spreadsheet->getActiveSheet();

        // Mulai membaca dari baris kedua (asumsinya baris pertama adalah header)
        $rows = $sheet->toArray(null, true, true, true);

        // Ambil data unit dari database untuk mapping
        $units = Unit::pluck('unit_id', 'nama_unit')->toArray(); // Memetakan nama unit ke ID

        // Iterasi melalui setiap baris di Excel
        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // Skip header

            // Ambil data dari kolom Excel
            $kode_ikuk = $row['A'];
            $isi_indikator_kinerja_unit_kerja = $row['B'];
            $satuan_ikuk = $row['C'];
            $target_ikuk = $row['D'];
            $nama_unit = $row['E'];

            // Cek apakah nama unit ada di database
            $unitId = $units[$nama_unit] ?? null;

            // Log untuk debugging
            Log::info("Processing row $index: $nama_unit mapped to $unitId");

            if ($unitId) {
                // Simpan data ke database
                IndikatorKinerjaUnitKerja::create([
                    'kode_ikuk' => $kode_ikuk,
                    'isi_indikator_kinerja_unit_kerja' => $isi_indikator_kinerja_unit_kerja,
                    'satuan_ikuk' => $satuan_ikuk,
                    'target_ikuk' => $target_ikuk,
                    'unit_id' => $unitId, // Gunakan unit ID
                ]);
            } else {
                // Handle jika unit tidak ditemukan (opsional)
                // Tambahkan logging atau return message, tergantung kebutuhan Anda
                Log::error("Unit not found for row $index: $nama_unit");
                return back()->withErrors(['Unit tidak ditemukan: ' . $nama_unit]);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }
}
