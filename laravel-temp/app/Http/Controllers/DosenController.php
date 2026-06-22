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
    // 1. Menampilkan Dashboard Dosen (Sekarang dengan Search & Filter)
    public function index(Request $request)
    {
        $query = Booking::with('mahasiswa')->where('dosen_id', Auth::id());

        // Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Pencarian Mahasiswa
        if ($request->has('search') && $request->search != '') {
            $query->whereHas('mahasiswa', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->latest()->get();

        // Statistik Dashboard (Tetap hitung semua data)
        $all = Booking::where('dosen_id', Auth::id());
        $menunggu = (clone $all)->where('status', 'Menunggu')->count();
        $disetujui = (clone $all)->where('status', 'Disetujui')->count();
        $selesai = (clone $all)->where('status', 'Selesai')->count();

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
    public function manajemenBooking(Request $request)
    {
        $query = Booking::with('mahasiswa')->where('dosen_id', Auth::id());

        // Cek filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at', 'desc')->get();

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
        $notifications = Auth::user()->notifications;
        return view('dosen.notifikasi', compact('notifications'));
    }

    // 8. Mengubah status notifikasi menjadi sudah dibaca
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return redirect()->back();
    }

    // 9. Tandai semua notifikasi dibaca
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}