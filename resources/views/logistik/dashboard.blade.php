@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Logistik</h1>
        <a href="{{ route('equipment.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Peralatan Baru
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Total Peralatan</h6>
                            <h2 class="mb-0">{{ $statistics['total'] ?? 0 }}</h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hospital-alt fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Tersedia</h6>
                            <h2 class="mb-0">{{ $statistics['tersedia'] ?? 0 }}</h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Sedang Digunakan</h6>
                            <h2 class="mb-0">{{ $statistics['sedang_digunakan'] ?? 0 }}</h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-sync fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Rusak</h6>
                            <h2 class="mb-0">{{ $statistics['rusak'] ?? 0 }}</h2>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Equipment -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Peralatan Terbaru</h6>
                    <a href="{{ route('equipment.index') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-list me-1"></i>
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEquipment as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <div class="location-item mb-1">
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-building me-1"></i>
                                                    {{ $item->building }}
                                                </span>
                                            </div>
                                            <div class="location-item mb-1">
                                                <span class="badge bg-secondary">
                                                    <i class="fas fa-stairs me-1"></i>
                                                    Lantai {{ $item->floor }}
                                                </span>
                                            </div>
                                            <div class="location-item">
                                                <span class="badge bg-info">
                                                    <i class="fas fa-door-open me-1"></i>
                                                    Ruang {{ $item->room }}
                                                </span>
                                                @if($item->room_name)
                                                    <span class="ms-1 text-muted">({{ $item->room_name }})</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @switch($item->status)
                                            @case('tersedia')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Tersedia
                                                </span>
                                                @break
                                            @case('sedang_digunakan')
                                                <span class="badge bg-info">
                                                    <i class="fas fa-sync me-1"></i>
                                                    Sedang Digunakan
                                                </span>
                                                @break
                                            @case('rusak')
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    Rusak
                                                </span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($item->quantity <= $item->minimum_stock)
                                            <div class="d-flex align-items-center text-danger">
                                                <span>{{ $item->quantity }} {{ $item->unit }}</span>
                                                <i class="fas fa-exclamation-circle ms-1" data-bs-toggle="tooltip" title="Stok di bawah minimum ({{ $item->minimum_stock }} {{ $item->unit }})"></i>
                                            </div>
                                        @else
                                            <span>{{ $item->quantity }} {{ $item->unit }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Tidak ada data peralatan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Peringatan Stok Rendah</h6>
                </div>
                <div class="card-body">
                    @forelse($lowStockEquipment ?? [] as $item)
                    <div class="alert alert-danger d-flex align-items-center mb-2" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $item->name }}</strong>
                                @switch($item->status)
                                    @case('tersedia')
                                        <span class="badge bg-success ms-2">
                                            <i class="fas fa-check-circle me-1"></i>
                                            Tersedia
                                        </span>
                                        @break
                                    @case('sedang_digunakan')
                                        <span class="badge bg-info ms-2">
                                            <i class="fas fa-sync me-1"></i>
                                            Sedang Digunakan
                                        </span>
                                        @break
                                    @case('rusak')
                                        <span class="badge bg-danger ms-2">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            Rusak
                                        </span>
                                        @break
                                @endswitch
                            </div>
                            <div class="mt-2">
                                <div class="text-danger">
                                    <i class="fas fa-box me-1"></i>
                                    Stok: {{ $item->quantity }} {{ $item->unit }}
                                    <small class="ms-1">(Min: {{ $item->minimum_stock }} {{ $item->unit }})</small>
                                </div>
                            </div>
                            <div class="mt-2 small">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    {{ $item->building }}, Lantai {{ $item->floor }},
                                    @if($item->room_name)
                                        {{ $item->room_name }}
                                    @else
                                        Ruang {{ $item->room }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                        <p class="mb-0">Tidak ada peringatan stok rendah</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .location-item {
        display: flex;
        align-items: center;
    }
    .badge {
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }
    .text-muted {
        font-size: 0.85rem;
    }
    .alert {
        margin-bottom: 0.5rem;
        padding: 0.75rem;
    }
    .alert:last-child {
        margin-bottom: 0;
    }
</style>
@endpush
@endsection
