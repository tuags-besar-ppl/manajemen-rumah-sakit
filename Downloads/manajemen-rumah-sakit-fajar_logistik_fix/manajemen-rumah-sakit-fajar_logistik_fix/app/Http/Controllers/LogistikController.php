<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HospitalEquipment;

class LogistikController extends Controller
{
    public function dashboard()
    {
        // Get statistics
        $statistics = [
            'total' => HospitalEquipment::count(),
            'available' => HospitalEquipment::where('status', 'available')->count(),
            'maintenance' => HospitalEquipment::where('status', 'maintenance')->count(),
            'low_stock' => HospitalEquipment::whereRaw('quantity <= minimum_stock')->count(),
        ];

        // Get recent equipment with eager loading
        $recentEquipment = HospitalEquipment::query()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Initialize empty collection if no equipment exists
        if ($recentEquipment->isEmpty()) {
            $recentEquipment = collect([]);
        }

        return view('logistik.dashboard', [
            'statistics' => $statistics,
            'recentEquipment' => $recentEquipment
        ]);
    }
} 