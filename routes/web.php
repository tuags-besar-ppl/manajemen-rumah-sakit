<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use App\Models\DamageReport;
use App\Http\Controllers\NotificationController;

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
    $statistics = [
        'total' => Equipment::count(),
        'tersedia' => Equipment::where('status', 'tersedia')->count(),
        'sedang_digunakan' => Equipment::where('status', 'sedang_digunakan')->count(),
        'rusak' => DamageReport::where('status', 'diajukan')->count(),
    ];

    $recentEquipment = Equipment::latest()->take(5)->get();
    $lowStockEquipments = Equipment::where('quantity', '<=', 10)->get();

    return view('manager.dashboard', compact('statistics', 'recentEquipment', 'lowStockEquipments'));
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
    $statistics = [
        'total' => \App\Models\Equipment::count(),
        'tersedia' => \App\Models\Equipment::where('status', 'tersedia')->count(),
        'sedang_digunakan' => \App\Models\Equipment::where('status', 'sedang_digunakan')->count(),
        'rusak' => \App\Models\Equipment::where('status', 'rusak')->count(),
    ];
    $recentEquipment = \App\Models\Equipment::latest()->take(5)->get();
    return view('perawat.dashboard', compact('statistics', 'recentEquipment'));
})->name('dashboard-perawat');

Route::middleware(['auth', 'role:perawat'])->get('/pelaporan-alat', function () {
    return view('perawat.pelaporan-alat');
})->name('pelaporan-alat');

Route::middleware(['auth', 'role:perawat'])->get('/pinjam-alat', function () {
    return view('perawat.pinjam-alat');
})->name('pinjam-alat');

Route::middleware(['auth', 'role:perawat'])->get('/lapor-kerusakan-alat', function () {
    $equipments = \App\Models\Equipment::all();
    return view('perawat.lapor-kerusakan-alat', compact('equipments'));
})->name('lapor-kerusakan-alat');

Route::middleware(['auth', 'role:perawat'])->get('/history-status-report', function () {
    $reports = DamageReport::where('user_id', auth()->id())->latest()->get();
    return view('perawat.history-status-report', compact('reports'));
})->name('history-status-report');
// Route untuk menyimpan laporan kerusakan alat
Route::middleware(['auth', 'role:perawat'])->post('/lapor-kerusakan-alat', function () {
    $validated = request()->validate([
        'alat_id' => 'required',
        'deskripsi_kerusakan' => 'required|string',
        'tanggal_kerusakan' => 'required|date',
        'lokasi' => 'required|string',
        'prioritas' => 'required|in:rendah,sedang,tinggi,kritis'
    ]);

    // Simpan data ke tabel damage_reports
    DamageReport::create([
        'alat_id' => $validated['alat_id'],
        'user_id' => auth()->id(),
        'deskripsi_kerusakan' => $validated['deskripsi_kerusakan'],
        'tanggal_kerusakan' => $validated['tanggal_kerusakan'],
        'lokasi' => $validated['lokasi'],
        'prioritas' => $validated['prioritas'],
        'status' => 'diajukan'
    ]);
    return redirect()->route('lapor-kerusakan-alat')->with('success', 'Laporan kerusakan berhasil disimpan');
})->name('perawat.lapor-kerusakan.store');

Route::middleware(['auth', 'role:logistik'])->resource('equipment', App\Http\Controllers\Logistik\EquipmentController::class);
Route::middleware(['auth', 'role:manager'])->resource('equipment', App\Http\Controllers\Logistik\EquipmentController::class);

// Routes for Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/email', [App\Http\Controllers\Manager\EmailController::class, 'index'])->name('manager.email');
    Route::post('/manager/email/send', [App\Http\Controllers\Manager\EmailController::class, 'send'])->name('manager.email.send');
    
    // Equipment routes for manager
    Route::get('/manager/equipment', [App\Http\Controllers\Manager\EquipmentController::class, 'index'])->name('equipment.index');
    Route::get('/manager/equipment/create', [App\Http\Controllers\Manager\EquipmentController::class, 'create'])->name('equipment.create');
    Route::post('/manager/equipment', [App\Http\Controllers\Manager\EquipmentController::class, 'store'])->name('equipment.store');
    Route::get('/manager/equipment/{equipment}/edit', [App\Http\Controllers\Manager\EquipmentController::class, 'edit'])->name('equipment.edit');
    Route::put('/manager/equipment/{equipment}', [App\Http\Controllers\Manager\EquipmentController::class, 'update'])->name('equipment.update');
    Route::delete('/manager/equipment/{equipment}', [App\Http\Controllers\Manager\EquipmentController::class, 'destroy'])->name('equipment.destroy');

    // Damage report routes
    Route::get('/manager/reports', [App\Http\Controllers\Manager\DamageReportController::class, 'index'])->name('manager.reports.index');
    Route::put('/manager/reports/{report}/update-status', [App\Http\Controllers\Manager\DamageReportController::class, 'updateStatus'])->name('manager.reports.update-status');
});

// Notification Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);
});