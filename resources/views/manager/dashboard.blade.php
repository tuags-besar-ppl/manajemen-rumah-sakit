@extends('layouts.app_manager')

@section('content')
<div class="container mx-auto">
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Manager</h1>
        <p class="text-gray-600">peralatan rumah sakit</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Equipment Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-medium">Total Peralatan</h3>
                    <div class="p-2 bg-blue-400 bg-opacity-30 rounded-lg">
                        <i class="fa-solid fa-hospital text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-3xl font-bold text-white">{{ $statistics['total'] }}</span>
                        <p class="text-blue-100 text-sm">Unit</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Equipment Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-medium">Tersedia</h3>
                    <div class="p-2 bg-green-400 bg-opacity-30 rounded-lg">
                        <i class="fa-solid fa-check-circle text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-3xl font-bold text-white">{{ $statistics['tersedia'] }}</span>
                        <p class="text-green-100 text-sm">Unit</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- In Use Equipment Card -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-medium">Sedang Digunakan</h3>
                    <div class="p-2 bg-yellow-400 bg-opacity-30 rounded-lg">
                        <i class="fa-solid fa-sync text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-3xl font-bold text-white">{{ $statistics['sedang_digunakan'] }}</span>
                        <p class="text-yellow-100 text-sm">Unit</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Damaged Equipment Card -->
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-medium">Rusak</h3>
                    <div class="p-2 bg-red-400 bg-opacity-30 rounded-lg">
                        <i class="fa-solid fa-exclamation-triangle text-white text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span class="text-3xl font-bold text-white">{{ $statistics['rusak'] }}</span>
                        <p class="text-red-100 text-sm">Unit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Equipment and Low Stock Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Equipment -->
        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h5 class="text-xl font-semibold text-gray-800">Peralatan Terbaru</h5>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($recentEquipment as $equipment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $equipment->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $equipment->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $equipment->status === 'tersedia' ? 'bg-green-100 text-green-800' : 
                                           ($equipment->status === 'sedang_digunakan' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($equipment->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Low Stock Equipment -->
        <div class="bg-white rounded-xl shadow-lg">
            <div class="p-6 border-b border-gray-100">
                <h5 class="text-xl font-semibold text-gray-800">Stok Menipis</h5>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($lowStockEquipments as $equipment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $equipment->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $equipment->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Stok Rendah
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

