<?php

namespace App\Models;
use App\Models\User;
use App\Models\Pengajar;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $primaryKey = 'id_dosen';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nik','nama_dosen','kode_dosen','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'nik', 'nik');
    }

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'nik_wali', 'nik');
    }
}