<?php

namespace App\Http\Controllers;

use App\Models\DamageReport;
use App\Models\Equipment;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index()
    {
        $statistics = [
            'total' => Equipment::count(),
            'tersedia' => Equipment::where('status', 'tersedia')->count(),
            'sedang_digunakan' => Equipment::where('status', 'sedang_digunakan')->count(),
            'rusak' => Equipment::where('status', 'rusak')->count(),
        ];
    
        $recentEquipment = Equipment::latest()->take(50)->get();
        $lowStockEquipments = Equipment::where('quantity', '<=', 10)->get();
    
        return view('logistik.dashboard', compact('statistics', 'recentEquipment', 'lowStockEquipments'));
    }

    public function showDamageReports()
    {
        $damageReports = DamageReport::with(['equipment', 'user'])->orderBy('created_at', 'desc')->get();
        return view('logistik.damage-reports', compact('damageReports'));
    }

    public function confirmReport(Request $request, $id)
    {
        $report = DamageReport::findOrFail($id);
        $report->status = 'diterima';
        $report->save();

        return redirect()->back()->with('success', 'Laporan berhasil dikonfirmasi!');
    }

    public function destroy($id)
    {
        $report = DamageReport::findOrFail($id);
        $report->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus!');
    }

    public function showEquipmentRequests()
    {
        $equipmentRequests = \App\Models\EquipmentRequest::with(['equipment', 'user'])->orderBy('created_at', 'desc')->get();
        return view('logistik.equipment-requests.index', compact('equipmentRequests'));
    }

    public function approveEquipmentRequest($id)
    {
        $request = \App\Models\EquipmentRequest::findOrFail($id);
        $request->status = 'disetujui';
        $request->save();

        // Optionally update equipment status if needed, e.g., to 'sedang_digunakan'
        // if ($request->equipment) {
        //     $request->equipment->status = 'sedang_digunakan';
        //     $request->equipment->save();
        // }

        return redirect()->back()->with('success', 'Permintaan peminjaman alat berhasil disetujui!');
    }

    public function rejectEquipmentRequest($id)
    {
        $request = \App\Models\EquipmentRequest::findOrFail($id);
        $request->status = 'ditolak';
        $request->save();

        return redirect()->back()->with('success', 'Permintaan peminjaman alat berhasil ditolak!');
    }

    public function destroyEquipmentRequest($id)
    {
        $request = \App\Models\EquipmentRequest::findOrFail($id);
        $request->delete();

        return redirect()->back()->with('success', 'Permintaan peminjaman alat berhasil dihapus!');
    }
}
