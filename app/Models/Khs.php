<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
   protected $fillable = [
    'krs_detail_id', 'dosen_id', 'partisipatif', 'tugas', 
    'quiz', 'proyek', 'uts', 'uas', 'na', 'nh', 'status'
];

    public function krsDetail()
    {
        return $this->belongsTo(KrsDetail::class, 'krs_detail_id');
    }
}