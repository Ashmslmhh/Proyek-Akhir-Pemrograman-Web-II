<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    // 1. Menampilkan Dashboard Dosen
    public function index()
    {
        $bookings = Booking::with('mahasiswa')
                    ->where('dosen_id', Auth::id())
                    ->latest()
                    ->get();

        $menunggu = $bookings->where('status', 'Menunggu')->count();
        $disetujui = $bookings->where('status', 'Disetujui')->count();
        $selesai = $bookings->where('status', 'Selesai')->count();

        return view('dosen.dashboard', compact('bookings', 'menunggu', 'disetujui', 'selesai'));
    }

    // 2. Fungsi untuk mengubah status (Terima/Tolak)
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->dosen_id == Auth::id()) {
            $booking->status = $request->status;
            $booking->save();
            return redirect()->back()->with('success', 'Status bimbingan berhasil diperbarui menjadi: ' . $request->status);
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki akses.');
    }

    // 3. Menampilkan semua riwayat/manajemen booking untuk Dosen
    public function manajemenBooking()
    {
        $bookings = Booking::with('mahasiswa')
                    ->where('dosen_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('dosen.manajemen-booking', compact('bookings'));
    }

    // 4. Menampilkan halaman pengaturan dosen
    public function pengaturan(Request $request)
    {
        $user = Auth::user();
        $editMode = $request->has('edit');
        
        return view('dosen.pengaturan', compact('user', 'editMode'));
    }

    // 5. Update Foto Profil Dosen
    public function updateProfil(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists($user->foto)) {
                Storage::delete($user->foto);
            }
            
            $path = $request->file('foto')->store('public/fotos');
            $user->foto = $path;
            $user->save();
        }

        return redirect()->route('dosen.pengaturan')->with('success', 'Foto profil berhasil diperbarui.');
    }

    // 6. Update Password Dosen
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        $user = User::find(Auth::id());
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('status', 'password-updated');
    }

    // 7. Menampilkan halaman notifikasi dosen
    public function notifikasi()
    {
        // Mengambil semua notifikasi milik dosen yang sedang login
        $notifications = Auth::user()->notifications;

        return view('dosen.notifikasi', compact('notifications'));
    }

    // 8. Mengubah status notifikasi menjadi sudah dibaca (per ID)
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back();
    }

    // 9. Tandai semua notifikasi dibaca (untuk dropdown)
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}