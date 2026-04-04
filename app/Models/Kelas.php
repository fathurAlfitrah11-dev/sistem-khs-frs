<?php

namespace App\Models;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $primaryKey = 'id_kelas';

    protected $fillable = ['nama_kelas','kategori','nidn_wali'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_kelas', 'id_kelas');
    }

    public function wali()
    {
        return $this->belongsTo(Dosen::class, 'nidn_wali', 'nidn');
    }
}