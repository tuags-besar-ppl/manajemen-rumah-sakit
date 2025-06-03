@extends('layouts.app')

@section('title', 'Riwayat Peminjaman Alat')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Riwayat Peminjaman Alat</h1>
                <p class="text-gray-600">Lihat status dan riwayat peminjaman alat Anda</p>
            </div>
            <a href="{{ route('peminjaman-alat') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Ajukan Peminjaman Baru
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Permintaan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($requests as $index => $request)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $request->equipment->code ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $request->equipment->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-building mr-1"></i>
                                    {{ $request->equipment->location ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($request->tanggal_permintaan)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <span class="inline-block max-w-xs truncate" title="{{ $request->alasan }}">
                                    {{ $request->alasan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @php
                                    $statusConfig = [
                                        'pending' => [
                                            'class' => 'yellow',
                                            'icon' => 'clock',
                                            'text' => 'Menunggu Persetujuan'
                                        ],
                                        'approved' => [
                                            'class' => 'green',
                                            'icon' => 'check-circle',
                                            'text' => 'Disetujui'
                                        ],
                                        'rejected' => [
                                            'class' => 'red',
                                            'icon' => 'times-circle',
                                            'text' => 'Ditolak'
                                        ],
                                        'completed' => [
                                            'class' => 'blue',
                                            'icon' => 'check-double',
                                            'text' => 'Selesai'
                                        ],
                                        'cancelled' => [
                                            'class' => 'gray',
                                            'icon' => 'ban',
                                            'text' => 'Dibatalkan'
                                        ]
                                    ];
                                    
                                    $config = $statusConfig[$request->status] ?? [
                                        'class' => 'gray',
                                        'icon' => 'question-circle',
                                        'text' => 'Unknown'
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $config['class'] }}-100 text-{{ $config['class'] }}-800">
                                    <i class="fas fa-{{ $config['icon'] }} mr-1"></i>
                                    {{ $config['text'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($request->status === 'pending')
                                    <form action="{{ route('perawat.equipment-requests.cancel', $request->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permintaan ini?')">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                                            <i class="fas fa-times mr-1.5"></i>
                                            Batalkan
                                        </button>
                                    </form>
                                @elseif($request->status === 'approved')
                                    <button type="button" 
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors"
                                            onclick="alert('Silakan ambil alat di {{ $request->equipment->location }}')">
                                        <i class="fas fa-info-circle mr-1.5"></i>
                                        Info
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-3 block"></i>
                                Belum ada riwayat permintaan peminjaman alat
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