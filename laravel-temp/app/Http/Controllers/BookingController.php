<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan Form Booking & Kirim Daftar Dosen
    public function create()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('mahasiswa.booking', compact('dosen'));
    }

    // Simpan Data Booking ke Database & Kirim Notifikasi
    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required',
            'tanggal' => 'required|date',
            'sesi_waktu' => 'required',
            'topik' => 'required|string|max:255',
            'catatan' => 'required|string',
        ]);

        $booking = Booking::create([
            'mahasiswa_id' => Auth::id(),
            'dosen_id' => $request->dosen_id,
            'tanggal' => $request->tanggal,
            'sesi_waktu' => $request->sesi_waktu,
            'topik' => $request->topik,
            'catatan' => $request->catatan,
            'status' => 'Menunggu'
        ]);

        // MENGIRIM NOTIFIKASI KE DOSEN TERKAIT
        $dosen = User::find($request->dosen_id);
        if ($dosen) {
            $dosen->notify(new \App\Notifications\BookingMasuk($booking));
        }

        return redirect('/mahasiswa/riwayat')->with('success', 'Pengajuan jadwal bimbingan berhasil dikirim!');
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $bookings = Booking::with('dosen')
            ->where('mahasiswa_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('topik', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('dosen', function ($dosen) use ($search) {
                        $dosen->where('name', 'like', "%{$search}%");
                    });
                });
            })
            ->latest()
            ->paginate(5);

        return view('mahasiswa.riwayat', compact('bookings'));
    }

    // Tampilkan Form Edit Booking
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);

        // Keamanan: hanya milik mahasiswa yg login & statusnya masih Menunggu
        if ($booking->mahasiswa_id != Auth::id() || $booking->status != 'Menunggu') {
            return redirect('/mahasiswa/riwayat')->with('error', 'Pengajuan tidak dapat diedit.');
        }

        $dosen = User::where('role', 'dosen')->get();
        return view('mahasiswa.edit-booking', compact('booking', 'dosen'));
    }

// Simpan Perubahan Booking
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Keamanan: hanya milik mahasiswa yg login & statusnya masih Menunggu
        if ($booking->mahasiswa_id != Auth::id() || $booking->status != 'Menunggu') {
            return redirect('/mahasiswa/riwayat')->with('error', 'Pengajuan tidak dapat diedit.');
        }

        $request->validate([
            'dosen_id' => 'required',
            'tanggal'  => 'required|date',
            'sesi_waktu' => 'required',
            'topik'    => 'required|string|max:255',
            'catatan'  => 'required|string',
        ]);

        $booking->update([
            'dosen_id'   => $request->dosen_id,
            'tanggal'    => $request->tanggal,
            'sesi_waktu' => $request->sesi_waktu,
            'topik'      => $request->topik,
            'catatan'    => $request->catatan,
        ]);

        return redirect('/mahasiswa/riwayat')->with('success', 'Pengajuan bimbingan berhasil diperbarui!');
    }

    // Fungsi Baru: Batalkan/Hapus Pengajuan
    public function destroy($id)
    {
        // Cari data booking berdasarkan ID
        $booking = Booking::findOrFail($id);
        
        // Cek keamanan: Pastikan booking milik mahasiswa yang sedang login 
        // DAN statusnya masih 'Menunggu' (agar yang sudah disetujui tidak bisa dihapus)
        if ($booking->mahasiswa_id == Auth::id() && $booking->status == 'Menunggu') {
            $booking->delete();
            return redirect('/mahasiswa/riwayat')->with('success', 'Pengajuan bimbingan berhasil dibatalkan.');
        }

        // Kalau bukan miliknya atau sudah diproses, tolak pembatalan
        return redirect('/mahasiswa/riwayat')->with('error', 'Gagal membatalkan. Pengajuan sudah diproses atau tidak ditemukan.');
    }
}