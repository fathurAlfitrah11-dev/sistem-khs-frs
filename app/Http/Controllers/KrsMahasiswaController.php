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
    $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

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

    $semesterList = [1, 2, 3, 4, 5, 6, 7, 8];

    if ($semesterDipilih) {
        $krs->each(function($item) use ($semesterDipilih) {
            $item->setRelation(
                'detail',
                $item->detail->filter(function($detail) use ($semesterDipilih) {
                    return $detail->pengajar
                        && $detail->pengajar->kelas
                        && $detail->pengajar->kelas->semester == $semesterDipilih;
                })
            );
        });
    }

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