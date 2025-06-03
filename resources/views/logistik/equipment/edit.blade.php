@extends('layouts.app_logistik')

@section('content')
<div class="container mx-auto">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Edit Peralatan</h1>
                    <p class="text-gray-600">Ubah informasi peralatan</p>
                </div>
                <a href="{{ route('equipment.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6">
                <form action="{{ route('equipment.update', $equipment->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kode Peralatan -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                                Kode Peralatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code', $equipment->code) }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('code') border-red-500 @enderror"
                                   required>
                            @error('code')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Peralatan -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Peralatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $equipment->name) }}"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <select id="location" 
                                    name="location" 
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Lokasi</option>
                                <option value="Laboratorium A" {{ old('location', $equipment->location) == 'Laboratorium A' ? 'selected' : '' }}>Laboratorium A</option>
                                <option value="Laboratorium B" {{ old('location', $equipment->location) == 'Laboratorium B' ? 'selected' : '' }}>Laboratorium B</option>
                                <option value="Laboratorium C" {{ old('location', $equipment->location) == 'Laboratorium C' ? 'selected' : '' }}>Laboratorium C</option>
                                <option value="Ruang IGD" {{ old('location', $equipment->location) == 'Ruang IGD' ? 'selected' : '' }}>Ruang IGD</option>
                                <option value="Ruang Rawat Inap" {{ old('location', $equipment->location) == 'Ruang Rawat Inap' ? 'selected' : '' }}>Ruang Rawat Inap</option>
                                <option value="Ruang Operasi" {{ old('location', $equipment->location) == 'Ruang Operasi' ? 'selected' : '' }}>Ruang Operasi</option>
                                <option value="Ruang Radiologi" {{ old('location', $equipment->location) == 'Ruang Radiologi' ? 'selected' : '' }}>Ruang Radiologi</option>
                                <option value="Ruang Farmasi" {{ old('location', $equipment->location) == 'Ruang Farmasi' ? 'selected' : '' }}>Ruang Farmasi</option>
                            </select>
                            @error('location')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Status</option>
                                <option value="tersedia" {{ old('status', $equipment->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sedang_digunakan" {{ old('status', $equipment->status) == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                                <option value="rusak" {{ old('status', $equipment->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="quantity" 
                                   name="quantity" 
                                   value="{{ old('quantity', $equipment->quantity) }}"
                                   min="0"
                                   class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('quantity') border-red-500 @enderror"
                                   required>
                            @error('quantity')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="reset" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 