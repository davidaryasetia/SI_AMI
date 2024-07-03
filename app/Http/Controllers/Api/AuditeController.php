<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditeController extends Controller
{
    public function index()
    {
        $audite = Unit::with([
            'users:user_id,unit_id,unit_cabang_id,nama', 
            'unit_cabang:unit_cabang_id,unit_id,nama_unit_cabang'
        ])->get();
        return response()->json(['data_audite' => $audite]);
    }
}
