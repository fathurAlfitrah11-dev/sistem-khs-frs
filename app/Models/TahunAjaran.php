<?php

namespace App\Models;
use App\Models\Pengajar;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id_tahun_ajaran';
    public $incrementing = true;
    protected $cast = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
    protected $fillable = ['tahun_awal','tahun_akhir','semester','status', 'tanggal_mulai', 'tanggal_selesai', 'nilai_dikunci'];

    public function pengajar()
    {
        return $this->hasMany(Pengajar::class, 'id_tahun_ajaran', 'id_tahun_ajaran');
    }
    public function getDeadlineNilaiAttribute()
{
    return $this->tanggal_selesai->copy()->subDays(14);
}

}