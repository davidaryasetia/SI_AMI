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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // Simpan role ke session
            $roles = [];
            if ($user->isAdmin())
                $roles[] = 'admin';
            if ($user->isAudite())
                $roles[] = 'audite';
            if ($user->isAuditor())
                $roles[] = 'auditor';

            session([
                'nama' => $user->nama,
                'email' => $user->email,
                'nip' => $user->nip,
                // 'roles' => $roles, // Simpan semua roles yang dimiliki user
                'is_admin' => in_array('admin', $roles) ? 'Yes' : 'No',
                'is_auditor' => in_array('auditor', $roles) ? 'Yes' : 'No',
                'is_audite' => in_array('audite', $roles) ? 'Yes' : 'No',
            ]);

            session(['roles' => $roles]);
            // Jika user memiliki lebih dari satu role, arahkan ke halaman pemilihan role
            if (count($roles) > 1) {
                return redirect()->route('home.index')->with('multiple_roles', true); // Tampilkan dropdown role di halaman home
            }

            // Jika user hanya memiliki satu role, arahkan langsung ke halaman role tersebut
            if ($user->isAdmin()) {
                return redirect()->route('home.index');
            } elseif ($user->isAudite()) {
                return redirect()->route('home.audite');
            } elseif ($user->isAuditor()) {
                return redirect()->route('home.auditor');
            }

            return redirect()->route('home.index')->with('error', 'Tidak memiliki akses role yang valid.');
        } else {
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
