<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanAkunMahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.PengaturanAkun');
    }
}
