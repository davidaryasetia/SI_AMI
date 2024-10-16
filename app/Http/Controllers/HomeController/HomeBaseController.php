<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeBaseController extends Controller
{
    public function HomeAudite()
    {
        return view('data_audite.home_audite.beranda', [
            'title' => 'Audite', 
        ]);
    }

    public function HomeAuditor()
    {
        return view('data_auditor.home_auditor.beranda', [
            'title' => 'Auditor', 
        ]);
    }
}
