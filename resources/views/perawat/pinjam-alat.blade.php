@extends('layouts.app')

@section('title', 'Peminjaman Alat Rumah Sakit')

@section('content')
    <h1 style="text-align:center; margin-top: 30px; font-size:2.5rem; color:#1e40af; font-weight:700;">
        Peminjaman Alat Rumah Sakit
    </h1>
    <div class="peminjaman-menu" style="display: flex; justify-content: center; align-items: flex-start; gap: 60px; margin-top: 60px;">
        <a href="{{ route('peminjaman-alat') }}" class="peminjaman-card" style="background: #fff; color: #222; border-radius: 20px; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 32px rgba(0,0,0,0.10); cursor: pointer; transition: transform 0.15s, box-shadow 0.15s, background-color 0.3s; border: none; padding: 0 18px; text-decoration: none;">
            <span class="img-illu" style="width: 210px; height: 210px; margin-bottom: 18px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('uploads/request.png') }}" alt="Form Pinjam Alat" style="width:100%;height:100%;object-fit:contain;">
            </span>
            <div style="font-size:1.25rem; font-weight:600; margin-bottom:8px; color:#1e40af; text-decoration: none;">Form Pinjam Alat</div>
            <div class="desc" style="margin-top: 18px; font-size: 1.08rem; color: #444; text-align: center; max-width: 320px;">
                Ajukan permintaan peminjaman alat yang diperlukan.
            </div>
        </a>
        <a href="{{ route('perawat.history-status-request') }}" class="peminjaman-card" style="background: #fff; border-radius: 20px; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 32px rgba(0,0,0,0.10); cursor: pointer; transition: transform 0.15s, box-shadow 0.15s, background-color 0.3s; border: none; padding: 0 18px; text-decoration: none;">
            <span class="img-illu" style="width: 210px; height: 210px; margin-bottom: 18px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('uploads/history-request.png') }}" alt="Riwayat Peminjaman Alat" style="width:100%;height:100%;object-fit:contain;">
            </span>
            <div style="font-size:1.25rem; font-weight:600; margin-bottom:8px; color:#1e40af; text-decoration: none;">Riwayat Peminjaman Alat</div>
            <div class="desc" style="margin-top: 18px; font-size: 1.08rem; color: #444; text-align: center; max-width: 320px;">
                Lihat riwayat dan status permintaan peminjaman alat Anda.
            </div>
        </a>
    </div>
@endsection
