<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HospitalEquipmentController;
use App\Http\Controllers\LogistikController;

// Rute untuk login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Catch-all dashboard route that redirects based on role
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    
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
})->name('dashboard');

// Rute untuk Manager
Route::middleware(['auth', 'role:manager'])->prefix('manager')->group(function () {
    Route::get('/', function () {
        return view('manager.dashboard');
    })->name('manager.dashboard');
});

// Rute untuk Perawat
Route::middleware(['auth', 'role:perawat'])->prefix('perawat')->group(function () {
    Route::get('/', function () {
        return view('perawat.dashboard');
    })->name('perawat.dashboard');
});

// Rute untuk Logistik
Route::middleware(['auth', 'role:logistik'])->prefix('logistik')->group(function () {
    // Dashboard
    Route::get('/', [LogistikController::class, 'dashboard'])->name('logistik.dashboard');
    
    // Equipment Management
    Route::resource('equipment', HospitalEquipmentController::class);
    
    // Equipment Location API
    Route::get('/equipment/get-floors', [HospitalEquipmentController::class, 'getFloors'])->name('equipment.getFloors');
    Route::get('/equipment/get-rooms', [HospitalEquipmentController::class, 'getRooms'])->name('equipment.getRooms');
    
    // Tambahkan rute untuk mengakses halaman perawat
    Route::get('/perawat', function () {
        return redirect()->route('perawat.dashboard');
    })->name('logistik.to.perawat');
});