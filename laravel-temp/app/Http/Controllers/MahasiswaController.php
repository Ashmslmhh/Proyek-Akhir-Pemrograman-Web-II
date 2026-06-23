<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // Pastikan Model Booking dipanggil
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
    /**
     * 1. Menampilkan Halaman Dashboard Mahasiswa
     */
    public function index()
    {
        $userId = Auth::id();

        // Menghitung statistik untuk Dashboard
        $totalPengajuan = Booking::where('mahasiswa_id', $userId)->count();
        $menunggu = Booking::where('mahasiswa_id', $userId)->where('status', 'Menunggu')->count();
        $disetujui = Booking::where('mahasiswa_id', $userId)->where('status', 'Disetujui')->count();
        
        // Tambahan statistik jika diperlukan di view
        $ditolak = Booking::where('mahasiswa_id', $userId)->where('status', 'Ditolak')->count();
        $selesai = Booking::where('mahasiswa_id', $userId)->where('status', 'Selesai')->count();

        return view('mahasiswa.dashboard', compact(
            'totalPengajuan', 
            'menunggu', 
            'disetujui', 
            'ditolak', 
            'selesai'
        ));
    }

    /**
     * 2. Memperbarui foto profil pengguna.
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete($user->foto);
            }
            $path = $request->file('foto')->store('public/fotos');
            $user->foto = $path;
            $user->save();
        }

        return redirect()->route('mahasiswa.pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * 3. Menampilkan halaman pengaturan (profil dan ubah password).
     */
    public function pengaturan(Request $request)
    {
        $user = Auth::user();
        $editMode = $request->query('edit') === 'true';

        return view('mahasiswa.pengaturan', [
            'user' => $user,
            'editMode' => $editMode
        ]);
    }

    /**
     * 4. Memperbarui kata sandi pengguna.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'password-updated');
    }

    /**
     * 5. Menampilkan halaman notifikasi untuk mahasiswa.
     */
    public function notifikasi()
    {
        $notifications = Auth::user()->notifications;

        return view('mahasiswa.notifikasi', compact('notifications'));
    }

    /**
     * 6. Tandai notifikasi sebagai sudah dibaca.
     */
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->route('mahasiswa.notifikasi');
    }

    /**
     * 7. Tandai semua notifikasi sebagai sudah dibaca.
     */
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}