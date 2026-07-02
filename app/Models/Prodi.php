<?php

namespace App\Models;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $primaryKey = 'id_prodi';

    protected $fillable = ['jenjang','nama_prodi','nik_kps'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi', 'id_prodi');
    }
    public function kps()
{
    return $this->belongsTo(Dosen::class, 'nik_kps', 'nik');
}
public function matkul()
{
    return $this->hasMany(MataKuliah::class, 'id_prodi');
}

}
