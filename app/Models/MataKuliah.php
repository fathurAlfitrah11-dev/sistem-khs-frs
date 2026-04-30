<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id_mata_kuliah';
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
        'id_prodi'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
