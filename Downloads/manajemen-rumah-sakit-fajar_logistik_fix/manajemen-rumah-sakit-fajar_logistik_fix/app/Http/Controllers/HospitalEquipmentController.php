<?php

namespace App\Http\Controllers;

use App\Models\HospitalEquipment;
use Illuminate\Http\Request;

class HospitalEquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = HospitalEquipment::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Filter lokasi
        if ($request->filled('building')) {
            $query->where('building', $request->building);
        }
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }
        if ($request->filled('room')) {
            $query->where('room', $request->room);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Statistik untuk tampilan
        $statistics = [
            'total' => HospitalEquipment::count(),
            'tersedia' => HospitalEquipment::where('status', 'tersedia')->count(),
            'sedang_digunakan' => HospitalEquipment::where('status', 'sedang_digunakan')->count(),
            'rusak' => HospitalEquipment::where('status', 'rusak')->count(),
            'low_stock' => HospitalEquipment::whereRaw('quantity <= minimum_stock')->count(),
        ];

        $equipment = $query->latest()->paginate(10)->withQueryString();

        return view('logistik.equipment.index', compact('equipment', 'statistics'));
    }

    public function create()
    {
        $locations = config('hospital_locations');
        return view('logistik.equipment.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:hospital_equipment',
            'status' => 'required|in:tersedia,sedang_digunakan,rusak',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'required|string',
            'description' => 'nullable|string',
            'purchase_date' => 'required|date',
            'last_maintenance_date' => 'nullable|date',
            'building' => 'required|string',
            'floor' => 'required|string',
            'room' => 'required|string'
        ], [
            'name.required' => 'Nama peralatan harus diisi',
            'code.required' => 'Kode peralatan harus diisi',
            'code.unique' => 'Kode peralatan sudah digunakan',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus tersedia, sedang digunakan, atau rusak',
            'quantity.required' => 'Jumlah harus diisi',
            'quantity.min' => 'Jumlah tidak boleh negatif',
            'minimum_stock.required' => 'Stok minimum harus diisi',
            'minimum_stock.min' => 'Stok minimum tidak boleh negatif',
            'unit.required' => 'Satuan harus diisi',
            'purchase_date.required' => 'Tanggal pembelian harus diisi',
            'purchase_date.date' => 'Format tanggal pembelian tidak valid',
            'last_maintenance_date.date' => 'Format tanggal pemeliharaan tidak valid',
            'building.required' => 'Gedung harus dipilih',
            'floor.required' => 'Lantai harus dipilih',
            'room.required' => 'Ruangan harus dipilih'
        ]);

        // Get room name from configuration
        $locations = config('hospital_locations.buildings');
        $roomName = $locations[$validated['building']]['rooms'][$validated['floor']][$validated['room']] ?? null;
        
        // Add room_name to the validated data
        $validated['room_name'] = $roomName;

        HospitalEquipment::create($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil ditambahkan');
    }

    public function show(HospitalEquipment $equipment)
    {
        return view('logistik.equipment.show', compact('equipment'));
    }

    public function edit(HospitalEquipment $equipment)
    {
        $locations = config('hospital_locations');
        return view('logistik.equipment.edit', compact('equipment', 'locations'));
    }

    public function update(Request $request, HospitalEquipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:hospital_equipment,code,' . $equipment->id,
            'status' => 'required|in:tersedia,sedang_digunakan,rusak',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'required|string',
            'description' => 'nullable|string',
            'purchase_date' => 'required|date',
            'last_maintenance_date' => 'nullable|date',
            'building' => 'required|string',
            'floor' => 'required|string',
            'room' => 'required|string'
        ], [
            'name.required' => 'Nama peralatan harus diisi',
            'code.required' => 'Kode peralatan harus diisi',
            'code.unique' => 'Kode peralatan sudah digunakan',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status harus tersedia, sedang digunakan, atau rusak',
            'quantity.required' => 'Jumlah harus diisi',
            'quantity.min' => 'Jumlah tidak boleh negatif',
            'minimum_stock.required' => 'Stok minimum harus diisi',
            'minimum_stock.min' => 'Stok minimum tidak boleh negatif',
            'unit.required' => 'Satuan harus diisi',
            'purchase_date.required' => 'Tanggal pembelian harus diisi',
            'purchase_date.date' => 'Format tanggal pembelian tidak valid',
            'last_maintenance_date.date' => 'Format tanggal pemeliharaan tidak valid',
            'building.required' => 'Gedung harus dipilih',
            'floor.required' => 'Lantai harus dipilih',
            'room.required' => 'Ruangan harus dipilih'
        ]);

        // Get room name from configuration
        $locations = config('hospital_locations.buildings');
        $roomName = $locations[$validated['building']]['rooms'][$validated['floor']][$validated['room']] ?? null;
        
        // Add room_name to the validated data
        $validated['room_name'] = $roomName;

        $equipment->update($validated);

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil diperbarui');
    }

    public function destroy(HospitalEquipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')
            ->with('success', 'Peralatan berhasil dihapus');
    }

    public function getRooms(Request $request)
    {
        $locations = config('hospital_locations');
        $building = $request->building;
        $floor = $request->floor;

        if (isset($locations['buildings'][$building]['rooms'][$floor])) {
            return response()->json($locations['buildings'][$building]['rooms'][$floor]);
        }

        return response()->json([]);
    }

    public function getFloors(Request $request)
    {
        $locations = config('hospital_locations');
        $building = $request->building;

        if (isset($locations['buildings'][$building]['floors'])) {
            return response()->json($locations['buildings'][$building]['floors']);
        }

        return response()->json([]);
    }
} 