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
            @if(Auth::user()->role == 'dosen')
                <a class="nav-link {{ Request::is('dosen/dashboard') ? 'active' : '' }}" href="/dosen/dashboard">
                    <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                </a>
                <a class="nav-link {{ Request::is('dosen/manajemen-booking') ? 'active' : '' }}" href="/dosen/manajemen-booking">
                    <i class="bi bi-calendar-check-fill me-3"></i> Manajemen Booking
                </a>
                <a class="nav-link {{ Request::is('dosen/notifikasi') ? 'active' : '' }}" href="{{ route('dosen.notifikasi') }}">
                    <i class="bi bi-bell-fill me-3"></i> Notifikasi
                </a>
                <a class="nav-link {{ Request::is('dosen/pengaturan') ? 'active' : '' }}" href="{{ route('dosen.pengaturan') }}">
                    <i class="bi bi-gear-fill me-3"></i> Pengaturan
                </a>
            @else
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
                <a class="nav-link {{ Request::is('mahasiswa/pengaturan') ? 'active' : '' }}" href="{{ route('mahasiswa.pengaturan') }}"><i class="bi bi-gear-fill me-3"></i> Pengaturan</a>
            @endif
        </nav>

        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link text-danger border-0 bg-transparent text-start w-100">
                    <i class="bi bi-box-arrow-left me-3"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="search-bar w-50 position-relative">
                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                <input type="text" class="form-control rounded-pill ps-5" placeholder="Cari dosen, jadwal, mata kuliah...">
            </div>

            <div class="d-flex align-items-center">
                <div class="dropdown me-4">
                    <a href="#" class="text-decoration-none d-block" id="notifDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        <div class="position-relative">
                            <i class="bi bi-bell fs-4 text-muted cursor-pointer hover-warning"></i>
                            @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white" style="font-size: 0.65rem;">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-3 p-0" style="width: 380px; overflow: hidden;">
                        <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
                            <h6 class="mb-0 fw-bold text-dark">Notifikasi</h6>
                            <a href="{{ route('dosen.notifikasi.readAll') }}" class="text-decoration-none small text-muted hover-warning">Tandai semua dibaca</a>
                        </div>
                        <div class="list-group list-group-flush" style="max-height: 350px; overflow-y: auto;">
                            @forelse(Auth::user()->notifications->take(5) as $notification)
                                <a href="{{ Auth::user()->role == 'dosen' ? route('dosen.notifikasi') : '#' }}" class="list-group-item list-group-item-action p-3 {{ $notification->read_at ? 'bg-white' : 'bg-light' }} border-bottom text-decoration-none">
                                    <div class="d-flex align-items-start">
                                        <div class="p-2 rounded-3 me-3 text-success bg-success bg-opacity-10" style="width: 40px; height: 40px;">
                                            <i class="bi bi-check-circle-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1 small fw-bold text-dark">{{ $notification->data['mahasiswa_name'] ?? 'Notifikasi Baru' }}</h6>
                                            <p class="mb-1" style="font-size: 0.8rem; color: #666;">{{ $notification->data['pesan'] ?? 'Ada pengajuan baru.' }}</p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center p-4 text-muted small">Belum ada notifikasi.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <a href="{{ Auth::user()->role == 'dosen' ? route('dosen.pengaturan') : route('mahasiswa.pengaturan') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ Auth::user()->foto ? asset('storage/' . str_replace('public/', '', Auth::user()->foto)) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}" class="rounded-circle me-3 shadow-sm" width="45" height="45" alt="Profile" style="object-fit: cover;">
                    <div>
                        <h6 class="mb-0 fw-bold text-dark">{{ Auth::user()->name }}</h6>
                        <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                </a>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>