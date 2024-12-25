<?php

namespace App\Http\Controllers\DataAuditeController;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersetujuanAuditeController extends Controller
{

    public function index()
    {
        // dump(session()->all());
        $date = Carbon::now()->format('d F Y');
        $unitId = session('audite.unit_id');
        $nama_audite = Auth::user()->nama;
        $nama_unit = session('audite.nama_unit');

        $auditorData = Auditor::where('unit_id', $unitId)->first();
        if ($auditorData) {
            $auditor_1 = User::find($auditorData->auditor_1);
            $auditor_2 = User::find($auditorData->auditor_2);

            $auditor1 = $auditor_1 ? $auditor_1->nama : 'Auditor 1 Belum di set!';
            $auditor2 = $auditor_2 ? $auditor_2->nama : 'Auditor 2 Belum di set!';
        }

        $currentPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$currentPeriode) {
            $currentPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }
        // Jika tidak ada periode sama sekali, set data default
        $jadwalAmiId = $currentPeriode ? $currentPeriode->jadwal_ami_id : null;



        if (!$jadwalAmiId) {
            return view('data_audite.persetujuan.persetujuan', [
                'current_periode' => '',
                'audite' => [
                    'nama' => $nama_audite,
                    ''
                ],
                'auditor1' => [
                    'nama' => $auditor1,
                    'status' => 'Ketua Auditor',
                    'status_finalisasi' => 'Belum Finalisasi'
                ],
                'auditor2' => [
                    'nama' => $auditor2,
                    'status' => 'Anggota Auditor',
                    'status_finalisasi' => 'Belum Finalisasi',
                ],
            ]);
        }

        // Mengambil data unit dan relasi terkait
        $dataUnit = Unit::with([
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->where('unit_id', $unitId)->first();

        if (!$dataUnit) {
            return view('data_audite.home_audite.beranda', [
                'title' => 'Audite',
                'current_periode' => $currentPeriode,
                'audite' => [
                    'nama' => $nama_audite,
                    'nama_unit' => $nama_unit,
                    'status' => 'audite',
                    'status_finalisasi' => false,
                ],
                'auditor1' => [
                    'nama' => $auditor1,
                    'status' => 'Ketua Auditor',
                    'status_finalisasi' => false,
                ],
                'auditor2' => [
                    'nama' => $auditor2,
                    'status' => 'Anggota Auditor',
                    'status_finalisasi' => false,
                ],
            ]);
        }


        // Status Finalisasi Audite, Auditor1, dan Auditor2
        $statusFinalisasiAuditor1 = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
        });

        $statusFinalisasiAuditor2 = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
        });

        $statusFinalisasiAudite = $dataUnit->indikator_ikuk->isNotEmpty() && $dataUnit->indikator_ikuk->every(function ($indikator) {
            return $indikator->transaksiDataIkuk->where('status_finalisasi_audite', true)->count() > 0;
        });

        $tanggalFinalisasiAudite = $dataUnit->indikator_ikuk
            ->flatMap(fn($indikator) => $indikator->transaksiDataIkuk)
            ->where('status_finalisasi_audite', true)
            ->pluck('tanggal_status_finalisasi_audite')
            ->first();
        $formatTanggalFinalisasiAudite = Carbon::parse($tanggalFinalisasiAudite)->format('d F Y');

        $tanggalFinalisasiAuditor1 = $dataUnit->indikator_ikuk
            ->flatMap(fn($indikator) => $indikator->transaksiDataIkuk)
            ->where('status_finalisasi_auditor1', true)
            ->pluck('tanggal_status_finalisasi_auditor1')
            ->first();
        $formatTanggalFinalisasiAuditor1 = Carbon::parse($tanggalFinalisasiAuditor1)->format('d F Y');

        $tanggalFinalisasiAuditor2 = $dataUnit->indikator_ikuk
            ->flatMap(fn($indikator) => $indikator->transaksiDataIkuk)
            ->where('status_finalisasi_auditor2', true)
            ->pluck('tanggal_status_finalisasi_auditor2')
            ->first();

        // dump("date finalisasi audite : $formatTanggalFinalisasiAudite");
        // dump("date finalisasi auditor1 : $tanggalFinalisasiAuditor1");
        // dump("date finalisasi auditor2 : $tanggalFinalisasiAuditor2");
        // dump($dataUnit->toArray());

        return view('data_audite.persetujuan.persetujuan', [
            'title' => 'persetujuan',
            'date' => $date,
            'audite' => [
                'nama' => $nama_audite,
                'nama_unit' => $nama_unit,
                'status' => 'audite',
                'status_finalisasi' => $statusFinalisasiAudite ? true : false,
                'tanggal_finalisasi_audite' => $formatTanggalFinalisasiAudite ?? $date,
            ],
            'auditor1' => [
                'nama' => $auditor1,
                'status' => 'Ketua Auditor',
                'status_finalisasi' => $statusFinalisasiAuditor1 ? true : false,
                'tanggal_finalisasi_auditor1' => $tanggalFinalisasiAuditor1 ?? $date,
            ],
            'auditor2' => [
                'nama' => $auditor2,
                'status' => 'Anggota Auditor',
                'status_finalisasi' => $statusFinalisasiAuditor2 ? true : false,
                'tanggal_finalisasi_auditor2' => $tanggalFinalisasiAuditor2 ?? $date,
            ],
            'statusFinalisasiAudite' => $statusFinalisasiAudite,
            'data_unit' => $dataUnit,
            'nama_unit' => $nama_unit,
        ]);
    }

    public function finalisasi(Request $request)
    {
        // dump(session()->all());
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        // Ambil data indikator berdasarkan unit_id dan jadwal_ami_id
        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;
        $unitId = session('audite.unit_id'); // Mengambil unit_id dari session

        // Conditional Cek jika semua data belum diisi berdasarkan hasi_audit dan realisasi_ikuk
        $cekPengisian = TransaksiData::whereHas('indikator_ikuk', function ($query) use ($unitId) {
            $query->where('unit_id', $unitId);
        })
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->whereNull('hasil_audit')
            ->whereNull('realisasi_ikuk')
            ->exists();

        if ($cekPengisian) {
            return redirect()->back()->with('error', 'Semua data isian indikator kinerja unit kerja harus diisi sebelum melakukan finalisasi.');
        }

        // Finalisasi semua transaksi yang terkait
        $updated = TransaksiData::whereHas('indikator_ikuk', function ($query) use ($unitId) {
            $query->where('unit_id', $unitId);
        })
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->update([
                'status_finalisasi_audite' => true,
                'tanggal_status_finalisasi_audite' => now()
            ]);
        if ($updated > 0) {
            return redirect()->back()->with('success', 'Finalisasi berhasil dilakukan. Semua data telah terkunci.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada data yang bisa difinalisasi.');
        }
    }
}
