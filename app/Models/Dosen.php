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

    protected $fillable = ['nuptk','nama_dosen','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'nuptk', 'nuptk');
    }

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'nuptk_wali', 'nuptk');
    }
}