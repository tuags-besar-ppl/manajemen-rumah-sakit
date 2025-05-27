@extends('layouts.app_manager')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Peralatan Baru</h1>
        <p class="text-gray-600 mt-2">Tambahkan peralatan baru ke dalam sistem</p>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <form action="{{ route('equipment.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                        Kode Peralatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="code" 
                           name="code" 
                           value="{{ old('code') }}"
                           class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('code') border-red-500 @enderror"
                           required>
                    @error('code')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
<<<<<<< Updated upstream
                <a href="{{ route('equipment.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors shadow-sm">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
=======
>>>>>>> Stashed changes

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Peralatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('name') border-red-500 @enderror"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

<<<<<<< Updated upstream
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kode Peralatan -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Peralatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code') }}"
                                   placeholder="Masukkan kode peralatan"
                                   class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('code') border-red-500 @enderror"
                                   required>
                            @error('code')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Peralatan -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Peralatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Masukkan nama peralatan"
                                   class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <select id="location" 
                                    name="location" 
                                    class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('location') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Lokasi</option>
                                <option value="Laboratorium A" {{ old('location') == 'Laboratorium A' ? 'selected' : '' }}>Laboratorium A</option>
                                <option value="Laboratorium B" {{ old('location') == 'Laboratorium B' ? 'selected' : '' }}>Laboratorium B</option>
                                <option value="Laboratorium C" {{ old('location') == 'Laboratorium C' ? 'selected' : '' }}>Laboratorium C</option>
                                <option value="Ruang IGD" {{ old('location') == 'Ruang IGD' ? 'selected' : '' }}>Ruang IGD</option>
                                <option value="Ruang Rawat Inap" {{ old('location') == 'Ruang Rawat Inap' ? 'selected' : '' }}>Ruang Rawat Inap</option>
                                <option value="Ruang Operasi" {{ old('location') == 'Ruang Operasi' ? 'selected' : '' }}>Ruang Operasi</option>
                                <option value="Ruang Radiologi" {{ old('location') == 'Ruang Radiologi' ? 'selected' : '' }}>Ruang Radiologi</option>
                                <option value="Ruang Farmasi" {{ old('location') == 'Ruang Farmasi' ? 'selected' : '' }}>Ruang Farmasi</option>
                            </select>
                            @error('location')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('status') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih Status</option>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sedang_digunakan" {{ old('status') == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                                <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stok -->
                        <div>
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="quantity" 
                                   name="quantity" 
                                   value="{{ old('quantity') }}"
                                   placeholder="Masukkan jumlah stok"
                                   min="0"
                                   class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('quantity') border-red-500 @enderror"
                                   required>
                            @error('quantity')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="reset" 
                                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors shadow-sm">
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
=======
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Lokasi <span class="text-red-500">*</span>
                    </label>
                    <select id="location" 
                            name="location" 
                            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('location') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Lokasi</option>
                        <option value="Ruang Jantung" {{ old('location') == 'Ruang Jantung' ? 'selected' : '' }}>Ruang Jantung</option>
                        <option value="Ruang Radiologi" {{ old('location') == 'Ruang Radiologi' ? 'selected' : '' }}>Ruang Radiologi</option>
                        <option value="ICU" {{ old('location') == 'ICU' ? 'selected' : '' }}>ICU</option>
                        <option value="UGD" {{ old('location') == 'UGD' ? 'selected' : '' }}>UGD</option>
                        <option value="Ruang Rawat Inap" {{ old('location') == 'Ruang Rawat Inap' ? 'selected' : '' }}>Ruang Rawat Inap</option>
                        <option value="Ruang Operasi" {{ old('location') == 'Ruang Operasi' ? 'selected' : '' }}>Ruang Operasi</option>
                        <option value="Ruang NICU" {{ old('location') == 'Ruang NICU' ? 'selected' : '' }}>Ruang NICU</option>
                        <option value="Laboratorium" {{ old('location') == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                        <option value="Ruang Sterilisasi" {{ old('location') == 'Ruang Sterilisasi' ? 'selected' : '' }}>Ruang Sterilisasi</option>
                        <option value="Ruang Hemodialisis" {{ old('location') == 'Ruang Hemodialisis' ? 'selected' : '' }}>Ruang Hemodialisis</option>
                        <option value="Lobby" {{ old('location') == 'Lobby' ? 'selected' : '' }}>Lobby</option>
                        <option value="Semua Ruangan" {{ old('location') == 'Semua Ruangan' ? 'selected' : '' }}>Semua Ruangan</option>
                    </select>
                    @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" 
                            name="status" 
                            class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('status') border-red-500 @enderror"
                            required>
                        <option value="">Pilih Status</option>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="sedang_digunakan" {{ old('status') == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                        <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                        Jumlah <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           value="{{ old('quantity') }}"
                           min="1"
                           class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('quantity') border-red-500 @enderror"
                           required>
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('equipment.index') }}" 
                       class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors shadow-sm">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                        Simpan Peralatan
                    </button>
                </div>
            </form>
>>>>>>> Stashed changes
        </div>
    </div>
</div>
@endsection 