@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Form Pinjam Alat</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('equipment-requests.store') }}">
        @csrf

        <div class="mb-3">
            <label for="equipment_id" class="form-label">Pilih Peralatan <span class="text-danger">*</span></label>
            <select name="equipment_id" class="form-control" required>
                <option value="">-- Pilih Peralatan --</option>
                @foreach ($equipment as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->location }}</option>
                @endforeach
            </select>
            @error('equipment_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Alasan Permintaan <span class="text-danger">*</span></label>
            <textarea name="reason" rows="5" class="form-control" required>{{ old('reason') }}</textarea>
            @error('reason')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <small class="text-muted">Jelaskan kebutuhan alat secara rinci dan perkiraan durasi peminjaman.</small>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Permintaan</button>
    </form>
</div>
@endsection
