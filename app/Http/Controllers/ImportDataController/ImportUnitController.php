<?php

namespace App\Http\Controllers\ImportDataController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportUnitController extends Controller
{
    public function importDataUnit(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        // Ambil file yang diupload
        $file = $request->file('file');

        // Baca file menggunakan PHPSpreadsheet
        $spreadsheet = IOFactory::load($file->getRealPath());

        // Ambil sheet aktif
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil data dalam bentuk array
        $rows = $sheet->toArray(null, true, true, true);

        // Validasi header pada baris pertama
        $header = $rows[1];
        if ($header['A'] !== 'Unit Kerja') {
            return redirect('/unit_kerja')->with('error', 'Format header tidak sesuai');
        }

        $units = [];
        // Mulai iterasi dari baris kedua (index 2)
        foreach ($rows as $index => $row) {
            if ($index == 1) continue; // Lewati header

            // Ambil data dari kolom Excel
            $nama_unit = $row['A'];

            // // Skip baris kosong
            // if (empty($nama_unit)) {
            //     continue;
            // }

            // Validasi unik
            if (!Unit::where('nama_unit', $nama_unit)->exists()) {
                $units[] = ['nama_unit' => $nama_unit, 'created_at' => now(), 'updated_at' => now()];
            }
        }

        // Debugging: Tampilkan hasil data yang akan dimasukkan ke database
        dd($units);

        if (empty($units)) {
            return redirect('/unit_kerja')->with('error', 'Tidak ada data baru untuk diimpor');
        }

        $insertUnits = Unit::insert($units);

        if ($insertUnits) {
            return redirect('/unit_kerja')->with('success', 'Data Unit Kerja Berhasil Diimpor !!!');
        } else {
            return redirect('/unit_kerja')->with('error', 'Data Unit Kerja Gagal Diimpor !!!');
        }
    }
}
