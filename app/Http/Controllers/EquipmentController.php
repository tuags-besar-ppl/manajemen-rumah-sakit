<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    // Tampilkan semua data alat
    public function index()
    {
        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('equipment.create');
    }

    // Simpan data alat
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'code' => 'required|unique:equipment',
            'status' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only([
            'nama', 'code', 'lokasi', 'status', 'deskripsi'
        ]);

        if ($request->hasFile('gambar')) {
            // Ambil nama asli file dan tambahkan timestamp agar unik
            $originalName = time() . '_' . $request->file('gambar')->getClientOriginalName();

            // Simpan file ke storage/app/public/alat dengan nama asli
            $path = $request->file('gambar')->storeAs('alat', $originalName, 'public');

            // Simpan path ke database
            $data['gambar'] = $path;
        }

        Equipment::create($data);
        return redirect()->route('equipment.index')->with('success', 'Alat berhasil ditambahkan.');
    }
}
