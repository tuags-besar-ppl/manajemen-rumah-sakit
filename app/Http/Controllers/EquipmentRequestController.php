<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EquipmentRequestController extends Controller
{
    public function create()
    {
        $daftar_alat = Equipment::where('status', 'tersedia')->get();
        return view('perawat.peminjaman-alat', compact('daftar_alat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alat_id' => 'required|exists:equipment,id',
            'tanggal_permintaan' => 'required|date|after_or_equal:today',
            'alasan' => 'required|string'
        ]);

        try {
            $equipmentRequest = EquipmentRequest::create([
                'user_id' => Auth::id(),
                'alat_id' => $validated['alat_id'],
                'tanggal_permintaan' => Carbon::parse($validated['tanggal_permintaan']),
                'alasan' => $validated['alasan'],
                'status' => 'pending'
            ]);

            // Eager load relationships needed for notification
            $equipmentRequest->load(['equipment', 'user']);

            return redirect()->route('history-status-request')
                ->with('success', 'Permintaan peminjaman alat berhasil diajukan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan permintaan: ' . $e->getMessage());
        }
    }

    public function cancel(EquipmentRequest $request)
    {
        if ($request->user_id !== Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki akses untuk membatalkan permintaan ini.');
        }

        if ($request->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Hanya permintaan dengan status pending yang dapat dibatalkan.');
        }

        $request->update(['status' => 'cancelled']);
        
        return redirect()->back()
            ->with('success', 'Permintaan peminjaman berhasil dibatalkan.');
    }

    public function show(EquipmentRequest $request)
    {
        // Ensure the user can only view their own requests
        if ($request->user_id !== Auth::id()) {
            return redirect()->route('history-status-request')
                ->with('error', 'Anda tidak memiliki akses ke permintaan ini.');
        }

        $request->load(['equipment', 'user']);
        return view('perawat.equipment-request-detail', compact('request'));
    }

    public function historyStatus()
    {
        $requests = EquipmentRequest::with(['equipment', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('perawat.history-status-request', compact('requests'));
    }
} 