@extends('layouts.app')

@section('content')
    <div class="mb-5">
        <h2 class="fw-bold mb-1">Booking Jadwal Bimbingan</h2>
        <p class="text-muted">Pilih dosen, tentukan waktu luang, dan isi materi pembicaraan secara jelas.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom">
                <form action="/mahasiswa/riwayat" method="GET">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Pilih Dosen Pembimbing</label>
                        <select class="form-select text-dark" required>
                            <option value="" disabled selected>-- Pilih Dosen --</option>
                            <option value="1">Dr. Andi Wijaya, S.Kom., M.T.</option>
                            <option value="2">Dr. Sandi Harno, M.Kom.</option>
                            <option value="3">Prof. Ahmad Yani, Ph.D.</option>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Tanggal Pertemuan</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Sesi Jam Kerja</label>
                            <select class="form-select" required>
                                <option value="" disabled selected>-- Pilih Sesi Jam --</option>
                                <option value="1">Sesi 1 (09:00 - 10:30 WIB)</option>
                                <option value="2">Sesi 2 (10:30 - 12:00 WIB)</option>
                                <option value="3">Sesi 3 (13:30 - 15:00 WIB)</option>
                                <option value="4">Sesi 4 (15:30 - 17:00 WIB)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Topik Utama Pembahasan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Diskusi Bab III atau Revisi Diagram UML" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Deskripsi Tambahan / Pertanyaan Spesifik</label>
                        <textarea class="form-control" rows="5" placeholder="Tulis rincian kendala yang ingin Anda konsultasikan agar dosen dapat mempelajari terlebih dahulu..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/mahasiswa/dashboard" class="btn btn-light px-4 py-2" style="border-radius:12px;">Batal</a>
                        <button type="submit" class="btn btn-orange px-4 py-2">Kirim Pengajuan Booking</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">
            <div class="card-custom text-white" style="background-color: var(--text-dark);">
                <h5 class="fw-bold mb-3" style="color: var(--primary-orange);">💡 Tips Bimbingan</h5>
                <ul class="small opacity-75 ps-3 mb-0" style="line-height: 1.8;">
                    <li>Pastikan Anda telah mengunggah progres file terbaru ke Google Drive/GitHub tim Anda.</li>
                    <li>Tulis deskripsi kendala secara ringkas dan *to the point* (tidak bertele-tele).</li>
                    <li>Ajukan jadwal minimal 2 hari sebelum pelaksanaan agar dosen berkesempatan meninjau jadwal mereka.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection