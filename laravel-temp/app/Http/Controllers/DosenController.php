<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

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
        
        // Pastikan dosen hanya bisa update booking miliknya
        if ($booking->dosen_id == Auth::id()) {
            $booking->update([
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'Status bimbingan berhasil diperbarui!');
    }
}