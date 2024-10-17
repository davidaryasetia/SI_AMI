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
            session(['roles' => $roles, 'active_role' => $roles[0]]);


            // Redirect sesuai role yang aktif
            $activeRole = session('active_role');
            if ($activeRole == 'admin') {
                return redirect('/home');
            } elseif ($activeRole == 'auditor') {
                return redirect('/home/auditor');
            } elseif ($activeRole == 'audite') {
                return redirect('/home/audite');
            }

            // Jika user tidak memiliki role yang valid
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses role yang valid.');
        } else {
            // Jika email atau password salah
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
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
