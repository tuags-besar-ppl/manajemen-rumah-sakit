<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        return view('manager.equipment.index', compact('equipments'));
    }

    public function create()
    {
        return view('manager.equipment.create');
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
        return redirect()->route('manager.equipment.index')->with('success', 'Peralatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);
        return view('manager.equipment.edit', compact('equipment'));
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
        return redirect()->route('manager.equipment.index')->with('success', 'Peralatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->route('manager.equipment.index')->with('success', 'Peralatan berhasil dihapus.');
    }
} 