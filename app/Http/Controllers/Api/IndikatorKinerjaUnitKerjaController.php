<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class IndikatorKinerjaUnitKerjaController extends Controller
{
    public function index()
    {
        $ikuk = Unit::with([
            'indikator_ikuk:indikator_kinerja_unit_kerja_id,unit_id,kode_ikuk,isi_indikator_kinerja_unit_kerja,satuan_ikuk,target_ikuk'
        ])->get();

        return response()->json(['data_indikator_kinerja_unit_kerja' => $ikuk]);
    }
}
