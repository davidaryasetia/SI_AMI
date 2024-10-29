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
            session(['roles' => $roles]);

            if (count($roles) > 1) {
                return redirect()->route('choose.role');
            } else {
                session(['active_role' => $roles[0]]);
                return $this->redirectToRole($roles[0]);
            }

            // Jika user tidak memiliki role yang valid
            // return redirect()->route('login')->with('error', 'Anda tidak memiliki akses role yang valid.');
        } else {
            // Jika email atau password salah
            return redirect()->back()->with('error', 'Email atau password salah.');
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
