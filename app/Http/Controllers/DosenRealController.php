<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenRealController extends Controller
{
   public function index()
{

    $dosen = auth()->user();

    $isWali = $dosen->is_wali; 

    $totalMahasiswa = \App\Models\Mahasiswa::count(); 
    $totalDosen = \App\Models\Dosen::count();         
    $totalMataKuliah = \App\Models\MataKuliah::count();
    $totalProdi = \App\Models\Prodi::count();

    return view('dosen.dashboard', compact(
        'isWali',
        'totalMahasiswa',
        'totalDosen',
        'totalMataKuliah',
        'totalProdi'
    ));
}
}