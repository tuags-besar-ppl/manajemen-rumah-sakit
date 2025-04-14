@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Peralatan RS</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Equipment Button -->
        <a href="{{ route('peralatan.create') }}" class="btn btn-primary mb-3">Tambah Peralatan</a>

        <!-- Equipment Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kode</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Klasifikasi</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peralatan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->klasifikasi }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('peralatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <!-- Delete Button (using a form for safety) -->
                            <form action="{{ route('peralatan.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus peralatan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
