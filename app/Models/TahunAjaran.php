<?php

namespace App\Models;
use App\Models\Pengajar;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';
    public $incrementing = true;
    protected $fillable = ['tahun_awal','tahun_akhir','semester','status'];

    public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
}