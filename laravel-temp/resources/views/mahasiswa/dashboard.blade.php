@extends('layouts.app')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold mb-1">Dashboard Mahasiswa</h2>
    <p class="text-muted">Halo, <strong>{{ Auth::user()->name }}</strong>! Selamat datang di sistem BimTrack. Berikut adalah ringkasan progres bimbinganmu.</p>
</div>

<div class="row g-4 mb-5">
    
    <div class="col-md-4">
        <div class="card-custom p-4 border border-light shadow-sm" style="border-radius: 16px; background-color: #f8f9fa;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small fw-bold mb-1">Total Pengajuan</p>
                    <h2 class="fw-bold mb-0 text-dark">{{ $total }}</h2>
                </div>
                <div class="bg-secondary bg-opacity-10 text-secondary rounded-circle d-flex justify-content-center align-items-center" style="width: 55px; height: 55px;">
                    <i class="bi bi-file-earmark-text fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom p-4 border border-warning shadow-sm" style="border-radius: 16px; background-color: #fffdf5;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-warning small fw-bold mb-1">Menunggu Konfirmasi</p>
                    <h2 class="fw-bold mb-0 text-warning">{{ $menunggu }}</h2>
                </div>
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex justify-content-center align-items-center" style="width: 55px; height: 55px;">
                    <i class="bi bi-hourglass-split fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-custom p-4 border border-success shadow-sm" style="border-radius: 16px; background-color: #f5fff8;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-success small fw-bold mb-1">Jadwal Disetujui</p>
                    <h2 class="fw-bold mb-0 text-success">{{ $disetujui }}</h2>
                </div>
                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center" style="width: 55px; height: 55px;">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <div class="card-custom p-5 text-center shadow-sm" style="border-radius: 16px; background-color: #ffffff;">
            <div class="mb-3">
                <i class="bi bi-calendar2-check text-muted" style="font-size: 3rem;"></i>
            </div>
            <h5 class="fw-bold mb-2">Butuh Bimbingan Baru?</h5>
            <p class="text-muted mb-4 mx-auto" style="max-width: 500px;">
                Segera ajukan jadwal pertemuan dengan dosen pembimbing untuk mendiskusikan progres Proyek Akhir Anda.
            </p>
            <a href="/mahasiswa/booking" class="btn btn-orange px-4 py-2" style="border-radius: 10px;">
                <i class="bi bi-plus-lg me-2"></i> Buat Pengajuan Bimbingan
            </a>
        </div>
    </div>
</div>
@endsection