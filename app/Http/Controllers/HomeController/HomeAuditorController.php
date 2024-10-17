<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAuditorController extends Controller
{
    public function HomeAuditor()
    {
        return view('data_auditor.home_auditor.beranda', [
            'title' => 'Auditor', 
        ]);
    }
}
