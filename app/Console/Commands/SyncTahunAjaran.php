<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SyncTahunAjaranService;

class SyncTahunAjaran extends Command
{
    protected $signature = 'tahunajaran:sync';

    protected $description = 'Sinkronisasi status tahun ajaran dan semester kelas';

    public function handle()
    {
        SyncTahunAjaranService::sync();

        $this->info('Sinkronisasi berhasil.');

        return Command::SUCCESS;
    }
}