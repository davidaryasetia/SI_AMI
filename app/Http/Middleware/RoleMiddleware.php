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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if ($user) {
            foreach ($roles as $role) {
                if ($user->hasRole(role: $role)) {
                    return $next($request);
                }
            }
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki akses.');
    }
}
 