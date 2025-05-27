@extends('layouts.app_manager')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Kerusakan Alat</h1>
        <p class="text-gray-600 mt-2">Kelola laporan kerusakan alat dari perawat</p>
    </div>

    <!-- Status Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fa-solid fa-file-circle-plus text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Diajukan</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $reportsByStatus['diajukan'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fa-solid fa-spinner text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Diproses</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $reportsByStatus['diproses'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fa-solid fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Selesai</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $reportsByStatus['selesai'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fa-solid fa-times-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Ditolak</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $reportsByStatus['ditolak'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Perawat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($reports as $report)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ optional($report->user)->name ?? 'User tidak ditemukan' }}</div>
                                <div class="text-sm text-gray-500">{{ $report->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ optional($report->equipment)->name ?? 'Alat tidak ditemukan' }}</div>
                                <div class="text-sm text-gray-500">{{ optional($report->equipment)->code ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $report->deskripsi_kerusakan }}</div>
                                @if($report->catatan)
                                    <div class="text-sm text-gray-500 mt-1">
                                        <span class="font-medium">Catatan:</span> {{ $report->catatan }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($report->tanggal_kerusakan)->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $report->lokasi }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($report->prioritas)
                                    @case('rendah')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Rendah
                                        </span>
                                        @break
                                    @case('sedang')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Sedang
                                        </span>
                                        @break
                                    @case('tinggi')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Tinggi
                                        </span>
                                        @break
                                    @case('kritis')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Kritis
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @switch($report->status)
                                    @case('diajukan')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Diajukan
                                        </span>
                                        @break
                                    @case('diproses')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Diproses
                                        </span>
                                        @break
                                    @case('selesai')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                        @break
                                    @case('ditolak')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                        @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button type="button" 
                                        class="inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors"
                                        onclick="openUpdateModal('{{ $report->id }}')">
                                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                                    Edit Status
                                </button>
                            </td>
                        </tr>

                        <!-- Update Status Modal -->
                        <div id="updateModal{{ $report->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                <div class="mt-3">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Update Status Laporan</h3>
                                    <form action="{{ route('manager.reports.update-status', $report->id) }}" method="POST" class="mt-4">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                                <option value="diajukan" {{ $report->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                                <option value="diproses" {{ $report->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="ditolak" {{ $report->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700">Catatan</label>
                                            <textarea name="catatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ $report->catatan }}</textarea>
                                        </div>

                                        <div class="flex justify-end space-x-3">
                                            <button type="button" 
                                                    onclick="closeUpdateModal('{{ $report->id }}')"
                                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada laporan kerusakan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openUpdateModal(id) {
    document.getElementById('updateModal' + id).classList.remove('hidden');
}

function closeUpdateModal(id) {
    document.getElementById('updateModal' + id).classList.add('hidden');
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('fixed')) {
        event.target.classList.add('hidden');
    }
}
</script>
@endpush
@endsection 