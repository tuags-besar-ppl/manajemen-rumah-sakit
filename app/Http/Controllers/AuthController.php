<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('login');
    }

    // Menangani login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Helper method untuk redirect berdasarkan role
    private function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'manager':
                return redirect()->route('manager.dashboard');
            case 'logistik':
                return redirect()->route('logistik.dashboard');
            case 'perawat':
                return redirect()->route('perawat.dashboard');
            default:
                return redirect('/');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
