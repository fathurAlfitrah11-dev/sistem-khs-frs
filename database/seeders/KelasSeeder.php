<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kelas')->insertOrIgnore([
            [
                'id_kelas' => 1,
                'semester' => 2,
                'id_prodi' => 1,
                'nama_kelas' => 'A',          // 💡 Diubah jadi 'A' (sesuai tipe enum/char pendek)
                'kategori' => 'Pagi',     // 💡 Kolom kategori di phpMyAdmin wajib diisi enum
                'angkatan' => '2025',
                'nik_wali' => '19900101',     // Wali dosen (merujuk ke NIK dosen Fulan)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}