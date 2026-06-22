@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
    <div>
        <h2 class="fw-bold mb-1">Riwayat Sesi Bimbingan</h2>
        <p class="text-muted mb-0">Pantau seluruh status berkas pengajuan konsultasi Anda secara *real-time*.</p>
    </div>
    <div>
        <a href="/mahasiswa/booking" class="btn btn-orange"><i class="bi bi-plus-lg me-2"></i> Buat Pengajuan</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success small py-2 mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger small py-2 mb-4">{{ session('error') }}</div>
@endif

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom table-hover mb-0">
            <thead>
                <tr>
                    <th scope="col" class="py-3 ps-4">No</th>
                    <th scope="col" class="py-3">Dosen Pembimbing</th>
                    <th scope="col" class="py-3">Tanggal & Waktu</th>
                    <th scope="col" class="py-3">Topik Bahasan</th>
                    <th scope="col" class="py-3">Status</th>
                    <th scope="col" class="py-3 pe-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $index => $booking)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-bold">{{ $booking->dosen->name ?? 'Dosen Tidak Ditemukan' }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</div>
                            <small class="text-muted">{{ $booking->sesi_waktu }}</small>
                        </td>
                        <td class="text-wrap" style="max-width: 250px;">{{ $booking->topik }}</td>
                        <td>
                            @if($booking->status == 'Disetujui')
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill small">Disetujui</span>
                            @elseif($booking->status == 'Ditolak')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill small">Ditolak</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill small">Menunggu</span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            @if($booking->status == 'Menunggu')
                                <a href="/mahasiswa/booking/{{ $booking->id }}/edit"
                                class="btn btn-sm btn-outline-primary me-1" title="Edit Pengajuan">Edit</a>
                                <form action="/mahasiswa/booking/{{ $booking->id }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Batalkan Pengajuan">Batalkan</button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-light border" title="Detail"><i class="bi bi-eye"></i></button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat pengajuan bimbingan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection