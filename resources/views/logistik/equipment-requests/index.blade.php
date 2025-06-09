@extends('layouts.app_logistik')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Permintaan Peminjaman Alat</h1>
    </div>

    <!-- Daftar Permintaan Peminjaman Alat -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Permintaan Peminjaman Alat</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto; min-width: 900px;">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($equipmentRequests->isEmpty())
                            <div class="p-4 text-center">
                                <p>Tidak ada permintaan peminjaman alat yang ditemukan.</p>
                            </div>
                        @else
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Alat</th>
                                        <th>Diminta Oleh</th>
                                        <th>Alasan</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipmentRequests as $request)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $request->equipment ? $request->equipment->name : 'N/A' }}</td>
                                            <td>{{ $request->user ? $request->user->name : 'N/A' }}</td>
                                            <td>{{ $request->alasan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($request->tanggal_permintaan)->format('d-m-Y') }}</td>
                                            <td>
                                                @php
                                                    $statusClass = '';
                                                    switch($request->status) {
                                                        case 'pending':
                                                            $statusClass = 'bg-warning';
                                                            break;
                                                        case 'disetujui':
                                                            $statusClass = 'bg-success';
                                                            break;
                                                        case 'ditolak':
                                                            $statusClass = 'bg-danger';
                                                            break;
                                                        case 'cancelled':
                                                            $statusClass = 'bg-secondary';
                                                            break;
                                                        default:
                                                            $statusClass = 'bg-info';
                                                            break;
                                                    }
                                                @endphp
                                                <span class="badge {{ $statusClass }} text-capitalize">{{ $request->status }}</span>
                                            </td>
                                            <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                {{-- Tombol aksi di sini (setujui/tolak) --}}
                                                <div class="d-flex align-items-center gap-1">
                                                    @if($request->status == 'pending')
                                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmRequestModal{{ $request->id }}">Setujui</button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectRequestModal{{ $request->id }}">Tolak</button>
                                                    @endif
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteModal('{{ $request->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modals for Approve/Reject -->
                                        <div class="modal fade" id="confirmRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="confirmRequestModalLabel{{ $request->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('logistic.equipment-requests.approve', $request->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmRequestModalLabel{{ $request->id }}">Konfirmasi Peminjaman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menyetujui permintaan peminjaman alat ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-success">Setujui</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="rejectRequestModal{{ $request->id }}" tabindex="-1" aria-labelledby="rejectRequestModalLabel{{ $request->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('logistic.equipment-requests.reject', $request->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectRequestModalLabel{{ $request->id }}">Tolak Peminjaman</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menolak permintaan peminjaman alat ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteRequestModal" tabindex="-1" aria-labelledby="deleteRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="deleteRequestForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRequestModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus permintaan ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(requestId) {
        const form = document.getElementById('deleteRequestForm');
        form.action = `/logistik/permintaan-peminjaman/${requestId}`;
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteRequestModal'));
        deleteModal.show();
    }
</script>
@endsection 