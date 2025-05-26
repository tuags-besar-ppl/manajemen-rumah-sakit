<?php

namespace App\Http\Controllers;

use App\Models\HospitalEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk tampilan dengan status yang sesuai
        $statistics = [
            'total' => HospitalEquipment::count() ?? 0,
            'tersedia' => HospitalEquipment::where('status', 'tersedia')->count() ?? 0,
            'sedang_digunakan' => HospitalEquipment::where('status', 'sedang_digunakan')->count() ?? 0,
            'rusak' => HospitalEquipment::where('status', 'rusak')->count() ?? 0
        ];

        // Peralatan terbaru dengan informasi lokasi
        $recentEquipment = HospitalEquipment::latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $locations = config('hospital_locations.buildings');
                $item->room_name = $locations[$item->building]['rooms'][$item->floor][$item->room] ?? null;
                return $item;
            });

        // Peralatan dengan stok rendah dengan informasi lokasi
        $lowStockEquipment = HospitalEquipment::whereRaw('quantity <= minimum_stock')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $locations = config('hospital_locations.buildings');
                $item->room_name = $locations[$item->building]['rooms'][$item->floor][$item->room] ?? null;
                return $item;
            });

        return view('logistik.dashboard', compact('statistics', 'recentEquipment', 'lowStockEquipment'));
    }
} 