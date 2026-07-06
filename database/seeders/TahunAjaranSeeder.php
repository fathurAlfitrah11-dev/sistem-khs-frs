<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tahun_ajaran')->insertOrIgnore([
            [
                'id_tahun_ajaran' => 1,
                'tahun_awal' => '2025',
                'tahun_akhir' => '2026',
                'semester' => 'genap',
                'status' => 'non-aktif',
                'tanggal_mulai' => '2025-08-01',
                'tanggal_selesai' => '2026-07-31',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}