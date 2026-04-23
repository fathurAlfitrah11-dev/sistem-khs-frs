<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaRealController extends Controller
{
    
    public function index()
    {
        return view('mahasiswa.dashboard');
}}
