<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAuditeController extends Controller
{
    public function HomeAudite()
    {
        return view('data_audite.home_audite.beranda', [
            'title' => 'Audite', 
        ]);
    }
}
