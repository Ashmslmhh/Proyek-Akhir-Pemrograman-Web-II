<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosenList = [
            'Andreyan Rizky Baskara, S.Kom., M.Kom',
            'Nurul Fathanah Mustamin, S.Pd., M.T.',
            'Dr. Ir. Yuslena Sari, S.Kom., M.Kom',
            'Muti\'a Maulida, S.Kom., M.T.I',
            'Ir. Muhammad Alkaff, S.Kom., M.Kom., Ph.D',
            'Helda Yunita, S.Kom., M.Kom.',
            'FADLIYANUR, S.Pd.I., M.Pd',
            'Muhammad Fajrian Noor, S.Kom., M.Kom',
            'Muhammad Bahit, S.Kom., M.Eng',
            'Achmad Mujaddid Islami, S.Kom., M.Kom',
            'Irham Maulani Abdul Gani, S.Kom., M.Kom',
            'Erika Maulidiya, S.Kom., M.Kom',
            'Ir. Eka Setya Wijaya, S.T M.Kom'
        ];

        foreach ($dosenList as $dosen) {
            // Bikin email otomatis dari nama depan (misal: andreyan@ulm.ac.id)
            $email = strtolower(strtok($dosen, ' ')) . '@ulm.ac.id';

            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $dosen,
                    'password' => Hash::make('password123'), // Default password semua dosen
                    'role' => 'dosen'
                ]
            );
        }
    }
}
