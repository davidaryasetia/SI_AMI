<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::with([
            'unit_audite:unit_id,nama_unit',
            'unit_cabang_audite:unit_cabang_id,unit_id,nama_unit_cabang'
        ])->get();

        return response()->json(['Data User' => $user]);
    }
}
