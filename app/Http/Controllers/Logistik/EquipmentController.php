<?php

namespace App\Http\Controllers\Logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        return view('logistik.index', compact('equipments'));
    }

    public function create()
    {
        $locations = [
            'Laboratorium A',
            'Laboratorium B',
            'Laboratorium C',
            'Ruang IGD',
            'Ruang Rawat Inap',
            'Ruang Operasi',
            'Ruang Radiologi',
            'Ruang Farmasi',
        ];
        $statuses = ['Tersedia', 'Sedang Digunakan', 'Rusak'];
        return view('logistik.create', compact('locations', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'location' => 'required|string',
            'status' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);
        Equipment::create($validated);
        return redirect()->route('dashboard-logistik')->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        $locations = [
            'Laboratorium A',
            'Laboratorium B',
            'Laboratorium C',
            'Ruang IGD',
            'Ruang Rawat Inap',
            'Ruang Operasi',
            'Ruang Radiologi',
            'Ruang Farmasi',
        ];
        $statuses = ['Tersedia', 'Sedang Digunakan', 'Rusak'];
        return view('logistik.edit', compact('equipment', 'locations', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'location' => 'required|string',
            'status' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);
        $equipment = Equipment::findOrFail($id);
        $equipment->update($validated);
        return redirect()->route('dashboard-logistik')->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('dashboard-logistik')->with('success', 'Peralatan berhasil dihapus.');
    }
} 