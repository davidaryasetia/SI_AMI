<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YourController extends Controller
{
    public function setActiveRole(Request $request)
    {
        $activeRole = $request->input('active_role');

        // Validasi apakah role yang dikirim valid
        if (in_array($activeRole, ['admin', 'audite', 'auditor'])) {
            // Simpan role yang dipilih ke session
            session(['active_role' => $activeRole]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

}
