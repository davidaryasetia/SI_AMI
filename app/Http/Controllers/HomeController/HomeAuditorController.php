<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use Illuminate\Http\Request;

class HomeAuditorController extends Controller
{
    public function HomeAuditor(Request $request)
    {
        $auditorUnits = collect(session('auditor'))->pluck('units.unit_id')->unique();
        $units = Unit::whereIn('unit_id', $auditorUnits)->orderBy('unit_id')->get();
        $unitId = $request->input('unit_id');

        // Mendapatkan data jadwal pelaksanaan terakhir yang sedang berjalan
        $periodeTerbaru = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        // Jika tidak ada periode berjalan, ambil periode terakhir jika ada
        if (!$periodeTerbaru) {
            $periodeTerbaru = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        // Jika tidak ada periode  sama sekali, set data default
        $jadwalAmiId = $periodeTerbaru ? $periodeTerbaru->jadwal_ami_id : null;

        $data_indikator = Unit::with([
            'indikator_ikuk.transaksiDataIkuk' => function ($query) use ($jadwalAmiId) {
                $query->where('jadwal_ami_id', $jadwalAmiId);
            }
        ])
            ->where('unit_id', $unitId)
            ->first();

        // Ambil nama unit berdasarkan unitId
        if ($unitId){
            $nama_unit = $units->where('unit_id', $unitId)->first()->nama_unit ?? '-';
        } else {
            $nama_unit = "- [ Pilih Unit Kerja Terlebih Dahulu ]";
        }


        // Hitung jumlah target dan capaian
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
        $totalCapaian = $melampauiTarget + $memenuhi + $belumMemenuhi;
        $persentaseMelampaui = $totalCapaian > 0 ? round(($melampauiTarget / $totalCapaian) * 100, 2) : 0;
        $persentaseMemenuhi = $totalCapaian > 0 ? round(($memenuhi / $totalCapaian) * 100, 2) : 0;
        $persentaseBelumMemenuhi = $totalCapaian > 0 ? round(($belumMemenuhi / $totalCapaian) * 100, 2) : 0;
       
        return view('data_auditor.home_auditor.beranda', [
            'title' => 'Auditor',
            'current_periode' => $periodeTerbaru,
            'nama_unit' => $nama_unit, 
            'melampauiTarget' => $melampauiTarget, 
            'memenuhi' => $memenuhi, 
            'belumMemenuhi' => $belumMemenuhi, 
            'totalCapaian' => $totalCapaian,
            'persentaseMelampaui' => $persentaseMelampaui ,
            'persentaseMemenuhi' => $persentaseMemenuhi, 
            'persentaseBelumMemenuhi' => $persentaseBelumMemenuhi,  
        ]);
    }
}
