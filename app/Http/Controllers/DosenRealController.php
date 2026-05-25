<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenRealController extends Controller
{
     public function index()
    {
        $isWali = Kelas::where('nik_wali', Auth::user()->username)->exists();
        return view('dosen.dashboard', compact('isWali'));
    }
}
