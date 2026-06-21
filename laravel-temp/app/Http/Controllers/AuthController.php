<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Halaman Login
    public function login()
    {
        return view('auth.login');
    }

    // Proses Login dengan Validasi Email ULM
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'ends_with:ulm.ac.id,mhs.ulm.ac.id'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Format email tidak valid.',
            'email.ends_with' => 'Gunakan email resmi ULM (@mhs.ulm.ac.id atau @ulm.ac.id).',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Cek role user untuk diarahkan ke dashboard masing-masing
            if (Auth::user()->role == 'dosen') {
                return redirect()->intended('/dosen/dashboard');
            } elseif (Auth::user()->role == 'mahasiswa') {
                return redirect()->intended('/mahasiswa/dashboard');
            }
            // Default jika admin
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'loginError' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    // Tampilkan Halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // Proses Simpan Akun Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'ends_with:ulm.ac.id,mhs.ulm.ac.id'],
            'role' => ['required', 'in:dosen,mahasiswa'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar, silakan login.',
            'email.ends_with' => 'Akses ditolak! Wajib menggunakan email resmi ULM (@mhs.ulm.ac.id / @ulm.ac.id).',
            'role.required' => 'Pilih peran Anda (Dosen/Mahasiswa).',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password di atas.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan masuk dengan akun baru Anda.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}