<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenilaianDosenController extends Controller
{
    public function index()
    {
        return view('dosen.penilaian');
    }
}