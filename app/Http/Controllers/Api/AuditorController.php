<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Auditor;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    public function index()
    {
        $auditor = Auditor::with([
            'units:unit_id,nama_unit',
            'auditor1:user_id,nama',
            'auditor2:user_id,nama',
            
        ])->get();
        return response()->json(['data' => $auditor]);
    }
}
