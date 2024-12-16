<?php

namespace App\Http\Controllers\DataAuditorController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\TransaksiData;
use App\Models\Unit;
use Illuminate\Http\Request;

class PengisianKinerjaAuditorController extends Controller
{
    public function index(Request $request)
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


        // Ambil unit yang terkait dengan auditor dari session
        $userId = session('user_id');
        $auditorUnits = collect(session('auditor'))->pluck('unit_id')->unique();
        $units = Unit::whereIn('unit_id', $auditorUnits)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->orderBy('unit_id')->get();
        $unitId = $request->input('unit_id');

        // Jika unit belum dipilih, kosongkan data_indikator
        if (!$unitId) {
            $data_indikator = null;
            $nama_unit = '-';
        } else {
            // Ambil periode pelaksanaan terbaru
            $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
                ->orderBy('tanggal_pembukaan_ami', 'desc')
                ->first();

            if (!$periodeTerbaru) {
                $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
            }

            // Ambil data indikator berdasarkan unit_id dan jadwal_ami_id
            $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;


            $data_indikator = Unit::with([
                'auditor.auditor1:user_id,nama',
                'auditor.auditor2:user_id,nama',
                'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                    $query->where('jadwal_ami_id', $jadwalAmiId);
                }
            ])
                ->where('unit_id', $unitId)
                ->where('jadwal_ami_id', $jadwalAmiId)
                ->first();

            // Ambil nama unit berdasarkan unitId
            $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        }

        // Mengambil Data Ketua auditor atau Anggota Auditor
        $isKetuaAuditor = false;
        $isAnggotaAuditor = false;

        if (isset($data_indikator->auditor->auditor1) && $data_indikator->auditor->auditor1->user_id == $userId) {
            $isKetuaAuditor = true;
        }

        if (isset($data_indikator->auditor->auditor2) && $data_indikator->auditor->auditor2->user_id == $userId) {
            $isAnggotaAuditor = true;
        }

        // Hitung jumlah berdasarkan kondisi
        $melampauiTarget = 0;
        $memenuhi = 0;
        $belumMemenuhi = 0;

        if ($data_indikator) {
            foreach ($data_indikator->indikator_ikuk as $indikator) {
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

        }


        $totalKinerja = $melampauiTarget + $memenuhi + $belumMemenuhi;

        // dump($data_indikator->toArray()); 


        $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        return view('data_auditor.pengisian_kinerja.pengisian_kinerja_auditor', [
            'title' => 'Pengisian Kinerja Auditor',
            'units' => $units,
            'isKetuaAuditor' => $isKetuaAuditor,
            'isAnggotaAuditor' => $isAnggotaAuditor,
            'data_indikator' => $data_indikator,
            'unit_id' => $unitId,
            'nama_unit' => $nama_unit,
            'melampauiTarget' => $melampauiTarget,
            'memenuhi' => $memenuhi,
            'belumMemenuhi' => $belumMemenuhi,
            'totalKinerja' => $totalKinerja,
        ]);
    }

    public function updateStatusAuditor(Request $request, $id)
    {
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        // Ambil data indikator berdasarkan unit_id dan jadwal_ami_id
        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;

        $transaksi = TransaksiData::where('transaksi_data_ikuk_id', $id)
            ->where('jadwal_ami_id', $jadwalAmiId)
            ->firstOrFail();

        if ($transaksi->status_pengisian_auditor) {
            return redirect()->back()->with('error', 'Transaksi ini sudah terkonfirmasi');
        }

        $transaksi->update([
            'hasil_audit' => $request->input('hasil_audit'),
            'status_pengisian_auditor' => true,
        ]);

        return redirect()->back()->with('success', 'Status capaian dan pengisian auditor berhasil diperbarui');
    }
}
