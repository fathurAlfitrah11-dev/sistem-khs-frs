<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;


class AdminController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMataKuliah = MataKuliah::count();


        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalMataKuliah'
        ));
    }
}