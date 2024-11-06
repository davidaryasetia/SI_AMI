<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use App\Models\PeriodePelaksanaan;
use Illuminate\Http\Request;

class HomeAuditorController extends Controller
{
    public function HomeAuditor()
    {
        $currentPeriode = PeriodePelaksanaan::where('status', 'Sedang Berjalan')
            ->orderBy('tanggal_pembukaan_ami', 'desc')
            ->first();

        if (!$currentPeriode){
            $currentPeriode = PeriodePelaksanaan::orderBy('tanggal_pembukaan_ami', 'desc')->first();
        }

        return view('data_auditor.home_auditor.beranda', [
            'title' => 'Auditor', 
            'current_periode' => $currentPeriode, 
        ]);
    }
}
