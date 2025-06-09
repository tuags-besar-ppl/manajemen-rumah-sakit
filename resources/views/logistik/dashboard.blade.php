@extends('layouts.app_logistik')

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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('logistic.equipment.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPeralatanLabel">Tambah Peralatan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Lokasi</label>
                            <select name="location" id="location" class="form-control @error('location') is-invalid @enderror" required>
                                <option value="">-- Pilih Lokasi --</option>
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
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="sedang_digunakan" {{ old('status') == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                                <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="perbaikan" {{ old('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                <option value="hilang" {{ old('status') == 'hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Stok</label>
                            <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
                            @error('quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                <div class="card-body d-flex justify-content-between align-items-center flex-column py-4" style="height: 100%; position: relative;">
                    <h6 class="text-uppercase mb-1">Total Peralatan</h6>
                    <h2 class="mb-0" style="font-size: 2.5rem;">{{ $statistics['total'] ?? 0 }}</h2>
                    <i class="fas fa-hospital-alt" style="position: absolute; bottom: 10px; right: 10px; font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column py-4" style="height: 100%; position: relative;">
                    <h6 class="text-uppercase mb-1">Tersedia</h6>
                    <h2 class="mb-0" style="font-size: 2.5rem;">{{ $statistics['tersedia'] ?? 0 }}</h2>
                    <i class="fas fa-check-circle" style="position: absolute; bottom: 10px; right: 10px; font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column py-4" style="height: 100%; position: relative;">
                    <h6 class="text-uppercase mb-1">Digunakan</h6>
                    <h2 class="mb-0" style="font-size: 2.5rem;">{{ $statistics['sedang_digunakan'] ?? 0 }}</h2>
                    <i class="fas fa-sync" style="position: absolute; bottom: 10px; right: 10px; font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white h-100">
                <div class="card-body d-flex justify-content-between align-items-center flex-column py-4" style="height: 100%; position: relative;">
                    <h6 class="text-uppercase mb-1">Laporan</h6>
                    <h2 class="mb-0" style="font-size: 2.5rem;">{{ $statistics['rusak'] ?? 0 }}</h2>
                    <i class="fas fa-exclamation-triangle" style="position: absolute; bottom: 10px; right: 10px; font-size: 3rem; opacity: 0.5;"></i>
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
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-bordered table-hover table-light mb-0">
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
                                                <span class="badge bg-success badge-status">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Tersedia
                                                </span>
                                                @break
                                            @case('sedang_digunakan')
                                                <span class="badge bg-info badge-status">
                                                    <i class="fas fa-sync me-1"></i>
                                                    Sedang Digunakan
                                                </span>
                                                @break
                                            @case('rusak')
                                                <span class="badge bg-danger badge-status">
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
                                            {{ $item->quantity }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('logistic.equipment.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('logistic.equipment.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
                        <div class="list-group list-group-flush border-0">
                            @foreach($lowStockEquipments ?? [] as $item)
                                <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-box-open text-warning me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-gray-800">{{ $item->name }}</h6>
                                            <span class="text-muted small">Kode: {{ $item->code }}</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-danger rounded-pill px-3 py-2" style="font-size: 0.9rem;">
                                        Stok: {{ $item->quantity }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-success py-5">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h5 class="font-weight-bold">Tidak Ada Peringatan Stok Rendah</h5>
                            <p class="text-muted">Semua peralatan memiliki stok yang cukup.</p>
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
    /* Removed .icon as it's not directly used for card background icons anymore */
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
        border-radius: 0.5rem; /* Slightly rounded for rectangle look */
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        min-height: 120px;
        display: flex; /* Use flex to align content within card */
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
        padding: 1.5rem;
    }
    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    /* Specific solid colors for dashboard cards */
    .dashboard-card.bg-primary {
        background-color: #2196f3 !important; /* Blue */
    }
    .dashboard-card.bg-success {
        background-color: #4caf50 !important; /* Green */
    }
    .dashboard-card.bg-info {
        background-color: #00bcd4 !important; /* Cyan */
    }
    .dashboard-card.bg-danger {
        background-color: #f44336 !important; /* Red */
    }
    .dashboard-card .icon-bg {
        position: absolute;
        bottom: -5px; /* Adjusted position */
        right: -5px; /* Adjusted position */
        font-size: 5rem; /* Larger icon */
        color: rgba(255,255,255,0.2); /* Lighter opacity */
        z-index: 0;
    }
    .dashboard-card .card-body {
        position: relative;
        z-index: 1;
        color: #fff; /* Ensure text is white */
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Space between title and value */
        align-items: flex-start;
        padding: 0; /* Remove default padding as card already has it */
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
        background-color: #e9ecef; /* Light gray for header */
        color: #495057;
        font-weight: 600;
        border-top: none;
    }
    .table tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa; /* Zebra striping */
    }
    .table tbody tr:hover {
        background-color: #e2e6ea; /* Darker hover */
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

@push('scripts')
<script>
    // Tambahkan script yang diperlukan di sini jika ada
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
@endpush

@endsection

