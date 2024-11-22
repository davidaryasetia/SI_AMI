<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan dan password benar
        if ($user && Hash::check($request->password, $user->password)) {
            // Login user
            Auth::login($user);

            // Tentukan role yang dimiliki user dan simpan di session
            $roles = $user->hasMultipleRoles();
            // dd($roles);
            session(['roles' => $roles]);

            $unitData = [];

            // Data Unit audite
            if (in_array('audite', $roles)) {
                $auditeData = $user->audite()->with('units', 'units_cabang')->first();
                if ($auditeData){
                    $unit = [
                     'unit_id' => $auditeData->units->unit_id ?? null, 
                     'nama_unit' => $auditeData->units->nama_unit ?? null,    
                    ];

                    if ($auditeData->units->tipe_data === 'departemen_kerja'){
                        $unit['units_cabang'] = $auditeData->units_cabang ? [
                            'unit_cabang_id' => $auditeData->units_cabang->unit_cabang_id ?? null, 
                            'nama_unit_cabang' => $auditeData->units_cabang->nama_unit_cabang ?? null,
                        ] : null;
                    } else {
                        $unit['units_cabang'] = null;
                    }

                    $unitData['audite'] = ['unit'=>$unit];
                }

            }


            // Data Unit auditor 
            if (in_array('auditor', $roles)){
                $auditorData1Units = $user->auditor1()->with('units')->get();
                $auditorData2Units = $user->auditor2()->with('units')->get();

                $unitData['auditor'] = [];

                // Loop untuk unit auditor 1
                foreach ($auditorData1Units as $auditorData){
                    if ($auditorData->units){
                        $unit = [
                            'unit_id' => $auditorData->units->unit_id ?? null, 
                            'nama_unit' => $auditorData->units->nama_unit ?? null, 
                            'status_auditor' => 'auditor_1'
                        ];

                        if ($auditorData->units->tipe_data == 'departemen_kerja'){
                            $unit['unit_cabang'] = $auditorData->units->units_cabang ? [
                                'unit_cabang_id' => $auditorData->units->units_cabang->unit_cabang_id ?? null, 
                                'nama_unit_cabang' => $auditorData->units->units_cabang->nama_unit_cabang ?? null, 
                            ] : null;
                        } else {
                            $unit['unit_cabang'] = null;
                        }

                        $unitData['auditor'][] = ['units' => $unit];
                    }
                }

                // Loop untuk unit dimana user adalah auditor_2
                foreach ($auditorData2Units as $auditorData){
                    if ($auditorData->units){
                        $unit = [
                            'unit_id' => $auditorData->units->unit_id ?? null, 
                            'nama_unit' => $auditorData->units->nama_unit ?? null, 
                            'status_auditor' => 'auditor_2', 
                        ];  

                        if ($auditorData->units->tipe_data === 'departemen_kerja'){
                            $unit['units_cabang'] = $auditorData->units->units_cabang ? [
                                'unit_cabang_id' => $auditorData->units_cabang->unit_cabang_id ?? null, 
                                'nama_unit_cabang' => $auditorData->units_cabang->nama_unit_cabang ?? null, 
                            ] : null;
                        } else {
                            $unit['unit_cabang'] = null;
                        }

                        $unitData['auditor'][] = ['units' => $unit];
                    }
                }
            }

            session($unitData);
            // dd($unitData);

            if (count($roles) > 1) {
                return redirect()->route('choose.role');
            } elseif (count($roles) === 1) {
                session(['active_role' => $roles[0]]);
                return $this->redirectToRole($roles[0]);
            } else {
                // Jika user tidak memiliki role yang valid
                return redirect()->route('errors.403');
            }
            
        } else {
            // Jika email atau password salah
            return redirect()->back()->with('error', 'Email atau password salah !!!');
        }
    }


    private function redirectToRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect('/home');
            case 'auditor':
                return redirect('/home/auditor');
            case 'audite':
                return redirect('/home/audite');
            default:
                return redirect()->route('login')->with('error', 'Anda tidak memiliki akses role yang valid');
        }
    }

    public function chooseRole()
    {
        $roles = session('roles', []);

        if (count($roles) === 1) {
            return $this->redirectToRole($roles[0]);
        }
        return view('choose_role.choose_role', compact('roles'));
    }

    public function selectRole(Request $request)
    {
        $role = $request->input('role');
        session(['active_role' => $role]);

        return $this->redirectToRole($role);
    }

    // Tambahkan di controller Anda, misalnya di UserController atau AuthController
    public function switchRole(Request $request)
    {
        $newRole = $request->input('role');

        // Cek apakah role baru ini ada di array roles dalam session
        if (in_array($newRole, session('roles', []))) {
            session(['active_role' => $newRole]);
            return response()->json(['status' => 'success', 'message' => 'Role changed successfully.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid role.'], 400);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
