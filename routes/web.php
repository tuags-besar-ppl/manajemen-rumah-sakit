<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute untuk login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Catch-all dashboard route that redirects based on role
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    
    switch ($user->role) {
        case 'manager':
            return redirect()->route('dashboard-manager');
        case 'logistik':
            return redirect()->route('dashboard-logistik');
        case 'perawat':
            return redirect()->route('dashboard-perawat');
        default:
            return redirect('/');
    }
})->name('dashboard');

// Rute untuk dashboard Manager
Route::middleware(['auth', 'role:manager'])->get('/dashboard-manager', function () {
    return view('manager.dashboard');  // Mengarahkan ke dashboard Manager
})->name('dashboard-manager');

Route::middleware(['auth', 'role:logistik'])->get('/dashboard-logistik', function () {
    return view('logistik.dashboard');  // Mengarahkan ke dashboard Logistik
})->name('dashboard-logistik');

Route::middleware(['auth', 'role:perawat'])->get('/dashboard-perawat', function () {
    return view('perawat.dashboard');  // Mengarahkan ke dashboard Perawat
})->name('dashboard-perawat');

Route::middleware(['auth', 'role:perawat'])->get('/pelaporan-alat', function () {
    return view('perawat.pelaporan-alat');
})->name('pelaporan-alat');

Route::middleware(['auth', 'role:perawat'])->get('/pinjam-alat', function () {
    return view('perawat.pinjam-alat');
})->name('pinjam-alat');

Route::middleware(['auth', 'role:perawat'])->get('/lapor-kerusakan-alat', function () {
    return view('perawat.lapor-kerusakan-alat');
})->name('lapor-kerusakan-alat');

Route::middleware(['auth', 'role:perawat'])->get('/history-status-report', function () {
    return view('perawat.history-status-report');
})->name('history-status-report');