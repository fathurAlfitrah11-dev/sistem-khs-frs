<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\KrsDetail;
use App\Models\Pengajar;    
use App\Models\TahunAjaran; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenRealController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dosen = \App\Models\Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            abort(404, 'Data profil dosen Anda tidak ditemukan.');
        }

        $isWali = Kelas::where('nik_wali', $dosen->nik)->exists();
        $isKps = Prodi::where('nik_kps', $dosen->nik)->exists();

        $kelasAmpu = Pengajar::with(['mataKuliah', 'kelas.prodi'])
            ->where('nik', $dosen->nik) 
            ->get();

        $totalMahasiswa = \App\Models\Mahasiswa::count();
        $totalDosen = \App\Models\Dosen::count();
        $totalMataKuliah = \App\Models\MataKuliah::count();
        $totalProdi = \App\Models\Prodi::count();
        $totalEnrollment = KrsDetail::where('status_wali', '!=', 'ditolak')->count();

        return view('dosen.dashboard', compact(
            'isWali',
            'isKps',
            'totalMahasiswa',
            'totalDosen',
            'totalMataKuliah',
            'totalProdi',
            'totalEnrollment',
            'kelasAmpu' 
        ));
    }
}