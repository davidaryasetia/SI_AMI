<?php

namespace App\Http\Controllers\DataAuditorController;

use App\Http\Controllers\Controller;
use App\Models\TransaksiData;
use Illuminate\Http\Request;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Carbon\Carbon;


class RekapPersetujuanAuditorController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->format('d F y');
        // -------------------------------Logic Untuk Mendapatkan data periode Terbaru-----------------------------------
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        // Jika tidak ada periode berjalan, ambil periode terakhir jika ada
        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }
        // Jika tidak ada periode  sama sekali, set data default
        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


        // -----------------------------Data Untuk Mendapatkan hasil Unit Yang Di Audit----------------------------------
        $auditorUnits = collect(session('auditor'))->pluck('unit_id')->unique();
        $units = Unit::whereIn('unit_id', values: $auditorUnits)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->orderBy('unit_id')->get();

        $userId = session('user_id');
        $dataIndikator = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->whereIn('unit_id', $auditorUnits) // Filter berdasarkan unit_id dari session auditor
            ->get();

        $dataTransaksi = $dataIndikator->map(function ($unit) use ($userId) {
            $date = Carbon::now()->format('d F y');
            $totalIndikator = $unit->indikator_ikuk->count();
            $filledAudite = $unit->indikator_ikuk->filter(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
            })->count();

            $filledAuditor = $unit->indikator_ikuk->filter(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_pengisian_auditor', true)->count() > 0;
            })->count();

            $persentasePengisianAudite = $totalIndikator > 0 ? round(($filledAudite / $totalIndikator) * 100, 2) : 0;
            $persentasePengisianAuditor = $totalIndikator > 0 ? round(($filledAuditor / $totalIndikator) * 100, 2) : 0;

            $isKetuaAuditor = false;
            $isAnggotaAuditor = false;

            // Periksa apakah user adalah auditor1 (ketua auditor)
            if (isset($unit->auditor->auditor1) && $unit->auditor->auditor1->user_id == $userId) {
                $isKetuaAuditor = true;
            }

            // Periksa apakah user adalah auditor2 (anggota auditor)
            if (isset($unit->auditor->auditor2) && $unit->auditor->auditor2->user_id == $userId) {
                $isAnggotaAuditor = true;
            }


            $statusFinalisasiAudite = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
            });

            $statusFinalisasiAuditor1 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
            });

            $statusFinalisasiAuditor2 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
            });

            $tanggalFinalisasi = $date;
            if ($isKetuaAuditor) {
                $tanggalFinalisasi = $unit->indikator_ikuk
                    ->pluck('transaksiDataIkuk')
                    ->flatten()->where('status_finalisasi_auditor1', true)
                    ->first()
                    ->tanggal_status_finalisasi_auditor1 ?? $date;

                $formatTanggalFinalisasi = Carbon::parse($tanggalFinalisasi)->format('d F Y');

            } else if ($isAnggotaAuditor) {
                $tanggalFinalisasi = $unit->indikator_ikuk
                    ->pluck('transaksiDataIkuk')
                    ->flatten()->where('status_finalisasi_auditor2', true)
                    ->first()
                    ->tanggal_status_finalisasi_auditor2 ?? $date;

                $formatTanggalFinalisasi = Carbon::parse($tanggalFinalisasi)->format('d F Y');
            }


            return [
                'unit_id' => $unit->unit_id,
                'nama_unit' => $unit->nama_unit,
                'is_ketua_auditor' => $isKetuaAuditor,
                'is_anggota_auditor' => $isAnggotaAuditor,
                'totalIndikator' => $totalIndikator,
                'filledAudite' => $filledAudite,
                'filledAuditor' => $filledAuditor,
                'persentasePengisianAudite' => $persentasePengisianAudite,
                'persentasePengisianAuditor' => $persentasePengisianAuditor,
                'auditor1' => $unit->auditor->auditor1->nama ?? null,
                'auditor2' => $unit->auditor->auditor2->nama ?? null,
                'statusFinalisasiAudite' => $statusFinalisasiAudite,
                'statusFinalisasiAuditor1' => $statusFinalisasiAuditor1,
                'statusFinalisasiAuditor2' => $statusFinalisasiAuditor2,
                'tanggalFinalisasi' => $formatTanggalFinalisasi,
            ];
        });


        return view('data_auditor.rekap_persetujuan.rekap_persetujuan_auditor', [
            'title' => 'Rekap Persetujuan Auditor',
            'date' => $date,
            'dataTransaksi' => $dataTransaksi,
        ]);
    }

    public function finalisasiAuditor(Request $request)
    {
        $unitId = $request->input('unit_id');
        $userId = session('user_id');
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            return redirect()->back()->with('error', 'Tidak ada periode pelaksanaan yang terbuka');
        }

        $jadwalAmiId = $periodeTerbaru->jadwal_ami_id;

        // cek apakah user ketua auditor atau anggota auditor
        $unit = Unit::with('auditor')
            ->where('unit_id', $unitId)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->firstOrFail();

        $isKetuaAuditor = $unit->auditor && $unit->auditor->auditor_1 == $userId;
        $isAnggotaAuditor = $unit->auditor && $unit->auditor->auditor_2 == $userId;

        if (!$isKetuaAuditor && !$isAnggotaAuditor) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk finalisasi unit ini.');
        }

        // Cek validasi status_pengisian_auditor
        $cek_pengisian_auditor = TransaksiData::whereHas('indikator_ikuk', function ($query) use ($unitId) {
            $query->where('unit_id', $unitId);
        })
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->where('status_pengisian_auditor', false)
            ->exists();

        if ($cek_pengisian_auditor) {
            return redirect()->back()->with('error', 'Tidak dapat melakukan proses finalisasi, karena terdapat isian konfirmasi pada indikator kinerja unit kerja yang belum anda konfirmasi. Mohon pastikan semua transaksi telah dikonfirmasi sebelum melakukan finalisasi.');
        }

        // Cek validasi status_finalisasi_audite
        $cek_finalisasi_audite = TransaksiData::whereHas('indikator_ikuk', function ($query) use ($unitId) {
            $query->where('unit_id', $unitId);
        })
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->where('status_finalisasi_audite', false)
            ->exists();

        if ($cek_finalisasi_audite) {
            return redirect()->back()->with('error', 'Tidak bisa melakukan finalisasi, karena audite belum mengkonfirmasi pengisian data, silahkan kontak user audite pada unit ' . $unit->nama_unit);
        }

        $statusColumn = $isKetuaAuditor ? 'status_finalisasi_auditor1' : 'status_finalisasi_auditor2';
        $dateColumn = $isKetuaAuditor ? 'tanggal_status_finalisasi_auditor1' : 'tanggal_status_finalisasi_auditor2';

        $updateData = TransaksiData::whereHas('indikator_ikuk', function ($query) use ($unitId) {
            $query->where('unit_id', $unitId);
        })
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->update([
                $statusColumn => true,
                $dateColumn => now(),
            ]);

        if ($updateData > 0) {
            return redirect()->back()->with('success', 'Finalisasi berhasil dilakukan.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang di finalisasi');
        }
    }

}
