<?php

namespace App\Models;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Krs;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'id_mahasiswa';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nim','user_id','nama','semester','id_prodi','id_kelas'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id', 'id');
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
    public function wali()
{
    return $this->hasOneThrough(
        Dosen::class,
        Kelas::class,
        'id_kelas',
        'nidn',
        'id_kelas',
        'nidn_wali'
    );
}
}