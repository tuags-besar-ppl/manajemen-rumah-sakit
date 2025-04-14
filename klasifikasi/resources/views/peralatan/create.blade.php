@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Peralatan</h1>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Add New Equipment Form -->
        <form action="{{ route('peralatan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" required>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <select class="form-control" id="lokasi" name="lokasi" required>
                    <option value="">Pilih Lokasi</option>
                    <option value="Jakarta">Jakarta</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Bogor">Bogor</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Ready">Ready</option>
                    <option value="Not Ready">Not Ready</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Fisioterapi">Fisioterapi</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Sterilisasi">Sterilisasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="klasifikasi" class="form-label">Klasifikasi</label>
                <select class="form-control" id="klasifikasi" name="klasifikasi" required>
                    <option value="Utama">Utama</option>
                    <option value="Cadangan">Cadangan</option>
                    <option value="Darurat">Darurat</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Tambah Peralatan</button>
        </form>
    </div>
@endsection
