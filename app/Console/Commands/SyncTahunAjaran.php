<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TahunAjaran;
use App\Models\Kelas;

class SyncTahunAjaran extends Command
{
    protected $signature = 'tahunajaran:sync';

    protected $description = 'Sinkronisasi status tahun ajaran dan semester kelas';

    public function handle()
    {
        // Nonaktifkan semua
        TahunAjaran::query()->update([
            'status' => 'non-aktif'
        ]);

        // Cari tahun ajaran sesuai tanggal hari ini
        $aktif = TahunAjaran::whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();

        if (!$aktif) {
            $this->info('Tidak ada tahun ajaran aktif.');
            return Command::SUCCESS;
        }

        // Aktifkan
        $aktif->update([
            'status' => 'aktif'
        ]);

        $tahunAktif = $aktif->tahun_awal;
        $offset = $aktif->semester == 'ganjil' ? 1 : 2;

        foreach (Kelas::all() as $kelas) {

            $selisih = $tahunAktif - $kelas->angkatan;

            if ($selisih < 0) {
                $selisih = 0;
            }

            $semester = ($selisih * 2) + $offset;

            $kelas->update([
                'semester' => $semester
            ]);
        }

        $this->info('Sinkronisasi berhasil.');
        return Command::SUCCESS;
    }
}