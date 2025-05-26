<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;

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
    $statistics = [
        'total' => Equipment::count(),
        'tersedia' => Equipment::where('status', 'tersedia')->count(),
        'sedang_digunakan' => Equipment::where('status', 'sedang_digunakan')->count(),
        'rusak' => Equipment::where('status', 'rusak')->count(),
    ];

    $recentEquipment = Equipment::latest()->take(5)->get();
    $lowStockEquipments = Equipment::where('quantity', '<=', 10)->get();

    return view('logistik.dashboard', compact('statistics', 'recentEquipment', 'lowStockEquipments'));
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
// Route untuk menyimpan laporan kerusakan alat
Route::middleware(['auth', 'role:perawat'])->post('/lapor-kerusakan-alat', function () {
    // Validasi input
    $validated = request()->validate([
        'alat_id' => 'required',
        'deskripsi_kerusakan' => 'required|string',
        'tanggal_kerusakan' => 'required|date',
        'lokasi' => 'required|string',
        'prioritas' => 'required|in:rendah,sedang,tinggi,kritis'
    ]);

    // TODO: Simpan data ke database
    // Untuk sementara kita redirect kembali ke halaman form dengan pesan sukses
    return redirect()->route('lapor-kerusakan-alat')->with('success', 'Laporan kerusakan berhasil disimpan');
})->name('perawat.lapor-kerusakan.store');

Route::middleware(['auth', 'role:logistik'])->resource('equipment', App\Http\Controllers\Logistik\EquipmentController::class);