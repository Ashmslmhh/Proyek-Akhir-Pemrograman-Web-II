<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class MahasiswaController extends Controller
{
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

        return redirect()->route('mahasiswa.pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman pengaturan (profil dan ubah password).
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
