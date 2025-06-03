<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\EquipmentRequest;
use App\Traits\NotifiesActivity;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    use NotifiesActivity;

    /**
     * Display the equipment borrowing form
     */
    public function showBorrowForm()
    {
        $daftar_alat = Equipment::where('status', 'tersedia')->get();
        return view('perawat.peminjaman-alat', compact('daftar_alat'));
    }

    /**
     * Display the equipment list page
     */
    public function index()
    {
        return view('perawat.pinjam-alat');
    }

    /**
     * Store equipment borrow request
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:equipment,id',
            'tanggal_permintaan' => 'required|date|after_or_equal:today',
            'quantity' => 'required|integer|min:1',
            'alasan' => 'required|string'
        ]);

        $equipment = Equipment::findOrFail($request->alat_id);

        // Check if quantity is available
        if ($equipment->quantity < $request->quantity) {
            return back()->with('error', 'Jumlah yang diminta melebihi stok yang tersedia.');
        }

        // Create equipment request
        $equipmentRequest = EquipmentRequest::create([
            'user_id' => auth()->id(),
            'equipment_id' => $request->alat_id,
            'quantity' => $request->quantity,
            'tanggal_permintaan' => $request->tanggal_permintaan,
            'alasan' => $request->alasan,
            'status' => 'pending'
        ]);

        // Create notification for logistik
        $this->createNotificationForRole('logistik', 
            'Permintaan Peminjaman Alat Baru',
            'Ada permintaan peminjaman alat baru dari ' . auth()->user()->name
        );

        return redirect()
            ->route('perawat.history-status-request')
            ->with('success', 'Permintaan peminjaman alat berhasil diajukan.');
    }

    /**
     * Display request history
     */
    public function history()
    {
        $requests = EquipmentRequest::with(['equipment', 'user'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('perawat.history-status-request', compact('requests'));
    }

    /**
     * Cancel equipment request
     */
    public function cancel(EquipmentRequest $request)
    {
        if ($request->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki akses untuk membatalkan permintaan ini.');
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'Hanya permintaan dengan status pending yang dapat dibatalkan.');
        }

        $request->update(['status' => 'cancelled']);

        // Create notification for logistik
        $this->createNotificationForRole('logistik',
            'Pembatalan Permintaan Peminjaman Alat',
            'Permintaan peminjaman alat dibatalkan oleh ' . auth()->user()->name
        );

        return back()->with('success', 'Permintaan peminjaman berhasil dibatalkan.');
    }
} 