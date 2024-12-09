<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class RekapAuditController extends Controller
{
    public function index(Request $request)
    {
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();

        $jadwalAmiId = $request->query('jadwal_ami_id');
        if ($jadwalAmiId) {
            $jadwalAmi = PeriodePelaksanaan::find($jadwalAmiId);

            if (!$jadwalAmi) {
                return redirect()->route('rekap_audit.index')->with('error', 'Tidak ada Jadwal AMI');
            }
        }

        $data_transaksi = collect();
        if ($jadwalAmiId) {
            $data_transaksi = Unit::with([
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                    $query->where('jadwal_ami_id', $jadwalAmiId);
                }
            ])->get();
        }

        $rekapByUnit = $data_transaksi->map(function ($unit) {
            $melampauiTarget = 0;
            $memenuhi = 0;
            $belumMemenuhi = 0;

            foreach ($unit->indikator_ikuk as $indikator) {
                foreach ($indikator->transaksiDataIkuk as $transaksi) {
                    if ($transaksi->realisasi_ikuk > $indikator->target_ikuk) {
                        $melampauiTarget++;
                    } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk) {
                        $memenuhi++;
                    } elseif ($transaksi->realisasi_ikuk < $indikator->target_ikuk) {
                        $belumMemenuhi++;
                    }
                }
            }

            return [
                'unit_id' => $unit->unit_id,
                'nama_unit' => $unit->nama_unit,
                'belumMemenuhi' => $belumMemenuhi,
                'memenuhi' => $memenuhi,
                'melampauiTarget' => $melampauiTarget,
                'totalDataIkuk' => $melampauiTarget + $memenuhi + $belumMemenuhi,
                'indikator_ikuk' => $unit->indikator_ikuk->map(function ($indikator) {
                    return [
                        'kode_ikuk' => $indikator->kode_ikuk,
                        'isi_indikator_kinerja_unit_kerja' => $indikator->isi_indikator_kinerja_unit_kerja,
                        'target_ikuk' => $indikator->target_ikuk,
                        'transaksi' => $indikator->transaksiDataIkuk->first(),
                    ];
                })
            ];
        });
        // dump($data_transaksi->pluck('indikator_ikuk')->flatten()->toArray());
        // dump($rekapByUnit->toArray());

        return view('data_ami.rekap_audit.rekap', [
            'jadwalPeriode' => $jadwalPeriode,
            'dataTransaksi' => $data_transaksi,
            'indikatorIkuk' => $data_transaksi->pluck('indikator_ikuk')->flatten(),
            'jadwalAmiId' => $jadwalAmiId,
            'rekapByUnit' => $rekapByUnit,
        ]);
    }

    public function export(Request $request)
    {
        $jadwalAmiId = $request->query('jadwal_ami_id');

        if (!$jadwalAmiId) {
            return redirect()->route('rekap_audit.index')->with('error', 'Silakan pilih Periode AMI terlebih dahulu.');
        }

        // Ambil data berdasarkan jadwal_ami_id
        $data_transaksi = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])->get();

        $rekapByUnit = $data_transaksi->map(function ($unit) {
            $melampauiTarget = 0;
            $memenuhi = 0;
            $belumMemenuhi = 0;

            foreach ($unit->indikator_ikuk as $indikator) {
                foreach ($indikator->transaksiDataIkuk as $transaksi) {
                    if ($transaksi->realisasi_ikuk > $indikator->target_ikuk) {
                        $melampauiTarget++;
                    } elseif ($transaksi->realisasi_ikuk == $indikator->target_ikuk) {
                        $memenuhi++;
                    } elseif ($transaksi->realisasi_ikuk < $indikator->target_ikuk) {
                        $belumMemenuhi++;
                    }
                }
            }

            return [
                'nama_unit' => $unit->nama_unit,
                'totalDataIkuk' => $melampauiTarget + $memenuhi + $belumMemenuhi,
                'belumMemenuhi' => $belumMemenuhi,
                'memenuhi' => $memenuhi,
                'melampauiTarget' => $melampauiTarget,
            ];
        });

        // Membuat Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Kolom
        $headers = ['No', 'Unit', 'Total Indikator', 'Belum Mencapai', 'Memenuhi', 'Melebihi Target'];
        $columnIndex = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '1', $header); // Baris pertama untuk header
            $columnIndex++;
        }

        // Isi Data
        $rowIndex = 2;
        foreach ($rekapByUnit as $index => $data) {
            $sheet->setCellValue('A' . $rowIndex, $index + 1); // Nomor
            $sheet->setCellValue('B' . $rowIndex, $data['nama_unit']); // Nama unit
            $sheet->setCellValue('C' . $rowIndex, $data['totalDataIkuk']); // Total indikator
            $sheet->setCellValue('D' . $rowIndex, $data['belumMemenuhi']); // Belum memenuhi
            $sheet->setCellValue('E' . $rowIndex, $data['memenuhi']); // Memenuhi
            $sheet->setCellValue('F' . $rowIndex, $data['melampauiTarget']); // Melebihi target
            $rowIndex++;
        }

        // Atur Nama File
        $fileName = 'Rekap_Audit_AMI_Per_' . now()->format('Ymd_His') . '.xlsx';

        // Kirim File ke Browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

}
