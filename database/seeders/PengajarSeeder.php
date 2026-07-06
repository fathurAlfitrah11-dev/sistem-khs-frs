<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengajar')->insertOrIgnore([
            [
                'id_pengajar' => 1,
                'nik' => '19900101', // Terhubung ke Dosen Fulan
                'kode_mk' => 'IF201', // Pemrogram Web
                'kelas_id' => 1,      // Pastikan id_kelas 1 sudah ada di seeder kelasmu
                'id_tahun_ajaran' => 1, // Pastikan id_tahun_ajaran 1 sudah ada
                'semester' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengajar' => 2,
                'nik' => '19900102', // Terhubung ke Pak Zaid
                'kode_mk' => 'IF202', // Basis Data
                'kelas_id' => 1,
                'id_tahun_ajaran' => 1,
                'semester' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}