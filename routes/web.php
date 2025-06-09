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
        'laporan' => DamageReport::where('status', 'diajukan')->count(),
    ];

    $recentEquipment = Equipment::latest()->take(5)->get();
    $lowStockEquipments = Equipment::where('quantity', '<=', 10)->get();

    return view('manager.dashboard', compact('statistics', 'recentEquipment', 'lowStockEquipments'));
})->name('dashboard-manager');

// Rute untuk dashboard Logistik
Route::middleware(['auth', 'role:logistik'])->group(function () {
    Route::get('/dashboard-logistik', [App\Http\Controllers\LogisticController::class, 'index'])->name('dashboard-logistik');
    Route::get('/logistik/laporan-kerusakan', [App\Http\Controllers\LogisticController::class, 'showDamageReports'])->name('logistic.damage-reports.index');
    Route::post('/reports/{report}/confirm', [App\Http\Controllers\LogisticController::class, 'confirmReport'])->name('logistic.reports.confirm');
    Route::delete('/reports/{report}', [App\Http\Controllers\LogisticController::class, 'destroy'])->name('logistic.reports.destroy');
    Route::get('/logistik/permintaan-peminjaman', [App\Http\Controllers\LogisticController::class, 'showEquipmentRequests'])->name('logistic.equipment-requests.index');
    Route::post('/logistik/permintaan-peminjaman/{request}/approve', [App\Http\Controllers\LogisticController::class, 'approveEquipmentRequest'])->name('logistic.equipment-requests.approve');
    Route::post('/logistik/permintaan-peminjaman/{request}/reject', [App\Http\Controllers\LogisticController::class, 'rejectEquipmentRequest'])->name('logistic.equipment-requests.reject');
    Route::delete('/logistik/permintaan-peminjaman/{request}', [App\Http\Controllers\LogisticController::class, 'destroyEquipmentRequest'])->name('logistic.equipment-requests.destroy');

    // Equipment routes for logistik
    Route::resource('/logistik/equipment', App\Http\Controllers\Logistik\EquipmentController::class)->names('logistic.equipment');
});

Route::middleware(['auth', 'role:perawat'])->get('/dashboard-perawat', function () {
    $statistics = [
        'total' => \App\Models\Equipment::count(),
        'tersedia' => \App\Models\Equipment::where('status', 'tersedia')->count(),
        'sedang_digunakan' => \App\Models\Equipment::where('status', 'sedang_digunakan')->count(),
        'rusak' => \App\Models\Equipment::where('status', 'rusak')->count(),
    ];
    $recentEquipment = \App\Models\Equipment::latest()->get();
    return view('perawat.dashboard', compact('statistics', 'recentEquipment'));
})->name('dashboard-perawat');

Route::middleware(['auth', 'role:perawat'])->group(function () {
    // Pelaporan Alat Routes
    Route::get('/pelaporan-alat', function () {
        return view('perawat.pelaporan-alat');
    })->name('pelaporan-alat');

Route::middleware(['auth', 'role:perawat'])->get('/pinjam-alat', function () {
    return view('perawat.pinjam-alat');
})->name('pinjam-alat');

Route::get('/lapor-kerusakan-alat', function () {
    $equipments = \App\Models\Equipment::all();
    return view('perawat.lapor-kerusakan-alat', compact('equipments'));
})->name('perawat.lapor-kerusakan.create');

Route::middleware(['auth', 'role:perawat'])->get('/history-status-report', function () {
    $reports = DamageReport::where('user_id', auth()->id())->latest()->get();
    return view('perawat.history-status-report', compact('reports'));
})->name('history-status-report');

    Route::post('/lapor-kerusakan-alat', function () {
        $validated = request()->validate([
            'alat_id' => 'required',
            'deskripsi_kerusakan' => 'required|string',
            'tanggal_kerusakan' => 'required|date',
            'lokasi' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi,kritis'
        ]);

        \App\Models\DamageReport::create([
            'alat_id' => $validated['alat_id'],
            'user_id' => auth()->id(),
            'deskripsi_kerusakan' => $validated['deskripsi_kerusakan'],
            'tanggal_kerusakan' => $validated['tanggal_kerusakan'],
            'lokasi' => $validated['lokasi'],
            'prioritas' => $validated['prioritas'],
            'status' => 'diajukan'
        ]);

        return redirect()->route('history-status-report')->with('success', 'Laporan kerusakan berhasil disimpan');
    })->name('perawat.lapor-kerusakan.store');

    Route::get('/history-status-report', function () {
        $reports = \App\Models\DamageReport::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('perawat.history-status-report', compact('reports'));
    })->name('history-status-report');
});

Route::middleware(['auth', 'role:perawat'])->get('/pinjam-alat', function () {
    return view('perawat.pinjam-alat');
})->name('pinjam-alat');

Route::middleware(['auth', 'role:perawat'])->get('/peminjaman-alat', function () {
    $daftar_alat = \App\Models\Equipment::where('status', 'tersedia')->get();
    return view('perawat.peminjaman-alat', compact('daftar_alat'));
})->name('peminjaman-alat');

Route::middleware(['auth', 'role:perawat'])->get('/history-status-request', function () {
    $requests = \App\Models\EquipmentRequest::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
    return view('perawat.history-status-request', compact('requests'));
})->name('perawat.history-status-request');

// Route untuk membatalkan permintaan peminjaman alat
Route::middleware(['auth', 'role:perawat'])->post('/equipment-requests/{request}/cancel', function($request) {
    $equipmentRequest = \App\Models\EquipmentRequest::findOrFail($request);
    
    // Pastikan user hanya bisa membatalkan permintaannya sendiri
    if ($equipmentRequest->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan permintaan ini');
    }

    // Pastikan hanya bisa membatalkan permintaan yang masih pending
    if ($equipmentRequest->status !== 'pending') {
        return redirect()->back()->with('error', 'Hanya permintaan dengan status pending yang dapat dibatalkan');
    }

    $equipmentRequest->update(['status' => 'cancelled']);
    return redirect()->route('perawat.history-status-request')->with('success', 'Permintaan peminjaman alat berhasil dibatalkan');
})->name('perawat.equipment-requests.cancel');

// Route untuk menyimpan peminjaman alat
Route::middleware(['auth', 'role:perawat'])->post('/peminjaman-alat', function () {
    $validated = request()->validate([
        'alat_id' => 'required',
        'alasan' => 'required|string',
        'tanggal_permintaan' => 'required|date'
    ]);

    // Simpan data peminjaman ke database
    \App\Models\EquipmentRequest::create([
        'user_id' => auth()->id(),
        'alat_id' => $validated['alat_id'],
        'alasan' => $validated['alasan'],
        'tanggal_permintaan' => $validated['tanggal_permintaan'],
        'status' => 'pending'
    ]);

    return redirect()->route('perawat.history-status-request')->with('success', 'Peminjaman alat berhasil diajukan');
})->name('perawat.peminjaman-alat.store');

// Route::middleware(['auth', 'role:logistik'])->resource('equipment', App\Http\Controllers\Logistik\EquipmentController::class);
Route::middleware(['auth', 'role:manager'])->resource('equipment', App\Http\Controllers\Logistik\EquipmentController::class);

// Routes for email Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager/email', [App\Http\Controllers\Manager\EmailController::class, 'index'])->name('manager.email');
    Route::post('/manager/email/send', [App\Http\Controllers\Manager\EmailController::class, 'send'])->name('manager.email.send');
    
       // Equipment routes for manager
    Route::get('/manager/equipment', [App\Http\Controllers\Manager\EquipmentController::class, 'index'])->name('manager.equipment.index');
    Route::get('/manager/equipment/create', [App\Http\Controllers\Manager\EquipmentController::class, 'create'])->name('manager.equipment.create');
    Route::post('/manager/equipment', [App\Http\Controllers\Manager\EquipmentController::class, 'store'])->name('manager.equipment.store');
    Route::get('/manager/equipment/{equipment}/edit', [App\Http\Controllers\Manager\EquipmentController::class, 'edit'])->name('manager.equipment.edit');
    Route::put('/manager/equipment/{equipment}', [App\Http\Controllers\Manager\EquipmentController::class, 'update'])->name('manager.equipment.update');
    Route::delete('/manager/equipment/{equipment}', [App\Http\Controllers\Manager\EquipmentController::class, 'destroy'])->name('manager.equipment.destroy');


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

// REMOVING CONFLICTING GLOBAL ROUTES FOR LOGISTIK EQUIPMENT
// use App\Http\Controllers\Logistik\EquipmentController;
// Route::get('/logistik/equipment', [EquipmentController::class, 'index'])->name('equipment.index');
// Route::get('/logistik/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
// Route::post('/logistik/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
// Route::get('/logistik/equipment/{equipment}/edit', [EquipmentController::class, 'edit'])->name('equipment.edit');
// Route::put('/logistik/equipment/{equipment}', [EquipmentController::class, 'update'])->name('equipment.update');
// Route::delete('/logistik/equipment/{equipment}', [EquipmentController::class, 'destroy'])->name('equipment.destroy');