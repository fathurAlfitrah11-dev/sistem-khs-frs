<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Prodi;
use App\Models\Khs; 
use App\Models\Dosen; 
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nim', 'user_id', 'nama', 'angkatan', 'id_prodi', 'id_kelas'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'nim', 'nim');
    }

    // Relasi KHS yang sudah dipisahkan secara mandiri
    public function khs()
    {
        // Karena primary key Anda adalah 'id_mahasiswa' (bukan 'id'), maka ganti parameter ketiganya menjadi 'id_mahasiswa'
        return $this->hasOne(Khs::class, 'krs_detail_id', 'id_mahasiswa');
    }

    // Relasi Wali yang sudah dirapikan penutup kurung kurawalnya
    public function wali()
    {
        return $this->hasOneThrough(
            Dosen::class,
            Kelas::class,
            'id_kelas',
            'nik',
            'id_kelas',
            'nik_wali'
        );
    }
}