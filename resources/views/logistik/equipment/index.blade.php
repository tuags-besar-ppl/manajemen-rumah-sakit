@extends('layouts.app')

@section('content')
<div class="container-fluid">
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

    <!-- Search and Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('equipment.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama atau kode..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="building">
                        <option value="">Semua Gedung</option>
                        @foreach(config('hospital_locations.buildings') as $buildingName => $buildingData)
                            <option value="{{ $buildingName }}" {{ request('building') == $buildingName ? 'selected' : '' }}>
                                {{ $buildingName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="floor">
                        <option value="">Semua Lantai</option>
                        <option value="1" {{ request('floor') == '1' ? 'selected' : '' }}>Lantai 1</option>
                        <option value="2" {{ request('floor') == '2' ? 'selected' : '' }}>Lantai 2</option>
                        <option value="3" {{ request('floor') == '3' ? 'selected' : '' }}>Lantai 3</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="room">
                        <option value="">Semua Ruangan</option>
                        <option value="A" {{ request('room') == 'A' ? 'selected' : '' }}>Ruang A</option>
                        <option value="B" {{ request('room') == 'B' ? 'selected' : '' }}>Ruang B</option>
                        <option value="C" {{ request('room') == 'C' ? 'selected' : '' }}>Ruang C</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="status">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="sedang_digunakan" {{ request('status') == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                        <option value="rusak" {{ request('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('equipment.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                    <a href="{{ route('equipment.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Tambah Alat
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Equipment List -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Daftar Peralatan</h5>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipment as $item)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @php
                                    $locations = config('hospital_locations.buildings');
                                    $roomName = $locations[$item->building]['rooms'][$item->floor][$item->room] ?? '';
                                @endphp
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
                                        @if($roomName)
                                            <span class="ms-1 text-muted">({{ $roomName }})</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @switch($item->status)
                                    @case('tersedia')
                                        <span class="badge bg-success">Tersedia</span>
                                        @break
                                    @case('sedang_digunakan')
                                        <span class="badge bg-info">Sedang Digunakan</span>
                                        @break
                                    @case('rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if($item->quantity <= $item->minimum_stock)
                                    <span class="text-danger">
                                        {{ $item->quantity }} {{ $item->unit }}
                                        <i class="fas fa-exclamation-circle" title="Stok Rendah"></i>
                                    </span>
                                @else
                                    {{ $item->quantity }} {{ $item->unit }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('equipment.show', $item) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('equipment.edit', $item) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('equipment.destroy', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Tidak ada peralatan ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $equipment->firstItem() ?? 0 }} hingga {{ $equipment->lastItem() ?? 0 }} dari {{ $equipment->total() ?? 0 }} data
                </div>
                <div>
                    {{ $equipment->links() }}
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
    .pagination {
        margin-bottom: 0;
    }
    .btn-group .btn {
        margin: 0 2px;
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
</style>
@endpush
@endsection 