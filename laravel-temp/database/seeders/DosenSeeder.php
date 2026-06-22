<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosenData = [
            'andreyan@ulm.ac.id'   => 'Andreyan Rizky Baskara, S.Kom., M.Kom',
            'nurul@ulm.ac.id'      => 'Nurul Fathanah Mustamin, S.Pd., M.T.',
            'yuslena@ulm.ac.id'    => 'Dr. Ir. Yuslena Sari, S.Kom., M.Kom',
            'mutia@ulm.ac.id'      => 'Muti\'a Maulida, S.Kom., M.T.I',
            'alkaff@ulm.ac.id'     => 'Ir. Muhammad Alkaff, S.Kom., M.Kom., Ph.D',
            'helda@ulm.ac.id'      => 'Helda Yunita, S.Kom., M.Kom.',
            'fadliyanur@ulm.ac.id' => 'FADLIYANUR, S.Pd.I., M.Pd',
            'fajrian@ulm.ac.id'    => 'Muhammad Fajrian Noor, S.Kom., M.Kom',
            'bahit@ulm.ac.id'      => 'Muhammad Bahit, S.Kom., M.Eng',
            'achmad@ulm.ac.id'     => 'Achmad Mujaddid Islami, S.Kom., M.Kom',
            'irham@ulm.ac.id'      => 'Irham Maulani Abdul Gani, S.Kom., M.Kom',
            'erika@ulm.ac.id'      => 'Erika Maulidiya, S.Kom., M.Kom',
            'eka@ulm.ac.id'        => 'Ir. Eka Setya Wijaya, S.T M.Kom'
        ];

        foreach ($dosenData as $email => $name) {
            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('password123'),
                    'role' => 'dosen'
                ]
            );
        }
    }
}
