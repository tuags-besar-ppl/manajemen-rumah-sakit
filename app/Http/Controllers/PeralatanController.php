<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    // Define predefined options for categories, classifications, statuses, and locations
    private $categories = ['Elektronik', 'Fisioterapi', 'Kesehatan', 'Sterilisasi']; // Example categories
    private $classifications = ['Utama', 'Cadangan', 'Darurat']; // Example classifications
    private $statuses = ['Ready', 'Not Ready']; // Example statuses
    private $locations = ['Jakarta', 'Bandung', 'Bogor']; // Example locations

    // Display a listing of the equipment
    public function index()
    {
        // Fetch all equipment from the database
        $peralatan = Peralatan::all();

        // Return the view with the data
        return view('peralatan.index', compact('peralatan'));
    }

    // Show the form for creating new equipment
    public function create()
    {
        return view('peralatan.create', [
            'categories' => $this->categories,
            'classifications' => $this->classifications,
            'statuses' => $this->statuses,
            'locations' => $this->locations,
        ]);
    }

    // Store new equipment data in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'lokasi' => 'required|in:' . implode(',', $this->locations),
            'status' => 'required|in:' . implode(',', $this->statuses),
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:' . implode(',', $this->categories),
            'klasifikasi' => 'required|in:' . implode(',', $this->classifications),
        ]);

        // Create a new equipment entry in the database
        Peralatan::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'klasifikasi' => $request->klasifikasi,
        ]);

        // Redirect back to the list of equipment with a success message
        return redirect()->route('peralatan.index')
                         ->with('success', 'Peralatan berhasil ditambahkan');
    }

    // Show the form for editing equipment
    public function edit($id)
    {
        $peralatan = Peralatan::findOrFail($id);

        return view('peralatan.edit', [
            'peralatan' => $peralatan,
            'categories' => $this->categories,
            'classifications' => $this->classifications,
            'statuses' => $this->statuses,
            'locations' => $this->locations,
        ]);
    }

    // Update the equipment data in the database
    public function update(Request $request, $id)
    {
        $peralatan = Peralatan::findOrFail($id);

        // Validate the data before updating
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'lokasi' => 'required|in:' . implode(',', $this->locations),
            'status' => 'required|in:' . implode(',', $this->statuses),
            'deskripsi' => 'required|string|max:1000',
            'kategori' => 'required|in:' . implode(',', $this->categories),
            'klasifikasi' => 'required|in:' . implode(',', $this->classifications),
        ]);

        // Update the equipment
        $peralatan->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'lokasi' => $request->lokasi,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'klasifikasi' => $request->klasifikasi,
        ]);

        // Redirect back to the list with a success message
        return redirect()->route('peralatan.index')
                         ->with('success', 'Peralatan berhasil diupdate');
    }

    // Delete the specified equipment from the database
    public function destroy($id)
    {
        $peralatan = Peralatan::findOrFail($id);
        $peralatan->delete();

        return redirect()->route('peralatan.index')
                         ->with('success', 'Peralatan berhasil dihapus');
    }
}
