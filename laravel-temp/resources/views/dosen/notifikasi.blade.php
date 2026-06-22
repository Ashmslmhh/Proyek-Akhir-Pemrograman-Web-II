@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold mb-1">Notifikasi Masuk</h2>
    <p class="text-muted">Daftar pemberitahuan aktivitas pengajuan bimbingan dari mahasiswa.</p>
</div>

<div class="card shadow-sm border-0 bg-white rounded-4 p-4">
    <div class="list-group list-group-flush">
        @forelse($notifications as $notification)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3 border-bottom {{ $notification->read_at ? 'opacity-75 bg-light' : '' }}">
                <div class="d-flex align-items-center">
                    <div class="p-2 bg-orange bg-opacity-10 text-warning rounded-circle me-3" style="background-color: #ff823a20; color: var(--primary-orange) !important;">
                        <i class="bi bi-envelope-fill fs-5"></i>
                    </div>
                    <div>
                        <p class="mb-1 text-dark">
                            <strong>{{ $notification->data['mahasiswa_name'] }}</strong> {{ $notification->data['pesan'] }}
                        </p>
                        <small class="text-muted d-block mb-1">Topik: "{{ $notification->data['topik'] }}"</small>
                        <span class="text-muted small fs-7">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                
                @if(!$notification->read_at)
                    <form action="{{ route('dosen.notifikasi.read', $notification->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 small text-muted">
                            Tandai dibaca
                        </button>
                    </form>
                @else
                    <span class="badge bg-light text-muted border rounded-pill px-3 py-1.5 fw-normal">Sudah dibaca</span>
                @endif
            </div>
        @empty
            <div class="text-center py-5 text-muted">
                <i class="bi bi-bell-slash fs-1 d-block mb-2 opacity-50"></i>
                Belum ada notifikasi baru untuk Anda.
            </div>
        @endforelse
    </div>
</div>
@endsection