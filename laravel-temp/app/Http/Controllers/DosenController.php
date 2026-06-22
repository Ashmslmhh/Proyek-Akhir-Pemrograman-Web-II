<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use App\Models\Notification;

class DosenController extends Controller
{
    // Menampilkan halaman dashboard dosen berisi daftar booking yang masuk
    public function dashboard()
    {
        // Ambil data booking yang ditujukan hanya untuk dosen yang sedang login
        $bookings = Booking::with('mahasiswa')
                    ->where('dosen_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('dosen.dashboard', compact('bookings'));
    }

    // Fungsi untuk menyetujui atau menolak booking
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->dosen_id == Auth::id()) {

            $booking->update([
                'status' => $request->status
            ]);

            // Buat notif untuk mahasiswa
            Notification::create([
                'user_id' => $booking->mahasiswa_id,
                'judul' => 'Status Bimbingan',
                'pesan' => 'Pengajuan bimbingan kamu telah '
                    . strtolower($request->status),
            ]);
        }

        return back()->with('success', 'Status bimbingan berhasil diperbarui!');
    }

    public function pengaturan(Request $request)
    {
        $user = Auth::user();
        $editMode = $request->query('edit') === 'true';

        return view('dosen.pengaturan', compact('user', 'editMode'));
    }

    /**
     * Memperbarui foto profil pengguna.
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                \Illuminate\Support\Facades\Storage::delete($user->foto);
            }
            $path = $request->file('foto')->store('public/fotos');
            $user->foto = $path;
            $user->save();
        }

        return redirect()->route('dosen.pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Memperbarui kata sandi pengguna.
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
}
