<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KrsDetail;
use App\Models\Mahasiswa;

class Krs extends Model
{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs';

    protected $fillable = [
        'nim',
        'id_tahun_ajaran',
        'status',
        'status_wali',
        'nik_wali'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'nim','nim');
    }
    public function detail()
    {
        return $this->hasMany(KrsDetail::class,'id_krs','id_krs');
    }
    public function tahunAjaran()
{
    return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
}
}
