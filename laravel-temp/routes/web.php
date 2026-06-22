<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

/*
|--------------------------------------------------------------------------
| Rute Autentikasi & Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

// Rute Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);


/*
|--------------------------------------------------------------------------
| Rute Dosen (Versi Lengkap)
|--------------------------------------------------------------------------
*/
Route::prefix('dosen')->middleware(['auth'])->group(function () {
    
    // Dashboard Utama Dosen
    Route::get('/dashboard', [DosenController::class, 'index']);
    
    // Fungsi Terima / Tolak Permintaan Bimbingan
    Route::post('/booking/{id}/status', [DosenController::class, 'updateStatus']);

    // Halaman Manajemen Booking (Semua Riwayat)
    Route::get('/manajemen-booking', [DosenController::class, 'manajemenBooking'])->name('dosen.manajemenBooking'); 

    // Halaman Pengaturan Dosen & Update Profil/Password
    Route::get('/pengaturan', [DosenController::class, 'pengaturan'])->name('dosen.pengaturan');
    Route::put('/profil/update', [DosenController::class, 'updateProfil'])->name('dosen.profil.update');
    Route::put('/password/update', [DosenController::class, 'updatePassword'])->name('dosen.password.update');

    // Rute Notifikasi Dosen
    Route::get('/notifikasi', [DosenController::class, 'notifikasi'])->name('dosen.notifikasi');
    Route::get('/notifikasi/read-all', [DosenController::class, 'markAllRead'])->name('dosen.notifikasi.readAll');
    Route::post('/notifikasi/{id}/read', [DosenController::class, 'markAsRead'])->name('dosen.notifikasi.read');

});


/*
|--------------------------------------------------------------------------
| Rute UI Mahasiswa
|--------------------------------------------------------------------------
*/
Route::prefix('mahasiswa')->middleware(['auth'])->group(function () {

    // Dashboard Mahasiswa
    Route::get('/dashboard', function () {
        $id = Auth::id();
        $total = \App\Models\Booking::where('mahasiswa_id', $id)->count();
        $menunggu = \App\Models\Booking::where('mahasiswa_id', $id)->where('status', 'Menunggu')->count();
        $disetujui = \App\Models\Booking::where('mahasiswa_id', $id)->where('status', 'Disetujui')->count();

        return view('mahasiswa.dashboard', compact('total', 'menunggu', 'disetujui'));
    });

    // Booking
    Route::get('/booking', [BookingController::class, 'create']);
    Route::post('/booking', [BookingController::class, 'store']);
    // Edit Booking
    Route::get('/booking/{id}/edit', [BookingController::class, 'edit']);
    Route::put('/booking/{id}', [BookingController::class, 'update']);

    // Riwayat
    Route::get('/riwayat', [BookingController::class, 'index']);

    // Notifikasi
    Route::get('/notifikasi', function () {
        $notifications = \App\Models\Notification::where('user_id', Auth::id())->latest()->get();
        return view('mahasiswa.notifikasi', compact('notifications'));
    });

    // Hapus Booking (Fitur Batalkan)
    Route::delete('/booking/{id}', [BookingController::class, 'destroy']);

    // Pengaturan
    Route::get('/pengaturan', [MahasiswaController::class, 'pengaturan'])->name('mahasiswa.pengaturan');
    Route::put('/profil/update', [MahasiswaController::class, 'updateProfil'])->name('mahasiswa.profil.update');
    Route::put('/password/update', [MahasiswaController::class, 'updatePassword'])->name('mahasiswa.password.update');
});


/*
|--------------------------------------------------------------------------
| Rute Admin & Backend
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth']);
Route::resource('users', UserController::class)->middleware(['auth']);