<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mata_kuliah')->insertOrIgnore([
            [
                'kode_mk' => 'IF201',
                'nama_mk' => 'Pemrogram Web',
                'sks' => 4,
                'id_prodi' => 1,
                'semester' => 2,
                'persen_partisipatif' => 0,
                'persen_tugas' => 0,
                'persen_quiz' => 0,
                'persen_proyek' => 0,
                'persen_uts' => 0,
                'persen_uas' => 0,
                'dikunci' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_mk' => 'IF202',
                'nama_mk' => 'Basis Data',
                'sks' => 4,
                'id_prodi' => 1,
                'semester' => 2,
                'persen_partisipatif' => 0,
                'persen_tugas' => 0,
                'persen_quiz' => 0,
                'persen_proyek' => 0,
                'persen_uts' => 0,
                'persen_uas' => 0,
                'dikunci' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}