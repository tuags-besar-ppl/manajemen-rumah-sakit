@extends('layouts.app_logistik')

@section('title', 'Tambah Peralatan Baru')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Peralatan Baru</h1>
    </div>

    <!-- Form untuk Tambah Peralatan -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Peralatan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('logistic.equipment.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Alat</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="code" class="form-label">Kode Alat</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}" required>
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required min="1">
                    @error('quantity')
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
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambah Peralatan</button>
                <a href="{{ route('dashboard-logistik') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection 