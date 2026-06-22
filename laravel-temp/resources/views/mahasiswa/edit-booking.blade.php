@extends('layouts.app')

@section('content')
    <div class="mb-5">
        <h2 class="fw-bold mb-1">Edit Pengajuan Bimbingan</h2>
        <p class="text-muted">Perbarui detail pengajuan yang masih berstatus <strong>Menunggu</strong>.</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card-custom">
                <form action="/mahasiswa/booking/{{ $booking->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Pilih Dosen Pembimbing</label>
                        <select name="dosen_id" class="form-select text-dark" required>
                            <option value="" disabled>-- Pilih Dosen --</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->id }}" {{ $booking->dosen_id == $d->id ? 'selected' : '' }}>
                                    {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Tanggal Pertemuan</label>
                            <input type="date" name="tanggal" class="form-control"
                                   value="{{ $booking->tanggal }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted">Sesi Jam Kerja</label>
                            <select name="sesi_waktu" class="form-select" required>
                                <option value="" disabled>-- Pilih Sesi Jam --</option>
                                @foreach(['09:00 - 10:30 WIB', '10:30 - 12:00 WIB', '13:30 - 15:00 WIB', '15:30 - 17:00 WIB'] as $sesi)
                                    <option value="{{ $sesi }}" {{ $booking->sesi_waktu == $sesi ? 'selected' : '' }}>
                                        {{ $sesi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Topik Utama Pembahasan</label>
                        <input type="text" name="topik" class="form-control"
                               value="{{ $booking->topik }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Deskripsi Tambahan / Pertanyaan Spesifik</label>
                        <textarea name="catatan" class="form-control" rows="5" required>{{ $booking->catatan }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/mahasiswa/riwayat" class="btn btn-light px-4 py-2" style="border-radius:12px;">Batal</a>
                        <button type="submit" class="btn btn-orange px-4 py-2">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection