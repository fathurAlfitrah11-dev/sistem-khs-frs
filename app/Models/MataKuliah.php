<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'kode_mk';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [

    'kode_mk',
    'nama_mk',
    'sks',
    'semester',
    'id_prodi',

    'persen_partisipatif',
    'persen_tugas',
    'persen_quiz',
    'persen_proyek',
    'persen_uts',
    'persen_uas',

    'dikunci'

    ];

   public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'kode_mk', 'kode_mk');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
