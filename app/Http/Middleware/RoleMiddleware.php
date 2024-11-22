<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Jika user tidak login, redirect ke login
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user memiliki salah satu dari roles yang diterima
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                // dd('Role matched: ' . $role);
                return $next($request); // Lanjutkan jika role sesuai
            }
        }

        // Jika user tidak memiliki role yang sesuai, arahkan ke halaman forbidden
        return response()->view('errors.403', [], 403);
    }
}