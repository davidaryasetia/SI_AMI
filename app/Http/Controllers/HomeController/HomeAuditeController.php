<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use App\Models\PeriodePelaksanaan;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class HomeAuditeController extends Controller
{
    public function HomeAudite()
    {
        // Mendapatkan unit_id dari session audite
        $unitId = session('audite.unit.unit_id');
        $nama_unit = session('audite.unit.nama_unit');

        $auditorData = Auditor::where('unit_id', $unitId)->first();
        
        if ($auditorData) {
            $auditor_1 = User::find($auditorData->auditor_1);
            $auditor_2 = User::find($auditorData->auditor2);
            
            $auditor1 = $auditor_1 ? $auditor_1->nama : null;
            $auditor2 = $auditor_2 ? $auditor_2->nama : null;
        }

        // Mendapatkan data Jadwal Pelaksanaan
        $currentPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$currentPeriode) {
            $currentPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }
     
        return view('data_audite.home_audite.beranda', [
            'title' => 'Audite',
            'current_periode' => $currentPeriode,
            'auditor1' => $auditor1, 
            'auditor2' => $auditor2, 
        ]);
    }
}
