<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrsDetail extends Model
{
    protected $table='krs_detail';
    protected $primaryKey = 'id_krs_detail';
    protected $fillable = [
        'id_krs',
        'pengajar_id',
        'status_wali'
    ];
    public function krs()
    {
        return $this->belongsTo(Krs::class,'id_krs');
    }
    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class,'pengajar_id');
    }
    public function khs()
{
    return $this->hasOne(Khs::class, 'krs_detail_id');
}
}