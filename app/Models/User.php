<?php

namespace App\Models;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username','name','password','role'];

    /**public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'nim', 'username');
    }
*/
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'nidn', 'username');
    }
}