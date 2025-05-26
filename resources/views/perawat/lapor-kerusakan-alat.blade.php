@extends('layouts.app')

@section('title', 'Form Lapor Kerusakan Alat')

@section('content')
<div class="main-content d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh; width: 100%;">
    <h1 style="text-align:center; margin-bottom: 30px; font-size:2.5rem; color:#1e40af; font-weight:700; width: 100%;">
        Form Lapor Kerusakan Alat
    </h1>
    <div class="container d-flex justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <form action="{{ route('perawat.lapor-kerusakan.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="alat_id" class="form-label">Pilih Alat</label>
                                <select class="form-select @error('alat_id') is-invalid @enderror" id="alat_id" name="alat_id" required>
                                    <option value="">-- Pilih Alat --</option>
                                    @foreach($equipments as $alat)
                                        <option value="{{ $alat->id }}">{{ $alat->code }} - {{ $alat->name }} ({{ $alat->location }})</option>
                                    @endforeach
                                </select>
                                @error('alat_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi_kerusakan" class="form-label">Deskripsi Kerusakan</label>
                                <textarea class="form-control @error('deskripsi_kerusakan') is-invalid @enderror" 
                                    id="deskripsi_kerusakan" name="deskripsi_kerusakan" rows="4" required
                                    placeholder="Jelaskan detail kerusakan yang terjadi..."></textarea>
                                @error('deskripsi_kerusakan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_kerusakan" class="form-label">Tanggal Kerusakan</label>
                                <input type="date" class="form-control @error('tanggal_kerusakan') is-invalid @enderror" 
                                    id="tanggal_kerusakan" name="tanggal_kerusakan" required>
                                @error('tanggal_kerusakan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Lokasi Alat</label>
                                <select class="form-select @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" required>
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
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="prioritas" class="form-label">Prioritas</label>
                                <select class="form-select @error('prioritas') is-invalid @enderror" id="prioritas" name="prioritas" required>
                                    <option value="">-- Pilih Prioritas --</option>
                                    <option value="rendah">Rendah</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="tinggi">Tinggi</option>
                                    <option value="kritis">Kritis</option>
                                </select>
                                @error('prioritas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
