@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <h4 class="text-white">Sistem Logistik</h4>
                    <p class="text-white-50 small mb-0">Rumah Sakit</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logistik.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('equipment.index') }}">
                            <i class="fas fa-fw fa-hospital"></i>
                            Peralatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-boxes"></i>
                            Inventaris
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-truck"></i>
                            Pengiriman
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-file-alt"></i>
                            Laporan
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Peralatan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('equipment.update', $equipment) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Peralatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $equipment->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="code" class="form-label">Kode Peralatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                       id="code" name="code" value="{{ old('code', $equipment->code) }}" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="tersedia" {{ old('status', $equipment->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="sedang_digunakan" {{ old('status', $equipment->status) == 'sedang_digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                                    <option value="rusak" {{ old('status', $equipment->status) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="unit" class="form-label">Satuan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                       id="unit" name="unit" value="{{ old('unit', $equipment->unit) }}" required>
                                @error('unit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                       id="quantity" name="quantity" value="{{ old('quantity', $equipment->quantity) }}" required min="0">
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="minimum_stock" class="form-label">Stok Minimum <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" 
                                       id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', $equipment->minimum_stock) }}" required min="0">
                                @error('minimum_stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="purchase_date" class="form-label">Tanggal Pembelian <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" 
                                       id="purchase_date" name="purchase_date" 
                                       value="{{ old('purchase_date', $equipment->purchase_date->format('Y-m-d')) }}" required>
                                @error('purchase_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_maintenance_date" class="form-label">Tanggal Pemeliharaan Terakhir</label>
                                <input type="date" class="form-control @error('last_maintenance_date') is-invalid @enderror" 
                                       id="last_maintenance_date" name="last_maintenance_date" 
                                       value="{{ old('last_maintenance_date', $equipment->last_maintenance_date ? $equipment->last_maintenance_date->format('Y-m-d') : '') }}">
                                @error('last_maintenance_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="building" class="form-label">Gedung <span class="text-danger">*</span></label>
                                <select class="form-select @error('building') is-invalid @enderror" id="building" name="building" required>
                                    <option value="">Pilih Gedung</option>
                                    @foreach($locations['buildings'] as $buildingName => $buildingData)
                                        <option value="{{ $buildingName }}" {{ old('building', $equipment->building) == $buildingName ? 'selected' : '' }}>
                                            {{ $buildingName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('building')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="floor" class="form-label">Lantai <span class="text-danger">*</span></label>
                                <select class="form-select @error('floor') is-invalid @enderror" id="floor" name="floor" required>
                                    <option value="">Pilih Lantai</option>
                                    <option value="1" {{ old('floor', $equipment->floor) == '1' ? 'selected' : '' }}>Lantai 1</option>
                                    <option value="2" {{ old('floor', $equipment->floor) == '2' ? 'selected' : '' }}>Lantai 2</option>
                                    <option value="3" {{ old('floor', $equipment->floor) == '3' ? 'selected' : '' }}>Lantai 3</option>
                                </select>
                                @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="room" class="form-label">Ruangan <span class="text-danger">*</span></label>
                                <select class="form-select @error('room') is-invalid @enderror" id="room" name="room" required>
                                    <option value="">Pilih Ruangan</option>
                                    <option value="A" {{ old('room', $equipment->room) == 'A' ? 'selected' : '' }}>Ruang A</option>
                                    <option value="B" {{ old('room', $equipment->room) == 'B' ? 'selected' : '' }}>Ruang B</option>
                                    <option value="C" {{ old('room', $equipment->room) == 'C' ? 'selected' : '' }}>Ruang C</option>
                                </select>
                                @error('room')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                    id="description" name="description" rows="3">{{ old('description', $equipment->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // Show room names based on selected building and floor
    document.addEventListener('DOMContentLoaded', function() {
        const buildingSelect = document.getElementById('building');
        const floorSelect = document.getElementById('floor');
        const roomSelect = document.getElementById('room');
        const locations = @json($locations['buildings']);

        function updateRoomNames() {
            const building = buildingSelect.value;
            const floor = floorSelect.value;
            const selectedRoom = roomSelect.value;

            if (building && floor && locations[building]?.rooms[floor]) {
                const rooms = locations[building].rooms[floor];
                const roomOptions = Array.from(roomSelect.options);
                
                // Update room names while preserving the room codes (A, B, C)
                roomOptions.forEach(option => {
                    if (option.value && rooms[option.value]) {
                        option.text = `Ruang ${option.value} - ${rooms[option.value]}`;
                    }
                });
            }
        }

        buildingSelect.addEventListener('change', updateRoomNames);
        floorSelect.addEventListener('change', updateRoomNames);
        roomSelect.addEventListener('change', updateRoomNames);

        // Update room names on page load if values are selected
        if (buildingSelect.value && floorSelect.value) {
            updateRoomNames();
        }
    });
</script>
@endpush
@endsection 