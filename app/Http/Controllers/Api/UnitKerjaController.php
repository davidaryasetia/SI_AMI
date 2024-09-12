<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitKerjaController extends Controller
{
    public function index()
    {
        $unit_kerja = Unit::with('unit_cabang:unit_id,unit_cabang_id,nama_unit_cabang')->get();
        return response()->json(['data_unit_kerja' => $unit_kerja]);
    }
}
