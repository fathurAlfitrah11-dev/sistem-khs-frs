<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prodi')->insertOrIgnore([
            [
                'id_prodi' => 1,
                'jenjang' => 'D3',
                'nama_prodi' => 'IF',
                'nik_kps' => '19900101', // NIK Dosen KPS
                'nilai_dikunci' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_prodi' => 2,
                'jenjang' => 'D4',
                'nama_prodi' => 'TRPL',
                'nik_kps' => '19900102',
                'nilai_dikunci' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}