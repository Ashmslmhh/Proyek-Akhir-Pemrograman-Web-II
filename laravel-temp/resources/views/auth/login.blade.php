<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BimTrack - Masuk Ke Akun Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <p class="text-muted small mb-4">Masukkan email dan password universitas Anda untuk masuk ke sistem.</p>
                    
                    <form action="/mahasiswa/dashboard" method="GET">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Alamat Email</label>
                            <input type="email" class="form-control" placeholder="mahasiswa@ulm.ac.id" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Kata Sandi</label>
                            <input type="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                            </div>
                            <a href="#" class="small text-decoration-none" style="color: var(--primary-orange);">Lupa Password?</a>
                        </div>
                        <button type="submit" class="btn btn-orange w-100 py-2.5">Masuk Sekarang</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
</html>