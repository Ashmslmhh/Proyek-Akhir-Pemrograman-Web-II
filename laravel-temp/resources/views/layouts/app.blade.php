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
            <i class="bi bi-intersect fs-3 me-2" style="color: var(--primary-orange) !important;"></i>
            <h4 class="fw-bold mb-0">BimTrack</h4>
        </div>

        <nav class="nav flex-column flex-grow-1">
            @if(Auth::user()->role == 'dosen')

                <a class="nav-link {{ Request::is('dosen/dashboard') ? 'active' : '' }}"
                   href="/dosen/dashboard">
                    <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                </a>

                <a class="nav-link" href="#">
                    <i class="bi bi-bell-fill me-3"></i> Notifikasi
                </a>

                <a class="nav-link {{ Request::is('dosen/pengaturan') ? 'active' : '' }}"
                   href="{{ route('dosen.pengaturan') }}">
                    <i class="bi bi-gear-fill me-3"></i> Pengaturan
                </a>

            @else

                <a class="nav-link {{ Request::is('mahasiswa/dashboard') ? 'active' : '' }}"
                   href="/mahasiswa/dashboard">
                    <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                </a>

                <a class="nav-link {{ Request::is('mahasiswa/booking') ? 'active' : '' }}"
                   href="/mahasiswa/booking">
                    <i class="bi bi-calendar-plus-fill me-3"></i> Booking
                </a>

                <a class="nav-link {{ Request::is('mahasiswa/riwayat') ? 'active' : '' }}"
                   href="/mahasiswa/riwayat">
                    <i class="bi bi-clock-history me-3"></i> Riwayat Booking
                </a>

                <a class="nav-link" href="#">
                    <i class="bi bi-bell-fill me-3"></i> Notifikasi
                </a>

                <a class="nav-link {{ Request::is('mahasiswa/pengaturan') ? 'active' : '' }}"
                   href="{{ route('mahasiswa.pengaturan') }}">
                    <i class="bi bi-gear-fill me-3"></i> Pengaturan
                </a>

            @endif
        </nav>

        <div class="mt-auto">
            <a class="nav-link text-danger" href="/login">
                <i class="bi bi-box-arrow-left me-3"></i> Keluar
            </a>
        </div>
    </div>

    <div class="main-content">

        <div class="d-flex justify-content-end align-items-center mb-4">

            <a href="{{ Auth::user()->role == 'dosen'
                ? route('dosen.pengaturan')
                : route('mahasiswa.pengaturan') }}"
                class="d-flex align-items-center text-decoration-none">

                <div class="position-relative me-4">
                    <i class="bi bi-bell fs-4 text-muted"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger p-1">
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </div>

                @if(Auth::user()->foto)
                    <img src="{{ asset('storage/' . str_replace('public/', '', Auth::user()->foto)) }}"
                         class="rounded-circle me-3"
                         width="45"
                         height="45"
                         alt="Profile"
                         style="object-fit: cover;">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=F1986B&color=fff"
                         class="rounded-circle me-3"
                         width="45"
                         height="45"
                         alt="Profile">
                @endif

                <div>
                    <h6 class="mb-0 fw-bold text-dark">{{ Auth::user()->name }}</h6>
                    <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                </div>

            </a>

        </div>

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>