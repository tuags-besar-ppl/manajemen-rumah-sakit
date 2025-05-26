@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Seluruh Peralatan</h1>
        <a href="{{ route('dashboard-logistik') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
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
                        @forelse($equipments ?? [] as $item)
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
                                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> TERSEDIA</span>
                                        @break
                                    @case('sedang_digunakan')
                                        <span class="badge bg-info"><i class="fas fa-sync me-1"></i> SEDANG DIGUNAKAN</span>
                                        @break
                                    @case('rusak')
                                        <span class="badge bg-danger"><i class="fas fa-exclamation-triangle me-1"></i> RUSAK</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ strtoupper(str_replace('_', ' ', $item->status)) }}</span>
                                @endswitch
                            </td>
                            <td>
                                @if($item->quantity <= 10)
                                    <span class="text-danger">
                                        {{ $item->quantity }}
                                        <i class="fas fa-exclamation-circle" title="Stok Rendah"></i>
                                    </span>
                                @else
                                    {{ $item->quantity }}
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('equipment.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('equipment.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
                                            <li class="list-group-item">
                                                <strong>Status:</strong>
                                                @switch($item->status)
                                                    @case('tersedia')
                                                        <span class="badge bg-success ms-2"><i class="fas fa-check-circle me-1"></i> TERSEDIA</span>
                                                        @break
                                                    @case('sedang_digunakan')
                                                        <span class="badge bg-info ms-2"><i class="fas fa-sync me-1"></i> SEDANG DIGUNAKAN</span>
                                                        @break
                                                    @case('rusak')
                                                        <span class="badge bg-danger ms-2"><i class="fas fa-exclamation-triangle me-1"></i> RUSAK</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary ms-2">{{ strtoupper(str_replace('_', ' ', $item->status)) }}</span>
                                                @endswitch
                                            </li>
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
                            <td colspan="6" class="text-center py-4">Tidak ada peralatan ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 