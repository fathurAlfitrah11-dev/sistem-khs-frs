<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Prodi;

class MahasiswaRealController extends Controller
{
    
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMataKuliah = MataKuliah::count();
        $totalProdi = Prodi::count();


        return view('mahasiswa.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMataKuliah',
            'totalProdi'
        ));

}}
