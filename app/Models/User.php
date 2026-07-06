<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory; 

    protected $fillable = ['username','name','password','role'];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'nim', 'username');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'nik', 'username');
    }
    public function dosenPartTime()
    {
        return $this->hasOne(DosenPartTime::class, 'nik', 'username');
    }
    public function laboran()
    {
        return $this->hasOne(Laboran::class, 'nik', 'username');
    }
}