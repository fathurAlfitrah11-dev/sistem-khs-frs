<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboran extends Model
{
    protected $table = 'laboran';
    protected $primaryKey = 'id_laboran';
    protected $fillable = [
        'nik',
        'nama_laboran',
        'kode_laboran',
        'user_id'
    ];

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
    public function prodiKps()
{
    return $this->hasOne(Prodi::class, 'nik_kps', 'nik');
}
}
