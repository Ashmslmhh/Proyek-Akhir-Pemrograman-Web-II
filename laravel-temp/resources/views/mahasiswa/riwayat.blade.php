@extends('layouts.app')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-bold mb-1">Riwayat Sesi Bimbingan</h2>
        <p class="text-muted mb-0">
            Pantau seluruh status berkas pengajuan konsultasi Anda secara real-time.
        </p>
    </div>

    <div>
        <a href="/mahasiswa/booking" class="btn btn-orange">
            <i class="bi bi-plus-lg me-2"></i> Buat Pengajuan
        </a>
    </div>
</div>

{{-- Search Bar --}}
<div class="card-custom mb-4">
    <form method="GET" action="{{ url('/mahasiswa/riwayat') }}" autocomplete="off">
        <div class="position-relative">
            <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>

            <input
                type="search"
                name="search"
                value="{{ request()->has('search') ? request('search') : '' }}"
                class="form-control rounded-pill ps-5"
                placeholder="Cari dosen, topik, atau status..."
                autocomplete="off"
            >
        </div>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success small py-2 mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger small py-2 mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="card-custom">
    <div class="table-responsive">
        <table class="table table-custom table-hover mb-0">
            <thead>
                <tr>
                    <th class="py-3 ps-4">No</th>
                    <th class="py-3">Dosen Pembimbing</th>
                    <th class="py-3">Tanggal & Waktu</th>
                    <th class="py-3">Topik Bahasan</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 pe-4 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $index => $booking)
                    <tr>
                        <td class="ps-4 fw-bold">
                            {{ $bookings->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="fw-bold">
                                {{ $booking->dosen->name ?? 'Dosen Tidak Ditemukan' }}
                            </div>
                        </td>

                        <td>
                            <div class="fw-semibold">
                                {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}
                            </div>
                            <small class="text-muted">
                                {{ $booking->sesi_waktu }}
                            </small>
                        </td>

                        <td style="max-width:250px">
                            {{ $booking->topik }}
                        </td>

                        <td>
                            @if($booking->status == 'Disetujui')
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    Disetujui
                                </span>
                            @elseif($booking->status == 'Ditolak')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                    Ditolak
                                </span>
                            @elseif($booking->status == 'Selesai')
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    Selesai
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">
                                    Menunggu
                                </span>
                            @endif
                        </td>

                        <td class="text-center pe-4">
                            <div class="d-flex gap-2 justify-content-center align-items-center">
                                {{-- TOMBOL MATA (Selalu Muncul) --}}
                                <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>

                                @if($booking->status == 'Menunggu')
                                    {{-- TOMBOL EDIT --}}
                                    <a href="/mahasiswa/booking/{{ $booking->id }}/edit" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- TOMBOL BATALKAN --}}
                                    <form action="/mahasiswa/booking/{{ $booking->id }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-x-circle"></i>
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
                                    <h5 class="modal-title fw-bold">Detail Riwayat Bimbingan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start pt-3">
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Dosen Pembimbing</small>
                                        <div class="fw-bold text-dark">{{ $booking->dosen->name ?? 'Dosen Tidak Ditemukan' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Topik Bahasan</small>
                                        <div class="text-dark">{{ $booking->topik }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Catatan / Pesan Tambahan</small>
                                        <div class="text-dark p-3 bg-light rounded border">{{ $booking->catatan ?? 'Tidak ada catatan.' }}</div>
                                    </div>
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Status</small>
                                        <div class="text-dark fw-bold">{{ $booking->status }}</div>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Jadwal Usulan</small>
                                        <div class="text-dark fw-bold">
                                            <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d M Y') }} 
                                            <i class="bi bi-clock ms-2 me-1"></i> {{ $booking->sesi_waktu }}
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
                        <td colspan="6" class="text-center py-4 text-muted">
                            Tidak ada data yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    @if ($bookings->hasPages())
    <div class="d-flex justify-content-center mt-4">

        <nav>
            <ul class="pagination mb-0">

                {{-- Previous --}}
                @if ($bookings->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link rounded-start-pill">‹</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $bookings->previousPageUrl() }}">‹</a>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $bookings->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- Next --}}
                @if ($bookings->hasMorePages())
                    <li class="page-item">
                        <a class="page-link rounded-end-pill" href="{{ $bookings->nextPageUrl() }}">›</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link rounded-end-pill">›</span>
                    </li>
                @endif

            </ul>
        </nav>

    </div>
    @endif
</div>

@endsection