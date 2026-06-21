@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h2 class="fw-bold mb-1">Riwayat Sesi Bimbingan</h2>
            <p class="text-muted mb-0">Pantau seluruh status berkas pengajuan konsultasi Anda secara *real-time*.</p>
        </div>
        <div>
            <a href="/mahasiswa/booking" class="btn btn-orange"><i class="bi bi-plus-lg me-2"></i> Buat Pengajuan</a>
        </div>
    </div>

    <div class="card-custom">
        <div class="table-responsive">
            <table class="table table-custom table-hover mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="py-3 ps-4">No</th>
                        <th scope="col" class="py-3">Dosen Pembimbing</th>
                        <th scope="col" class="py-3">Tanggal & Waktu</th>
                        <th scope="col" class="py-3">Topik Bahasan</th>
                        <th scope="col" class="py-3">Status</th>
                        <th scope="col" class="py-3 pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4 fw-bold">1</td>
                        <td>
                            <div class="fw-bold">Dr. Andi Wijaya, S.Kom., M.T.</div>
                            <small class="text-muted">NIDN. 041208xxxx</small>
                        </td>
                        <td>
                            <div class="fw-semibold">12 Juni 2026</div>
                            <small class="text-muted">10:00 - 11:30 WIB</small>
                        </td>
                        <td class="text-wrap" style="max-width: 250px;">Bab 2 - Metodologi Penelitian Proyek Akhir</td>
                        <td><span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill small">Disetujui</span></td>
                        <td class="text-center pe-4">
                            <button class="btn btn-sm btn-light border" title="Detail"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-light border text-primary" title="Edit"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="ps-4 fw-bold">2</td>
                        <td>
                            <div class="fw-bold">Dr. Budi Sentosa, M.T.</div>
                            <small class="text-muted">NIDN. 042502xxxx</small>
                        </td>
                        <td>
                            <div class="fw-semibold">15 Juni 2026</div>
                            <small class="text-muted">13:30 - 15:00 WIB</small>
                        </td>
                        <td class="text-wrap" style="max-width: 250px;">Diskusi Arsitektur Database & Relasi Tabel</td>
                        <td><span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill small">Menunggu</span></td>
                        <td class="text-center pe-4">
                            <button class="btn btn-sm btn-light border" title="Detail"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-sm btn-light border text-primary" title="Edit"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-light border text-danger" title="Batalkan"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>

                    <tr>
                        <td class="ps-4 fw-bold">3</td>
                        <td>
                            <div class="fw-bold">Dr. Nina Kartika, M.T.</div>
                            <small class="text-muted">NIDN. 041909xxxx</small>
                        </td>
                        <td>
                            <div class="fw-semibold">21 Mei 2026</div>
                            <small class="text-muted">09:00 - 10:30 WIB</small>
                        </td>
                        <td class="text-wrap" style="max-width: 250px;">Review Desain UI/UX Wireframe v1</td>
                        <td><span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill small">Ditolak</span></td>
                        <td class="text-center pe-4">
                            <button class="btn btn-sm btn-light border" title="Detail"><i class="bi bi-eye"></i></button>
                            <span class="text-muted small">-</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection