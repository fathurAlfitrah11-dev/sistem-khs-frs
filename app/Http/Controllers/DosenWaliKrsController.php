<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenWaliKrsController extends Controller
{
    public function index()
    {
        return view('dosen.wali/krs.index');
    }
}
