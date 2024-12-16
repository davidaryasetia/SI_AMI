<?php

namespace App\Http\Controllers\ImportDataController;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\UnitCabang;
use App\Models\PeriodePelaksanaan;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportUnitController extends Controller
{
    public function importDataUnit(Request $request)
    {
        try {
            // Validasi file upload
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls'
            ]);

            // Ambil periode AMI yang aktif
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                return redirect('/data_unit')->with('error', 'Tidak ada periode AMI yang aktif.');
            }

            $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

            // Load file Excel
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());

            $dataInserted = false;

            foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
                $sheetTitle = strtolower(trim($sheet->getTitle()));
                $rows = $sheet->toArray(null, true, true, true);

                if ($sheetTitle == 'unit kerja') {
                    // Proses import Unit Kerja
                    foreach ($rows as $index => $row) {
                        if ($index < 3) continue; // Lewati header

                        $namaUnit = $row['B'] ?? null;

                        if (!empty($namaUnit)) {
                            Unit::create([
                                'jadwal_ami_id' => $jadwalAmiId,
                                'nama_unit' => $namaUnit,
                                'tipe_data' => 'unit_kerja',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            $dataInserted = true;
                        }
                    }
                } elseif ($sheetTitle == 'departemen kerja') {
                    // Proses import Departemen Kerja dan Unit Cabang
                    foreach ($rows as $index => $row) {
                        if ($index < 3) continue; // Lewati header

                        $namaDepartemen = $row['B'] ?? null;

                        if (!empty($namaDepartemen)) {
                            $unit = Unit::create([
                                'jadwal_ami_id' => $jadwalAmiId,
                                'nama_unit' => $namaDepartemen,
                                'tipe_data' => 'departemen_kerja',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);

                            // Iterasi untuk kolom C–I (Prodi/Unit Cabang)
                            for ($col = 'C'; $col <= 'I'; $col++) {
                                $namaUnitCabang = $row[$col] ?? null;

                                if (!empty($namaUnitCabang)) {
                                    UnitCabang::create([
                                        'unit_id' => $unit->unit_id,
                                        'nama_unit_cabang' => $namaUnitCabang,
                                        'jadwal_ami_id' => $jadwalAmiId,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
                                    $dataInserted = true;
                                }
                            }
                        }
                    }
                }
            }

            // Redirect dengan pesan sukses atau error
            if ($dataInserted) {
                return redirect('/data_unit')->with('success', 'Data Unit Kerja dan Departemen Kerja berhasil diimpor!');
            } else {
                return redirect('/data_unit')->with('error', 'Tidak ada data yang diimpor. Cek format file.');
            }
        } catch (\Exception $e) {
            \Log::error('Import Data Unit Error: ' . $e->getMessage());
            return redirect('/data_unit')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
