<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPartTime extends Model
{
    protected $table = 'dosen_part_time';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nidk',
        'nama_dosen',
        'password',
        'tempat_part_time',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
