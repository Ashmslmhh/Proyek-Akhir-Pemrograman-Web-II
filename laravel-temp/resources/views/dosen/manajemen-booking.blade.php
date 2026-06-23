@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Manajemen Booking</h2>
            <p class="text-muted">Pantau seluruh riwayat dan status pengajuan bimbingan mahasiswa.</p>
        </div>
        
        <form action="{{ url('/dosen/manajemen-booking') }}" method="GET" class="w-25">
            <input type="text" name="search" class="form-control rounded-pill shadow-sm" placeholder="Cari nama mahasiswa..." value="{{ request('search') }}">
        </form>
    </div>
</div>

<div class="d-flex gap-2 mb-4">
    <a href="{{ url('/dosen/manajemen-booking') }}" 
       class="btn {{ !request('status') ? 'btn-warning text-white' : 'btn-light border' }} rounded-pill px-4">Semua</a>
    <a href="{{ url('/dosen/manajemen-booking?status=Menunggu') }}" 
       class="btn {{ request('status') == 'Menunggu' ? 'btn-warning text-white' : 'btn-light border' }} rounded-pill px-4">Menunggu</a>
    <a href="{{ url('/dosen/manajemen-booking?status=Disetujui') }}" 
       class="btn {{ request('status') == 'Disetujui' ? 'btn-warning text-white' : 'btn-light border' }} rounded-pill px-4">Disetujui</a>
    <a href="{{ url('/dosen/manajemen-booking?status=Selesai') }}" 
       class="btn {{ request('status') == 'Selesai' ? 'btn-warning text-white' : 'btn-light border' }} rounded-pill px-4">Selesai</a>
    <a href="{{ url('/dosen/manajemen-booking?status=Ditolak') }}" 
       class="btn {{ request('status') == 'Ditolak' ? 'btn-warning text-white' : 'btn-light border' }} rounded-pill px-4">Ditolak</a>
</div>

<div class="card-custom border-0 shadow-sm p-0 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-muted small">
                <tr>
                    <th class="ps-4 py-3">Nama Mahasiswa</th>
                    <th class="py-3">Topik Bahasan</th>
                    <th class="py-3">Jadwal Pertemuan</th>
                    <th class="py-3 text-center">Status</th>
                    <th class="pe-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td class="ps-4 py-3">
                        <div class="fw-bold text-dark">{{ $booking->mahasiswa->name ?? 'Mahasiswa' }}</div>
                    </td>
                    <td class="py-3">
                        <div class="fw-bold text-dark">{{ $booking->topik }}</div>
                    </td>
                    <td class="py-3">
                        <div class="small text-dark fw-bold">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}</div>
                        <div class="small text-muted">{{ $booking->sesi_waktu }} WIB</div>
                    </td>
                    <td class="py-3 text-center">
                        @if($booking->status == 'Disetujui')
                            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Disetujui</span>
                        @elseif($booking->status == 'Ditolak')
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">Ditolak</span>
                        @elseif($booking->status == 'Selesai')
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">Selesai</span>
                        @else
                            <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Menunggu</span>
                        @endif
                    </td>
                    <td class="pe-4 py-3 text-center">
                        <div class="d-flex gap-2 justify-content-center align-items-center">
                            
                            <button type="button" class="btn btn-sm btn-light border text-muted px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">
                                <i class="bi bi-eye"></i> Detail
                            </button>

                            @if($booking->status == 'Disetujui')
                                <form action="{{ url('/dosen/booking/'.$booking->id.'/status') }}" method="POST" class="m-0" onsubmit="return confirm('Tandai sesi bimbingan ini telah selesai?');">
                                    @csrf
                                    <input type="hidden" name="status" value="Selesai">
                                    <button type="submit" class="btn btn-sm text-white px-3 rounded-pill shadow-sm" style="background-color: var(--primary-orange); border: none;">
                                        <i class="bi bi-check2-all"></i> Selesai
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-bottom-0 pb-0">
                                <h5 class="modal-title fw-bold">Detail Bimbingan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start pt-3">
                                <div class="mb-3">
                                    <small class="text-muted d-block">Nama Mahasiswa</small>
                                    <div class="fw-bold text-dark">{{ $booking->mahasiswa->name ?? 'Mahasiswa' }}</div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Topik Bahasan</small>
                                    <div class="text-dark">{{ $booking->topik }}</div>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted d-block">Catatan / Pesan</small>
                                    <div class="text-dark p-3 bg-light rounded border">{{ $booking->catatan ?? '-' }}</div>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Jadwal</small>
                                    <div class="text-dark fw-bold">
                                        <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }}
                                        <i class="bi bi-clock ms-2 me-1"></i> {{ $booking->sesi_waktu }} WIB
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 pt-0">
                                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection