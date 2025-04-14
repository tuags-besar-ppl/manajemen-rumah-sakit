@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary">Daftar Peralatan RS</h3>
        <a href="{{ route('equipment.create') }}" class="btn btn-success">+ Tambah Alat</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($equipment as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if ($item->gambar)
                            <!-- Tampilkan gambar jika ada -->
                            <img src="{{ asset('storage/' . $item->gambar) }}" style="max-width: 150px;" class="rounded shadow-sm border img-fluid">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>
                        <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : ($item->status == 'digunakan' ? 'warning' : 'danger') }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data alat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
