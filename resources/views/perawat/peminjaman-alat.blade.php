@extends('layouts.app')

@section('title', 'Form Peminjaman Alat')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Form Peminjaman Alat</h1>
        <p class="text-gray-600 mt-2">Ajukan permintaan peminjaman alat yang Anda perlukan</p>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('perawat.peminjaman-alat.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pilih Alat -->
                    <div>
                        <label for="alat_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Alat <span class="text-red-500">*</span>
                        </label>
                        <select name="alat_id" 
                                id="alat_id" 
                                class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('alat_id') border-red-500 @enderror"
                                required>
                            <option value="">-- Pilih Alat --</option>
                            @foreach($daftar_alat as $alat)
                                <option value="{{ $alat->id }}" {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->code }} - {{ $alat->name }} 
                                    (Lokasi: {{ $alat->location }}, Stok: {{ $alat->quantity }})
                                </option>
                            @endforeach
                        </select>
                        @error('alat_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Permintaan -->
                    <div>
                        <label for="tanggal_permintaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Permintaan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="tanggal_permintaan" 
                               name="tanggal_permintaan" 
                               value="{{ old('tanggal_permintaan', date('Y-m-d')) }}"
                               min="{{ date('Y-m-d') }}"
                               class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('tanggal_permintaan') border-red-500 @enderror"
                               required>
                        @error('tanggal_permintaan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Alasan Peminjaman -->
                <div>
                    <label for="alasan" class="block text-sm font-medium text-gray-700 mb-2">
                        Alasan Peminjaman <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasan" 
                              name="alasan" 
                              rows="5"
                              class="w-full px-4 py-2.5 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm hover:border-gray-400 transition-colors @error('alasan') border-red-500 @enderror"
                              placeholder="Jelaskan alasan peminjaman alat secara detail..."
                              required>{{ old('alasan') }}</textarea>
                    @error('alasan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('pinjam-alat') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-sm">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Ajukan Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date untuk input tanggal
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('tanggal_permintaan').setAttribute('min', today);

    // Konfirmasi sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin mengajukan permintaan peminjaman alat ini?')) {
            this.submit();
        }
    });
});
</script>
@endpush
@endsection
