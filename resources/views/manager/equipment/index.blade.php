@extends('layouts.app_manager')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Peralatan</h1>
                <p class="text-gray-600">Kelola semua peralatan rumah sakit</p>
            </div>
            <a href="{{ route('equipment.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                <i class="fa-solid fa-plus mr-2"></i>
                Tambah Peralatan
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($equipments as $equipment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $equipment->code }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $equipment->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fa-solid fa-building mr-1"></i>
                                    {{ $equipment->location }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @switch($equipment->status)
                                    @case('tersedia')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fa-solid fa-check-circle mr-1"></i> Tersedia
                                        </span>
                                        @break
                                    @case('sedang_digunakan')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fa-solid fa-sync mr-1"></i> Sedang Digunakan
                                        </span>
                                        @break
                                    @case('rusak')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            <i class="fa-solid fa-exclamation-triangle mr-1"></i> Rusak
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst(str_replace('_', ' ', $equipment->status)) }}
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($equipment->quantity <= 10)
                                    <span class="text-red-600 font-medium">
                                        {{ $equipment->quantity }}
                                        <i class="fa-solid fa-exclamation-circle ml-1" title="Stok Rendah"></i>
                                    </span>
                                @else
                                    <span class="text-gray-900">{{ $equipment->quantity }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <button type="button" 
                                            class="text-blue-600 hover:text-blue-800" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detailModal{{ $equipment->id }}"
                                            title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <a href="{{ route('equipment.edit', $equipment->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-800"
                                       title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('equipment.destroy', $equipment->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus peralatan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800"
                                                title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $equipment->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-lg font-semibold">Detail Peralatan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <h6 class="text-sm font-medium text-gray-600">Kode Peralatan</h6>
                                                <p class="text-gray-900">{{ $equipment->code }}</p>
                                            </div>
                                            <div>
                                                <h6 class="text-sm font-medium text-gray-600">Nama Peralatan</h6>
                                                <p class="text-gray-900">{{ $equipment->name }}</p>
                                            </div>
                                            <div>
                                                <h6 class="text-sm font-medium text-gray-600">Lokasi</h6>
                                                <p class="text-gray-900">{{ $equipment->location }}</p>
                                            </div>
                                            <div>
                                                <h6 class="text-sm font-medium text-gray-600">Status</h6>
                                                <p>
                                                    @switch($equipment->status)
                                                        @case('tersedia')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Tersedia
                                                            </span>
                                                            @break
                                                        @case('sedang_digunakan')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Sedang Digunakan
                                                            </span>
                                                            @break
                                                        @case('rusak')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Rusak
                                                            </span>
                                                            @break
                                                    @endswitch
                                                </p>
                                            </div>
                                            <div>
                                                <h6 class="text-sm font-medium text-gray-600">Stok</h6>
                                                <p class="text-gray-900">{{ $equipment->quantity }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors" data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data peralatan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 