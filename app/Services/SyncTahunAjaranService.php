<?php

namespace App\Services;

use App\Models\TahunAjaran;
use App\Models\Kelas;
class SyncTahunAjaranService
{
   public static function sync()
{
    $aktif = TahunAjaran::whereDate('tanggal_mulai', '<=', now())
        ->whereDate('tanggal_selesai', '>=', now())
        ->first();

    if (!$aktif) {
        TahunAjaran::where('status', 'aktif')->update([
            'status' => 'non-aktif'
        ]);

        return;
    }

    // Nonaktifkan tahun ajaran lain yang masih aktif
    TahunAjaran::where('id_tahun_ajaran', '!=', $aktif->id_tahun_ajaran)
        ->where('status', 'aktif')
        ->update([
            'status' => 'non-aktif'
        ]);

    // Aktifkan tahun ajaran jika belum aktif
    if ($aktif->status !== 'aktif') {
        $aktif->update([
            'status' => 'aktif'
        ]);
    }

    $tahunAktif = $aktif->tahun_awal;
    $offset = $aktif->semester == 'ganjil' ? 1 : 2;

    foreach (Kelas::all() as $kelas) {

        $selisih = max(0, $tahunAktif - $kelas->angkatan);

        $semester = ($selisih * 2) + $offset;

        if ($kelas->semester != $semester) {
            $kelas->update([
                'semester' => $semester
            ]);
        }
    }
}
}