<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenguncianNilai extends Model
{
    protected $table = 'penguncian_nilai';

    protected $fillable = [
        'id_prodi',
        'id_tahun_ajaran',
        'status'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
}