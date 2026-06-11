@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

<div class="input-group" style="max-width:350px;">
    <span class="input-group-text border-0 bg-white">
        🔍
    </span>
    <input type="text"
           class="form-control border-0"
           placeholder="Cari dosen, jadwal, atau topik...">
</div>

<div class="d-flex align-items-center gap-3">

    <div style="font-size:20px;">🔔</div>

    <div class="d-flex align-items-center gap-2">

        <div style="
            width:42px;
            height:42px;
            border-radius:50%;
            background:#6C63FF;">
        </div>

        <div>
            <div class="fw-bold">Aurelia Putri</div>
            <small class="text-muted">Mahasiswa</small>
        </div>

    </div>

</div>

</div>

<h3 class="fw-bold">
    Selamat pagi, Aurelia Putri 👋
</h3>

<p class="text-muted mb-4">
    Semangat untuk hari ini! Jangan lupa jadwal bimbinganmu.
</p>

<div class="row g-4 mb-4">

<div class="col-md-3">
    <div class="card border-0 p-4 h-100" style="background:#EEE9FF;border-radius:22px;">
        <small>Total Booking</small>
        <h2 class="fw-bold mt-2">12</h2>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-0 p-4 h-100" style="background:#EAF4FF;border-radius:22px;">
        <small>Menunggu</small>
        <h2 class="fw-bold mt-2">3</h2>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-0 p-4 h-100" style="background:#EAFBF0;border-radius:22px;">
        <small>Approved</small>
        <h2 class="fw-bold mt-2">7</h2>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-0 p-4 h-100" style="background:#FFF4E8;border-radius:22px;">
        <small>Selesai</small>
        <h2 class="fw-bold mt-2">5</h2>
    </div>
</div>

</div>

<div class="row g-4">

<div class="col-md-4">

    <div class="card border-0 p-4 h-100" style="border-radius:22px;">

        <h5 class="fw-bold mb-3">
            Jadwal Mendatang
        </h5>

        <div class="border rounded p-3">

            <h6>
                Dr. Andi Wijaya
            </h6>

            <small class="text-muted">
                Senin, 12 Juni 2026
            </small>

            <br>

            <small>
                09.00 - 10.00
            </small>

        </div>

    </div>

</div>

<div class="col-md-8">

    <div class="card border-0 p-4" style="border-radius:22px;">

        <h5 class="fw-bold mb-3">
            Riwayat Booking
        </h5>

        <table class="table">

            <thead>
                <tr>
                    <th>Dosen</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Dr. Andi Wijaya</td>
                    <td>12 Juni 2026</td>
                    <td>
                        <span class="badge bg-success">
                            Approved
                        </span>
                    </td>
                </tr>

                <tr>
                    <td>Dr. Siti Rahma</td>
                    <td>10 Juni 2026</td>
                    <td>
                        <span class="badge bg-warning">
                            Pending
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>
```

</div>

<div class="card border-0 mt-4 p-4"
     style="
     background:#6C63FF;
     color:white;
     border-radius:22px;">

<div class="d-flex justify-content-between align-items-center">

    <div>

        <h4>
            Siap booking bimbingan berikutnya?
        </h4>

        <small>
            Cari jadwal yang tersedia dan booking sekarang juga.
        </small>

    </div>

    <button class="btn btn-light">
        Booking Sekarang
    </button>

</div>

</div>

@endsection
