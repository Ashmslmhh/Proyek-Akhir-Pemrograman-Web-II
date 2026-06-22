@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold mb-1">Dashboard Dosen</h2>
        <p class="text-muted mb-0">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>. Berikut ringkasan jadwal Anda.</p>
    </div>
    <div class="text-end">
        <div class="text-muted small">Tanggal Hari Ini</div>
        <div class="fw-bold" style="color: var(--primary-orange);">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card-custom bg-white border-start border-4 border-warning shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold mb-1">Menunggu Persetujuan</h6>
                    <h2 class="fw-bold text-dark mb-0">{{ $menunggu }} <span class="fs-6 fw-normal text-muted">Mahasiswa</span></h2>
                </div>
                <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card-custom bg-white border-start border-4 border-success shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold mb-1">Jadwal Disetujui</h6>
                    <h2 class="fw-bold text-dark mb-0">{{ $disetujui }} <span class="fs-6 fw-normal text-muted">Sesi</span></h2>
                </div>
                <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                    <i class="bi bi-check2-circle fs-4"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom bg-white border-start border-4 border-primary shadow-sm p-4 h-100 d-flex flex-column justify-content-center" style="border-color: var(--primary-orange) !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted fw-bold mb-1">Total Bimbingan Selesai</h6>
                    <h2 class="fw-bold text-dark mb-0">{{ $selesai }} <span class="fs-6 fw-normal text-muted">Sesi</span></h2>
                </div>
                <div class="p-3 rounded-circle" style="background-color: #ff823a20; color: var(--primary-orange);">
                    <i class="bi bi-journal-check fs-4"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-end mb-3">
    <h5 class="fw-bold mb-0">Permintaan Bimbingan Baru</h5>
    <a href="#" class="text-decoration-none small fw-bold" style="color: var(--primary-orange);">Lihat Semua <i class="bi bi-arrow-right"></i></a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
@endif

<div class="card-custom border-0 shadow-sm p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small">
                <tr>
                    <th class="ps-4 py-3">Nama Mahasiswa</th>
                    <th class="py-3">Topik Bahasan</th>
                    <th class="py-3">Usulan Tanggal & Waktu</th>
                    <th class="pe-4 py-3 text-center">Aksi (Persetujuan)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings->where('status', 'Menunggu') as $booking)
                <tr>
                    <td class="ps-4 py-3">
                        <div class="fw-bold text-dark">{{ $booking->mahasiswa->name ?? 'Mahasiswa' }}</div>
                        <div class="small text-muted">Mahasiswa Bimbingan</div>
                    </td>
                    <td class="py-3">
                        <div class="fw-bold text-dark">{{ $booking->topik }}</div>
                        <div class="small text-muted">{{ Str::limit($booking->catatan, 40) }}</div>
                    </td>
                    <td class="py-3">
                        <div class="badge bg-light text-dark border mb-1"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</div><br>
                        <div class="badge bg-light text-dark border"><i class="bi bi-clock me-1"></i> {{ $booking->sesi_waktu }}</div>
                    </td>
                    <td class="pe-4 py-3 text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            <form action="/dosen/booking/{{ $booking->id }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-sm btn-success px-3 rounded-pill" title="Setujui">
                                    <i class="bi bi-check-lg me-1"></i> Terima
                                </button>
                            </form>

                            <form action="/dosen/booking/{{ $booking->id }}/status" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-sm btn-outline-danger px-3 rounded-pill" title="Tolak / Reschedule">
                                    <i class="bi bi-x-lg me-1"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Belum ada permintaan bimbingan baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection