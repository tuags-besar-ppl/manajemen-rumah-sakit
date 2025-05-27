@extends('layouts.app')

@section('title', 'History & Status Laporan')

@section('content')
<div class="main-content">
    <h1 style="text-align:center; margin-top: 30px; font-size:2.5rem; color:#1e40af; font-weight:700;">
        History & Status Laporan
    </h1>
<<<<<<< Updated upstream
    {{-- Isi tabel atau daftar history laporan di sini --}}
=======
    <div class="container-fluid mt-4" style="max-width: 90vw;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card" style="font-size: 1.15rem;">
            <div class="card-body">
                @if($reports->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="font-size: 1.15rem;">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Alat</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $i => $report)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $report->equipment->code ?? '-' }} - {{ $report->equipment->name ?? '-' }}</td>
                                <td>{{ $report->deskripsi_kerusakan }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->tanggal_kerusakan)->format('d/m/Y') }}</td>
                                <td>{{ $report->lokasi }}</td>
                                <td><span class="badge bg-info text-dark text-capitalize">{{ $report->prioritas }}</span></td>
                                <td><span class="badge bg-secondary text-capitalize">{{ $report->status }}</span></td>
                                <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <div class="text-center text-muted py-4">Belum ada laporan kerusakan.</div>
                @endif
            </div>
        </div>
    </div>
>>>>>>> Stashed changes
</div>
@endsection 