@extends('layouts.app')

@section('content')
    <div class="mb-5">
        <h2 class="fw-bold mb-1">Selamat pagi, Aurelia Putri 👋</h2>
        <p class="text-muted">Semangat untuk hari ini! Jangan sampai terlewat jadwal bimbingan berhargamu.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <h6 class="text-muted small fw-bold mb-2">Total Booking</h6>
                <h2 class="fw-bold mb-0 text-dark">12</h2>
                <small class="text-muted small">Semua Sesi</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <h6 class="text-muted small fw-bold mb-2">Menunggu</h6>
                <h2 class="fw-bold mb-0 text-warning">3</h2>
                <small class="text-muted small">Menunggu Respon</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <h6 class="text-muted small fw-bold mb-2">Disetujui</h6>
                <h2 class="fw-bold mb-0 text-success">7</h2>
                <small class="text-muted small">Jadwal Aktif</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card text-center">
                <h6 class="text-muted small fw-bold mb-2">Selesai</h6>
                <h2 class="fw-bold mb-0 style" style="color: var(--primary-orange);">5</h2>
                <small class="text-muted small">Bimbingan Selesai</small>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-5">
            <div class="card-custom h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Jadwal Terdekat</h5>
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill small fw-bold">Segera Datang</span>
                </div>
                
                <div class="p-4 rounded-4" style="background-color: var(--bg-main); border: 1px dashed var(--primary-orange);">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-center bg-white p-2 rounded-3 shadow-sm me-3" style="min-width: 60px;">
                            <span class="d-block small text-muted text-uppercase fw-bold">Jun</span>
                            <h3 class="fw-bold mb-0 text-dark">12</h3>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Dr. Andi Wijaya, S.Kom., M.T.</h6>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i> 10:00 - 11:30 WIB</small>
                        </div>
                    </div>
                    <hr class="my-3 text-muted">
                    <div class="small text-muted">
                        <strong class="d-block text-dark mb-1">Topik Bahasan:</strong>
                        Bab 2 - Kajian Pustaka & Metodologi Pengembangan Aplikasi Mobile Calorie Tracker.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card-custom h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Riwayat Booking Terbaru</h5>
                    <a href="/mahasiswa/riwayat" class="small text-decoration-none fw-semibold" style="color: var(--primary-orange);">Lihat Semua</a>
                </div>
                
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between align-items-center p-2 rounded-3 hover-bg">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Dr.+Sandi&background=random" class="rounded-circle me-3" width="40">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Sandi Harno, M.Kom.</h6>
                                <small class="text-muted">6 Jun 2026 • 09:00 WIB</small>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Disetujui</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 rounded-3 hover-bg">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name=Budi+S&background=random" class="rounded-circle me-3" width="40">
                            <div>
                                <h6 class="mb-0 fw-bold">Dr. Budi Sentosa, M.T.</h6>
                                <small class="text-muted">5 Jun 2026 • 15:00 WIB</small>
                            </div>
                        </div>
                        <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill">Menunggu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banner-cta d-flex flex-column flex-md-row justify-content-between align-items-center shadow-sm">
        <div class="mb-3 mb-md-0 text-center text-md-start">
            <h5 class="fw-bold mb-1">Siap melakukan booking bimbingan berikutnya?</h5>
            <p class="mb-0 opacity-75 small">Cari waktu luang dosen pembimbingmu dan ajukan konsultasi dalam hitungan detik.</p>
        </div>
        <a href="/mahasiswa/booking" class="btn btn-light fw-bold px-4 py-2.5" style="color: var(--primary-orange); border-radius: 12px;">Booking Sekarang</a>
    </div>
@endsection