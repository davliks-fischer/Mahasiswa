<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Bikin Akun Super Admin
        User::create([
            'username' => 'admin_super',
            'password' => Hash::make('password123'),
            'role' => 'super_admin'
        ]);

        // 2. Bikin Akun Dosen
        User::create([
            'username' => 'dosen_killer',
            'password' => Hash::make('password123'),
            'role' => 'dosen'
        ]);

        // 3. Bikin Akun Mahasiswa
        User::create([
            'username' => 'mahasiswa_rajin',
            'password' => Hash::make('password123'),
            'role' => 'mahasiswa'
        ]);
    }
}