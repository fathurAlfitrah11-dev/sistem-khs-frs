<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPartTime extends Model
{
    protected $table = 'dosen_part_time';
    protected $primaryKey = 'id_dosen_part_time';
    protected $fillable = [
        'nuptk',
        'nama_dosen',
        'tempat_part_time',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
