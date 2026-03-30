<?php

namespace App\Models;
use App\Models\User;
use App\Models\Pengajar;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nidn','nama_dosen','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'nidn', 'nidn');
    }

    public function kelasWali()
    {
        return $this->hasOne(Kelas::class, 'nidn_wali', 'nidn');
    }*/
}