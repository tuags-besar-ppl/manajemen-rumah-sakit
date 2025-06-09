@extends('layouts.app_logistik')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pelaporan Alat</h1>
    </div>

    <!-- Laporan Kerusakan Menunggu Konfirmasi -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Laporan Kerusakan</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($damageReports->isEmpty())
                            <div class="p-4 text-center">
                                <p>Tidak ada laporan kerusakan yang ditemukan.</p>
                            </div>
                        @else
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto; min-width: 900px;">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="text-align: center;">No.</th>
                                        <th>Alat</th>
                                        <th>Dilaporkan Oleh</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th>Lokasi</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($damageReports as $report)
                                        <tr>
                                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                                            <td>{{ $report->equipment ? $report->equipment->name : 'N/A' }}</td>
                                            <td>{{ $report->user ? $report->user->name : 'N/A' }}</td>
                                            <td>{{ $report->deskripsi_kerusakan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->tanggal_kerusakan)->format('d-m-Y') }}</td>
                                            <td>{{ $report->lokasi }}</td>
                                            <td><span class="badge bg-info text-dark text-capitalize">{{ $report->prioritas }}</span></td>
                                            <td>{{ $report->status }}</td>
                                            <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($report->status == 'diajukan')
                                                    <form action="{{ route('logistic.reports.confirm', $report->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin mengkonfirmasi laporan ini?')">Konfirmasi</button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success">{{ ucfirst($report->status) }}</span>
                                                @endif
                                                <form id="delete-form-{{ $report->id }}" action="{{ route('logistic.reports.destroy', $report->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-report-id="{{ $report->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus laporan ini secara permanen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var reportId = button.getAttribute('data-report-id'); // Extract info from data-* attributes
            
            var confirmButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
            confirmButton.onclick = function () {
                document.getElementById('delete-form-' + reportId).submit();
            };
        });
    });
</script>
@endpush
@endsection 