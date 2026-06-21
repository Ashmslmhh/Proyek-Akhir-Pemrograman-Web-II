@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Dashboard Dosen</h2>
    <p class="text-muted">Selamat datang, {{ Auth::user()->name }}. Ini adalah daftar mahasiswa yang mengajukan bimbingan kepada Anda.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom table-hover">
            <thead>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal & Waktu</th>
                    <th>Topik</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr>
                    <td class="fw-bold">{{ $booking->mahasiswa->name }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }} <br>
                        <small class="text-muted">{{ $booking->sesi_waktu }}</small>
                    </td>
                    <td>{{ $booking->topik }}</td>
                    <td>
                        <span class="badge 
                            {{ $booking->status == 'Disetujui' ? 'bg-success' : ($booking->status == 'Ditolak' ? 'bg-danger' : 'bg-warning text-dark') }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td>
                        @if($booking->status == 'Menunggu')
                            <form action="/dosen/booking/{{ $booking->id }}/status" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-sm btn-success" title="Setujui"><i class="bi bi-check-lg"></i></button>
                            </form>
                            <form action="/dosen/booking/{{ $booking->id }}/status" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-sm btn-danger" title="Tolak"><i class="bi bi-x-lg"></i></button>
                            </form>
                        @else
                            <span class="text-muted small">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pengajuan bimbingan yang masuk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection