@extends('layouts.app')

@section('title', 'Pelaporan Alat Rumah Sakit')

@section('content')
    <h1 style="text-align:center; margin-top: 30px; font-size:2.5rem; color:#1e40af; font-weight:700;">
        Pelaporan Alat Rumah Sakit
    </h1>
    <div class="pelaporan-menu" style="display: flex; justify-content: center; align-items: flex-start; gap: 60px; margin-top: 60px;">
        <a href="{{ route('perawat.lapor-kerusakan.create') }}" class="pelaporan-card" style="background: #fff; color: #222; border-radius: 20px; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 32px rgba(0,0,0,0.10); cursor: pointer; transition: transform 0.15s, box-shadow 0.15s, background-color 0.3s; border: none; padding: 0 18px; text-decoration: none;">
            <span class="img-illu" style="width: 210px; height: 210px; margin-bottom: 18px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('uploads/report.png') }}" alt="Lapor Kerusakan Alat" style="width:100%;height:100%;object-fit:contain;">
            </span>
            <div style="font-size:1.25rem; font-weight:600; margin-bottom:8px; color:#1e40af; text-decoration: none;">Lapor Kerusakan Alat</div>
            <div class="desc" style="margin-top: 18px; font-size: 1.08rem; color: #444; text-align: center; max-width: 320px;">
                Lapor alat yang rusak agar dapat segera diperbaiki.
            </div>
        </a>
        <a href="{{ route('history-status-report') }}" class="pelaporan-card" style="background: #fff; border-radius: 20px; width: 500px; height: 500px; display: flex; flex-direction: column; align-items: center; justify-content: center; box-shadow: 0 4px 32px rgba(0,0,0,0.10); cursor: pointer; transition: transform 0.15s, box-shadow 0.15s, background-color 0.3s; border: none; padding: 0 18px; text-decoration: none;">
            <span class="img-illu" style="width: 210px; height: 210px; margin-bottom: 18px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('uploads/history.png') }}" alt="History & Status Report" style="width:100%;height:100%;object-fit:contain;">
            </span>
            <div style="font-size:1.25rem; font-weight:600; margin-bottom:8px; color:#1e40af; text-decoration: none;">History & Status Report</div>
            <div class="desc" style="margin-top: 18px; font-size: 1.08rem; color: #444; text-align: center; max-width: 320px;">
                Lihat history laporan Anda untuk melihat status laporan.
            </div>
        </a>
    </div>
@endsection
