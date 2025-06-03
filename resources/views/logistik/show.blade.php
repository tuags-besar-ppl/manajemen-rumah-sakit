@extends('layouts.app_logistik')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detail Peralatan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Kode Peralatan</h6>
                            <p class="h5">{{ $equipment->code }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Nama Peralatan</h6>
                            <p class="h5">{{ $equipment->name }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h6 class="text-muted mb-3">Lokasi</h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-building text-primary me-2 fa-2x"></i>
                                                <div>
                                                    <small class="text-muted d-block">Gedung</small>
                                                    <span class="h5 mb-0">{{ $equipment->building }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-stairs text-secondary me-2 fa-2x"></i>
                                                <div>
                                                    <small class="text-muted d-block">Lantai</small>
                                                    <span class="h5 mb-0">Lantai {{ $equipment->floor }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="fas fa-door-open text-info me-2 fa-2x"></i>
                                                <div>
                                                    <small class="text-muted d-block">Ruangan</small>
                                                    <span class="h5 mb-0">Ruang {{ $equipment->room }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $locations = config('hospital_locations.buildings');
                                        $roomName = $locations[$equipment->building]['rooms'][$equipment->floor][$equipment->room] ?? '';
                                    @endphp
                                    @if($roomName)
                                        <div class="alert alert-info mb-0 mt-2">
                                            <i class="fas fa-info-circle me-2"></i>
                                            {{ $roomName }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Status</h6>
                            <p>
                                @switch($equipment->status)
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
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <h6 class="text-muted mb-1">Stok Saat Ini</h6>
                            <p class="h5">
                                <span class="badge {{ $equipment->quantity <= $equipment->minimum_stock ? 'bg-danger' : 'bg-success' }}">
                                    {{ $equipment->quantity }} {{ $equipment->unit }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted mb-1">Stok Minimum</h6>
                            <p class="h5">{{ $equipment->minimum_stock }} {{ $equipment->unit }}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted mb-1">Satuan</h6>
                            <p class="h5">{{ $equipment->unit }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Tanggal Pembelian</h6>
                            <p class="h5">{{ $equipment->purchase_date->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-1">Tanggal Pemeliharaan Terakhir</h6>
                            <p class="h5">
                                {{ $equipment->last_maintenance_date ? $equipment->last_maintenance_date->format('d/m/Y') : '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted mb-1">Deskripsi</h6>
                        <p class="h5">{{ $equipment->description ?: '-' }}</p>
                    </div>
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
    }
    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
    }
</style>
@endpush
@endsection 