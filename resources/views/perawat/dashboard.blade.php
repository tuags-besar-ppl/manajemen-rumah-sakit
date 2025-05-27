@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 style="text-align:center; margin-top: 30px; font-size:2.5rem; color:#1e40af; font-weight:700;">
        Dashboard Peralatan Rumah Sakit
    </h1>
    <div class="container mt-4">
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
                                <h6 class="text-uppercase mb-1">Digunakan</h6>
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
                                <h6 class="text-uppercase mb-1">Laporan</h6>
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
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4" style="max-width: 100%; margin: 0 auto;">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Peralatan Terbaru</h6>
                        {{-- <a href="{{ route('equipment.index') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list me-1"></i>
                            Lihat Semua
                        </a> --}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
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
                                            <span>{{ $item->quantity }}</span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
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
        </div>
    </div>
@endsection
