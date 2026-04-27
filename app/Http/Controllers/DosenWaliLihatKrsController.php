<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenWaliLihatKrsController extends Controller
{
    public function index()
    {
        return view('dosen.lihatkrs');
    }
}
