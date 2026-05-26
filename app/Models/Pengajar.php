<?php

namespace App\Models;
use App\Models\Dosen;
use App\Models\Laboran;
use App\Models\DosenPartTime;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use App\Models\Krs;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'pengajar';
    protected $primaryKey = 'id_pengajar';
    protected $fillable = [
        'nik',
        'id_mata_kuliah',
        'id_tahun_ajaran',
        'semester',
        'kelas_id'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nik', 'nik');
    }

    public function mataKuliah()
    {
        {
        return $this->belongsTo(
            MataKuliah::class,
            'id_mata_kuliah',
            'id_mata_kuliah'
        );
        }
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran');
    }

    public function krs()
    {
        return $this->hasMany(Krs::class, 'pengajar_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}