<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            // Akun Admin
            [
                'id' => 1,
                'name' => 'Admin Utama',
                'username' => 'admin01',
                'role' => 'admin',
                'password' => Hash::make('admin01'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Akun Dosen 1 (KPS)
            [
                'id' => 2,
                'name' => 'Fulan, S.T., M.T.',
                'username' => '19900101',
                'role' => 'dosen',
                'password' => Hash::make('19900101'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Akun Dosen 2
            [
                'id' => 3,
                'name' => 'Pak Zaid, M.Cs',
                'username' => '19900102',
                'role' => 'dosen',
                'password' => Hash::make('19900102'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Akun Mahasiswa
            [
                'id' => 4,
                'name' => 'Reifandra Kinadi',
                'username' => '3312401001',
                'role' => 'mahasiswa',
                'password' => Hash::make('3312401001'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}