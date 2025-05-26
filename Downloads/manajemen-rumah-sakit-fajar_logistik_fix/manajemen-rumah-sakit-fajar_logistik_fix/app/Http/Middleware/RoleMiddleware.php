<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Jika user adalah manager, izinkan akses ke semua rute
        if ($user->role === 'manager') {
            return $next($request);
        }

        // Jika user adalah logistik, izinkan akses ke rute logistik dan perawat
        if ($user->role === 'logistik' && ($role === 'logistik' || $role === 'perawat')) {
            return $next($request);
        }

        // Jika user adalah perawat, hanya izinkan akses ke rute perawat
        if ($user->role === 'perawat' && $role === 'perawat') {
            return $next($request);
        }

        // Jika tidak memenuhi syarat di atas, redirect ke dashboard sesuai role
        return redirect()->route($user->role . '.dashboard')
            ->withErrors(['role' => 'Anda tidak memiliki akses ke halaman tersebut']);
    }
}
