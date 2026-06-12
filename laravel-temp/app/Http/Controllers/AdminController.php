<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDosen = User::where('role', 'dosen')->count();

        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        $totalJadwal = Schedule::count();

        $totalBooking = Booking::count();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalJadwal',
            'totalBooking'
        ));
    }
}