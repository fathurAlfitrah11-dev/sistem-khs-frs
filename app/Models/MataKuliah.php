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
        'id_prodi'
    ];

   public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'mata_kuliah_id');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }
}
