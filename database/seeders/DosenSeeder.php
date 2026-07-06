<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insertOrIgnore([
            [
                'nik' => '19900101',
                'nama_dosen' => 'Fulan, S.T., M.T.',
                'kode_dosen' => 'FLN',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '19900102',
                'nama_dosen' => 'Pak Zaid, M.Cs',
                'kode_dosen' => 'ZID',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}