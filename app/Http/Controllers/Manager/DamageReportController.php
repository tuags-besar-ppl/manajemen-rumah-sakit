<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DamageReport;
use App\Models\Equipment;

class DamageReportController extends Controller
{
    public function index()
    {
        // Get all damage reports with their relationships
        $reports = DamageReport::with(['equipment', 'user'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Count reports by status
        $reportsByStatus = [
            'diajukan' => $reports->where('status', 'diajukan')->count(),
            'diproses' => $reports->where('status', 'diproses')->count(),
            'selesai' => $reports->where('status', 'selesai')->count(),
            'ditolak' => $reports->where('status', 'ditolak')->count(),
        ];

        return view('manager.reports.index', compact('reports', 'reportsByStatus'));
    }

    public function updateStatus(Request $request, DamageReport $report)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'catatan' => 'nullable|string'
        ]);

        // Update the damage report
        $report->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        // If status is 'selesai', update the equipment status to 'tersedia'
        if ($request->status === 'selesai') {
            $equipment = Equipment::find($report->alat_id);
            if ($equipment) {
                $equipment->update(['status' => 'tersedia']);
            }
        }

        return back()->with('success', 'Status laporan berhasil diperbarui');
    }
}
