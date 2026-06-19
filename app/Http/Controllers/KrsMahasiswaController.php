<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\KrsDetail;

class KrsMahasiswaController extends Controller
{
    public function index(Request $request)
{
    $mahasiswa = Mahasiswa::with('kelas')->where('user_id', Auth::id())->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data Mahasiswa tidak ditemukan.');
    }

    $semesterDipilih = $request->semester ?? 1;

    $krs = Krs::with([
        'detail.pengajar.mataKuliah',
        'detail.pengajar.kelas'
    ])
    ->where('nim', $mahasiswa->nim)
    ->get();

    $semesterAktif = $mahasiswa->kelas->semester ?? 1;
    $semesterList = range(1, $semesterAktif);

   $semesterDipilih = $request->semester ?? $semesterAktif;

$krs = Krs::with([
    'detail.pengajar.mataKuliah',
    'detail.pengajar.kelas'
])
->where('nim', $mahasiswa->nim)
->get();

return view('mahasiswa.KrsMahasiswa', compact(
    'krs',
    'semesterList',
    'semesterDipilih'
));
}

    public function hapusMatkul($id)
    {
        $detail = KrsDetail::findOrFail($id);

        // cuma boleh hapus kalau pending
        if($detail->status_wali != 'pending'){
            return back()->with(
                'error',
                'Mata kuliah yang sudah disetujui tidak dapat dihapus'
            );
        }

        $detail->delete();

        return back()->with(
            'success',
            'Mata kuliah berhasil dihapus'
        );
    }
}