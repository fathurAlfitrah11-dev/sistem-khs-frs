<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        return view('admin.tahun-ajaran.index');
    }
}
