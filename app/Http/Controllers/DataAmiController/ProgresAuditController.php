<?php

namespace App\Http\Controllers\DataAmiController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProgresAuditController extends Controller
{
    public function index(Request $request)
    {
        $jadwalAmiId = $request->query('jadwal_ami_id'); // Ambil parameter jadwal AMI

        // Ambil semua jadwal periode
        $jadwalPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->get();

        // Jika tidak ada jadwal sama sekali dalam database
        if ($jadwalPeriode->isEmpty()) {
            return redirect()->route('progress.audit')->with('error', 'Tidak ada jadwal AMI yang tersedia.');
        }


        // Ambil data unit dengan relasi untuk audite, auditor, dan transaksi data
        $dataIndikator = Unit::with([
            'units_cabang.audites.user_audite:user_id,nama',
            'audite.user_audite:user_id,nama',
            'auditor.auditor1:user_id,nama',
            'auditor.auditor2:user_id,nama',
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            },
        ])->get();

        // Hitung persentase pengisian untuk setiap unit
        $dataPengisian = collect(); // Default sebagai collection kosong

        if ($jadwalAmiId) {
            $dataPengisian = $dataIndikator->map(function ($unit) {
                $totalIndikator = $unit->indikator_ikuk->count();
                $filledIndikator = $unit->indikator_ikuk->filter(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_pengisian_audite', true)->count() > 0;
                })->count();
        
                $persentase = $totalIndikator > 0 ? round(($filledIndikator / $totalIndikator) * 100, 2) : 0;
        
                $statusFinalisasiAuditor1 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor1', true)->count() > 0;
                });
        
                $statusFinalisasiAuditor2 = $unit->indikator_ikuk->isNotEmpty() && $unit->indikator_ikuk->every(function ($indikator) {
                    return $indikator->transaksiDataIkuk->where('status_finalisasi_auditor2', true)->count() > 0;
                });
        
                return [
                    'nama_unit' => $unit->nama_unit,
                    'audite' => $unit->audite[0]['user_audite']['nama'] ?? null,
                    'auditor1' => $unit->auditor->auditor1->nama ?? null,
                    'auditor2' => $unit->auditor->auditor2->nama ?? null,
                    'persentase_audite' => $persentase,
                    'totalIndikator' => $totalIndikator,
                    'filledIndikator' => $filledIndikator,
                    'status_finalisasi_auditor1' => $statusFinalisasiAuditor1,
                    'status_finalisasi_auditor2' => $statusFinalisasiAuditor2,
                ];
            });

            $totalPersentaseAudite = $dataPengisian->sum('persentase_audite');
            $jumlahUnit = $dataPengisian->count();
    
            // Rata-rata persentase pengisian semua unit
            $rataPersentasePengisian = $jumlahUnit > 0 ? round($totalPersentaseAudite / $jumlahUnit, 1) : 0;
        } else {
            $dataPengisian = collect();
            $rataPersentasePengisian = 0;
        }

        // dump($dataPengisian->toArray());
        // Kembalikan view dengan data
        return view('data_ami.progres_audit.progres', data: [
            'dataPengisian' => $dataPengisian,
            'jadwalPeriode' => $jadwalPeriode,
            'jadwalAmiId' => $jadwalAmiId,
            'rataPersentasePengisian' => $rataPersentasePengisian, 
        ]);
    }
}
