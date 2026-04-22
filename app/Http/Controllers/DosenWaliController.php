<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenWaliController extends Controller
{
    public function index()
    {
        return view('admin.dosen-wali.index');
    }
}
