<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BimTrack - Sistem Bimbingan Mandiri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="sidebar d-flex flex-column">
        <div class="d-flex align-items-center mb-5 px-2">
            <i class="bi bi-intersect fs-3 text-warning me-2" style="color: var(--primary-orange) !important;"></i>
            <h4 class="fw-bold mb-0" style="color: var(--text-dark);">BimTrack</h4>
        </div>
        
        <nav class="nav flex-column flex-grow-1">
            <a class="nav-link {{ Request::is('mahasiswa/dashboard') ? 'active' : '' }}" href="/mahasiswa/dashboard">
                <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
            </a>
            <a class="nav-link {{ Request::is('mahasiswa/booking') ? 'active' : '' }}" href="/mahasiswa/booking">
                <i class="bi bi-calendar-plus-fill me-3"></i> Booking
            </a>
            <a class="nav-link {{ Request::is('mahasiswa/riwayat') ? 'active' : '' }}" href="/mahasiswa/riwayat">
                <i class="bi bi-clock-history me-3"></i> Riwayat Booking
            </a>
            <a class="nav-link" href="#"><i class="bi bi-bell-fill me-3"></i> Notifikasi</a>
            <a class="nav-link" href="#"><i class="bi bi-person-fill me-3"></i> Profil</a>
            <a class="nav-link" href="#"><i class="bi bi-gear-fill me-3"></i> Pengaturan</a>
        </nav>

        <div class="mt-auto">
            <a class="nav-link text-danger" href="/login"><i class="bi bi-box-arrow-left me-3"></i> Keluar</a>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="search-bar w-50 position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control rounded-pill ps-5" placeholder="Cari dosen, jadwal, mata kuliah...">
            </div>
            <div class="d-flex align-items-center">
                <div class="position-relative me-4">
                    <i class="bi bi-bell fs-4 text-muted cursor-pointer"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1">
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </div>
                <img src="https://ui-avatars.com/api/?name=Aurelia+Putri&background=F1986B&color=fff" class="rounded-circle me-3" width="45" height="45">
                <div>
                    <h6 class="mb-0 fw-bold">Aurelia Putri</h6>
                    <small class="text-muted">Mahasiswa</small>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>