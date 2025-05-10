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
            
            // Redirect based on user role
            $user = Auth::user();
            switch ($user->role) {
                case 'manager':
                    return redirect()->route('dashboard-manager');
                case 'logistik':
                    return redirect()->route('dashboard-logistik');
                case 'perawat':
                    return redirect()->route('dashboard-perawat');
                default:
                    // Default fallback if role doesn't match
                    return redirect('/');
            }
        }
    
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
