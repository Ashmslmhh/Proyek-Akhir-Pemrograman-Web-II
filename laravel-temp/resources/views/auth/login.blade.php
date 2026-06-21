<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BimTrack - Masuk Ke Akun Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="login-container d-flex align-items-center justify-content-center p-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 login-card bg-white p-0 d-flex flex-column flex-md-row">
                
                <div class="col-md-6 p-5 d-flex flex-column justify-content-center text-center" style="background-color: var(--bg-sidebar);">
                    <div class="mb-4">
                        <i class="bi bi-intersect display-4" style="color: var(--primary-orange);"></i>
                        <h3 class="fw-bold mt-2">BimTrack</h3>
                    </div>
                    <p class="fw-semibold text-muted">Atur jadwal bimbingan lebih terstruktur, fleksibel, dan efisien bersama dosen pembimbing Anda.</p>
                    <img src="https://illustrations.popsy.co/amber/work-from-home.svg" class="img-fluid mx-auto mt-3" style="max-height: 200px;">
                </div>

                <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
                    <h4 class="fw-bold mb-2">Login ke Akun Anda</h4>
                    <p class="text-muted small mb-4">Masukkan email universitas Anda untuk masuk ke sistem.</p>
                    
                    <form action="/login" method="POST">
                        @csrf

                        @if($errors->has('loginError'))
                            <div class="alert alert-danger small py-2">{{ $errors->first('loginError') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success small py-2">{{ session('success') }}</div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Email ULM</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="mahasiswa@mhs.ulm.ac.id" required>
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kata Sandi</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                            @error('password')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                            </div>
                            <a href="#" class="small text-decoration-none" style="color: var(--primary-orange);">Lupa Password?</a>
                        </div>

                        <button type="submit" class="btn btn-orange w-100 py-2.5">Masuk Sekarang</button>
                        
                        <div class="text-center small mt-4">
                            Belum punya akun? <a href="/register" class="text-decoration-none fw-bold" style="color: var(--primary-orange);">Daftar di sini</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>