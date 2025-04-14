@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Peralatan</h1>

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

        <!-- Edit Equipment Form -->
        <form action="{{ route('peralatan.update', $peralatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $peralatan->nama }}" required>
            </div>

            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ $peralatan->kode }}" required>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <select class="form-control" id="lokasi" name="lokasi" required>
                    <option value="Jakarta" {{ $peralatan->lokasi == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                    <option value="Bandung" {{ $peralatan->lokasi == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="git Bogor" {{ $peralatan->lokasi == 'Bogor' ? 'selected' : '' }}>Bogor</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Ready" {{ $peralatan->status == 'Ready' ? 'selected' : '' }}>Ready</option>
                    <option value="Not Ready" {{ $peralatan->status == 'Not Ready' ? 'selected' : '' }}>Not Ready</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $peralatan->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="Elektronik" {{ $peralatan->kategori == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                    <option value="Fisioterapi" {{ $peralatan->kategori == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi</option>
                    <option value="Kesehatan" {{ $peralatan->kategori == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Sterilisasi" {{ $peralatan->kategori == 'Sterilisasi' ? 'selected' : '' }}>Sterilisasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="klasifikasi" class="form-label">Klasifikasi</label>
                <select class="form-control" id="klasifikasi" name="klasifikasi" required>
                    <option value="Utama" {{ $peralatan->klasifikasi == 'Utama' ? 'selected' : '' }}>Utama</option>
                    <option value="Cadangan" {{ $peralatan->klasifikasi == 'Cadangan' ? 'selected' : '' }}>Cadangan</option>
                    <option value="Darurat" {{ $peralatan->klasifikasi == 'Darurat' ? 'selected' : '' }}>Darurat</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Peralatan</button>
        </form>
    </div>
@endsection
