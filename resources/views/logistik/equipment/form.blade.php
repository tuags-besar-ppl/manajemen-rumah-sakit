@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        {{ isset($equipment) ? 'Edit Peralatan' : 'Tambah Peralatan Baru' }}
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($equipment) ? route('equipment.update', $equipment) : route('equipment.store') }}" 
                          method="POST">
                        @csrf
                        @if(isset($equipment))
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Peralatan</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $equipment->name ?? '') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code" class="form-label">Kode Peralatan</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                           id="code" name="code" value="{{ old('code', $equipment->code ?? '') }}" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select class="form-select @error('category') is-invalid @enderror" 
                                            id="category" name="category" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="medical" {{ old('category', $equipment->category ?? '') == 'medical' ? 'selected' : '' }}>
                                            Peralatan Medis
                                        </option>
                                        <option value="laboratory" {{ old('category', $equipment->category ?? '') == 'laboratory' ? 'selected' : '' }}>
                                            Peralatan Laboratorium
                                        </option>
                                        <option value="surgery" {{ old('category', $equipment->category ?? '') == 'surgery' ? 'selected' : '' }}>
                                            Peralatan Bedah
                                        </option>
                                        <option value="support" {{ old('category', $equipment->category ?? '') == 'support' ? 'selected' : '' }}>
                                            Peralatan Pendukung
                                        </option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="available" {{ old('status', $equipment->status ?? '') == 'available' ? 'selected' : '' }}>
                                            Tersedia
                                        </option>
                                        <option value="in_use" {{ old('status', $equipment->status ?? '') == 'in_use' ? 'selected' : '' }}>
                                            Sedang Digunakan
                                        </option>
                                        <option value="maintenance" {{ old('status', $equipment->status ?? '') == 'maintenance' ? 'selected' : '' }}>
                                            Dalam Pemeliharaan
                                        </option>
                                        <option value="broken" {{ old('status', $equipment->status ?? '') == 'broken' ? 'selected' : '' }}>
                                            Rusak
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                                           id="quantity" name="quantity" value="{{ old('quantity', $equipment->quantity ?? '') }}" required>
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="minimum_stock" class="form-label">Stok Minimum</label>
                                    <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" 
                                           id="minimum_stock" name="minimum_stock" 
                                           value="{{ old('minimum_stock', $equipment->minimum_stock ?? '') }}" required>
                                    @error('minimum_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unit" class="form-label">Satuan</label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                           id="unit" name="unit" value="{{ old('unit', $equipment->unit ?? '') }}" required>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                                    <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" 
                                           id="purchase_date" name="purchase_date" 
                                           value="{{ old('purchase_date', isset($equipment) ? $equipment->purchase_date->format('Y-m-d') : '') }}" required>
                                    @error('purchase_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_maintenance_date" class="form-label">Tanggal Pemeliharaan Terakhir</label>
                                    <input type="date" class="form-control @error('last_maintenance_date') is-invalid @enderror" 
                                           id="last_maintenance_date" name="last_maintenance_date" 
                                           value="{{ old('last_maintenance_date', isset($equipment) && $equipment->last_maintenance_date ? $equipment->last_maintenance_date->format('Y-m-d') : '') }}">
                                    @error('last_maintenance_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="building" class="form-label">Building <span class="text-danger">*</span></label>
                                <select class="form-select @error('building') is-invalid @enderror" 
                                        id="building" name="building" required>
                                    <option value="">Select Building</option>
                                    @foreach($locations['buildings'] as $buildingName => $buildingData)
                                        <option value="{{ $buildingName }}" {{ old('building', $equipment->building ?? '') == $buildingName ? 'selected' : '' }}>
                                            {{ $buildingName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('building')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="floor" class="form-label">Floor <span class="text-danger">*</span></label>
                                <select class="form-select @error('floor') is-invalid @enderror" 
                                        id="floor" name="floor" required>
                                    <option value="">Select Floor</option>
                                </select>
                                @error('floor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="room" class="form-label">Room <span class="text-danger">*</span></label>
                                <select class="form-select @error('room') is-invalid @enderror" 
                                        id="room" name="room" required>
                                    <option value="">Select Room</option>
                                </select>
                                @error('room')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location Details</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $equipment->location ?? '') }}" 
                                       placeholder="Additional location details">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $equipment->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('equipment.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> 
                                {{ isset($equipment) ? 'Update' : 'Simpan' }}
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
document.addEventListener('DOMContentLoaded', function() {
    const buildingSelect = document.getElementById('building');
    const floorSelect = document.getElementById('floor');
    const roomSelect = document.getElementById('room');
    
    // Initial load of floors if building is selected
    if (buildingSelect.value) {
        loadFloors(buildingSelect.value);
    }

    // Building change event
    buildingSelect.addEventListener('change', function() {
        loadFloors(this.value);
        roomSelect.innerHTML = '<option value="">Select Room</option>';
    });

    // Floor change event
    floorSelect.addEventListener('change', function() {
        if (buildingSelect.value && this.value) {
            loadRooms(buildingSelect.value, this.value);
        }
    });

    function loadFloors(building) {
        fetch(`/equipment/get-floors?building=${encodeURIComponent(building)}`)
            .then(response => response.json())
            .then(floors => {
                let options = '<option value="">Select Floor</option>';
                floors.forEach(floor => {
                    const selected = floor === '{{ old('floor', $equipment->floor ?? '') }}' ? 'selected' : '';
                    options += `<option value="${floor}" ${selected}>${floor}</option>`;
                });
                floorSelect.innerHTML = options;

                // If floor was previously selected, load rooms
                if (floorSelect.value) {
                    loadRooms(building, floorSelect.value);
                }
            });
    }

    function loadRooms(building, floor) {
        fetch(`/equipment/get-rooms?building=${encodeURIComponent(building)}&floor=${encodeURIComponent(floor)}`)
            .then(response => response.json())
            .then(rooms => {
                let options = '<option value="">Select Room</option>';
                rooms.forEach(room => {
                    const selected = room === '{{ old('room', $equipment->room ?? '') }}' ? 'selected' : '';
                    options += `<option value="${room}" ${selected}>${room}</option>`;
                });
                roomSelect.innerHTML = options;
            });
    }
});
</script>
@endpush
@endsection 