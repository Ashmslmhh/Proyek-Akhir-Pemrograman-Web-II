@extends('layouts.app')

@section('content')

    <div class="mb-5">
        <h1 class="fs-3 fw-bold text-dark mb-2">Pengaturan Profil dan Akun</h1>
        <p class="text-secondary">Kelola profil dan keamanan akun Anda.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Kata sandi berhasil diperbarui.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-5">
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 p-4 p-md-4 bg-white rounded-4 h-100">
                @if($editMode)
                <form action="{{ route('mahasiswa.profil.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h2 class="fs-5 fw-bold text-dark mb-4">Edit Profil</h2>

                    <div class="d-flex flex-column align-items-center mb-4">
                        @if($user->foto)
                            <img id="preview_foto" src="{{ asset('storage/' . str_replace('public/', '', $user->foto)) }}" alt="Foto Profil" class="img-fluid rounded-circle shadow-sm mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <img id="preview_foto" src="{{ 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" alt="Preview" class="img-fluid rounded-circle shadow-sm mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                        <label for="input_foto" class="btn btn-sm border border-secondary-subtle text-secondary rounded-pill px-3 cursor-pointer mt-2">
                            Unggah Foto
                        </label>
                        <input type="file" id="input_foto" name="foto" class="d-none" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label text-dark small">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light" id="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark small">Email</label>
                        <input type="email" class="form-control bg-light" id="email" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="form-label text-dark small">Status</label>
                        <input type="text" class="form-control bg-light" id="role" value="{{ ucfirst($user->role) }}" readonly>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('mahasiswa.pengaturan') }}" class="btn btn-secondary rounded-3">Batal</a>
                        <button type="submit" class="btn btn-warning text-white rounded-3">Simpan</button>
                    </div>
                </form>
                @else
                <h2 class="fs-5 fw-bold text-dark mb-4">Profil Pengguna</h2>
                <div class="text-center mb-4">
                    @if($user->foto)
                        <img src="{{ asset('storage/' . str_replace('public/', '', $user->foto)) }}" alt="Foto Profil" class="img-fluid rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <img src="{{ 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" alt="Foto Profil" class="img-fluid rounded-circle shadow-sm mx-auto d-block" style="width: 120px; height: 120px; object-fit: cover;">
                    @endif
                </div>
                <div class="mb-3">
                    <p class="text-muted small mb-1">Nama Lengkap</p>
                    <p class="fs-6 fw-semibold text-dark mb-0">{{ $user->name }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-muted small mb-1">Email</p>
                    <p class="fs-6 fw-semibold text-dark mb-0">{{ $user->email }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-muted small mb-1">Status</p>
                    <p class="fs-6 fw-semibold text-dark mb-0">{{ ucfirst($user->role) }}</p>
                </div>
                <div class="mt-auto text-end">
                    <a href="{{ route('mahasiswa.pengaturan', ['edit' => 'true']) }}" class="btn btn-warning btn-sm text-white px-3 d-inline-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill me-2" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zM8 6.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l-2.5 2.5-3-3L8.293 7.207a.5.5 0 0 1 .207-.207H8.5a.5.5 0 0 1 .5-.5zm-2.5 3.5a.5.5 0 0 0-.5.5v.5h-.5a.5.5 0 0 0-.5.5v.5h-.5a.5.5 0 0 0-.5.5v.5H3a.5.5 0 0 0-.5.5v.5h-.5a.5.5 0 0 0-.175.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.179A.5.5 0 0 0 8.5 13H9v-.5a.5.5 0 0 0-.5-.5H8v-.5a.5.5 0 0 0-.5-.5H7v-.5a.5.5 0 0 0-.5-.5H6v-.5a.5.5 0 0 0-.5-.5H5.5z"/>
                        </svg>
                        Edit
                    </a>
                </div>
                @endif
            </div>
        </div>

        <div class="col-12 col-lg-7">
            <div class="card shadow-sm border-0 p-4 p-md-5 bg-white rounded-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-dark bg-opacity-10 text-dark rounded-3 p-2 me-3 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
                        </svg>
                    </div>
                    <h2 class="fs-5 fw-bold text-dark mb-0">Ubah Kata Sandi</h2>
                </div>
                <hr class="text-secondary opacity-25 mb-4">
                <form action="{{ route('mahasiswa.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="current_password" class="form-label text-dark small">Kata Sandi Saat Ini</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark small">Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-dark small">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-dark text-white rounded-3">
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var preview = document.getElementById('preview_foto');

                    preview.src = e.target.result;
                    preview.classList.remove('d-none'); // Tampilkan gambar preview
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
