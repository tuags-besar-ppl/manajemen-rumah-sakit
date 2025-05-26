@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Logistik</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPeralatan">
            <i class="fas fa-plus me-2"></i>Tambah Peralatan Baru
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalTambahPeralatan" tabindex="-1" aria-labelledby="modalTambahPeralatanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('equipment.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPeralatanLabel">Tambah Peralatan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <select name="location" id="location" class="form-control" required>
                                <option value="">-- Pilih Lokasi --</option>
                                <option value="Laboratorium A">Laboratorium A</option>
                                <option value="Laboratorium B">Laboratorium B</option>
                                <option value="Laboratorium C">Laboratorium C</option>
                                <option value="Ruang IGD">Ruang IGD</option>
                                <option value="Ruang Rawat Inap">Ruang Rawat Inap</option>
                                <option value="Ruang Operasi">Ruang Operasi</option>
                                <option value="Ruang Radiologi">Ruang Radiologi</option>
                                <option value="Ruang Farmasi">Ruang Farmasi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="sedang_digunakan">Sedang Digunakan</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Stok</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
                    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
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
                                @forelse($recentEquipment ?? [] as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <i class="fas fa-building me-1"></i>
                                            {{ $item->location }}
                                        </span>
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
                                        @if($item->quantity <= 10)
                                            <div class="d-flex align-items-center text-danger">
                                                <span>{{ $item->quantity }}</span>
                                                <i class="fas fa-exclamation-circle ms-1" data-bs-toggle="tooltip" title="Stok di bawah minimum (10)"></i>
                                            </div>
                                        @else
                                            <span>{{ $item->quantity }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Peralatan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Kode:</strong> {{ $item->code }}</li>
                                                    <li class="list-group-item"><strong>Nama:</strong> {{ $item->name }}</li>
                                                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $item->location }}</li>
                                                    <li class="list-group-item"><strong>Status:</strong> {{ $item->status }}</li>
                                                    <li class="list-group-item"><strong>Stok:</strong> {{ $item->quantity }}</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">Tidak ada data peralatan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Warning -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        Peringatan Stok Rendah
                    </h6>
                </div>
                <div class="card-body">
                    @if(count($lowStockEquipments ?? []) > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($lowStockEquipments ?? [] as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>
                                        <strong>{{ $item->name }}</strong>
                                        <span class="text-muted">({{ $item->code }})</span>
                                    </span>
                                    <span class="badge bg-danger">
                                        {{ $item->quantity }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center text-success">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <div>Tidak ada peringatan stok rendah</div>
                        </div>
                    @endif
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
    .dashboard-card {
        border-radius: 1rem;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        position: relative;
        overflow: hidden;
        min-height: 120px;
    }
    .dashboard-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    }
    .dashboard-card .icon-bg {
        position: absolute;
        right: 1.5rem;
        bottom: 1rem;
        font-size: 3.5rem;
        color: rgba(255,255,255,0.18);
        z-index: 0;
    }
    .dashboard-card .card-body {
        position: relative;
        z-index: 1;
    }
    .dashboard-title {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .dashboard-value {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0;
    }
    .table thead th {
        background: #f4f6fb;
        font-weight: 600;
        color: #495057;
        border-top: none;
    }
    .table-hover tbody tr:hover {
        background: #f0f4fa;
    }
    .badge-status {
        font-size: 0.95rem;
        padding: 0.4em 0.8em;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    @media (max-width: 767.98px) {
        .dashboard-card {
            margin-bottom: 1rem;
        }
    }
    .table-scroll-wrapper {
        position: relative;
    }
    .scroll-buttons {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .table-responsive {
        max-height: 350px;
        overflow-y: auto;
    }
</style>
@endpush
<script>
function scrollTable(direction) {
    const tableDiv = document.getElementById('scrollableTable');
    const scrollAmount = 100; // px per click
    if (direction === 'up') {
        tableDiv.scrollBy({ top: -scrollAmount, behavior: 'smooth' });
    } else {
        tableDiv.scrollBy({ top: scrollAmount, behavior: 'smooth' });
    }
}
</script>
@endsection

