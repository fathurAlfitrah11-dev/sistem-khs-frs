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
        $mahasiswa = Mahasiswa::where(
            'user_id',
            Auth::id()
        )->first();

        $semesterDipilih = $request->semester ?? 1;

        $krs = Krs::with([
            'detail.pengajar.mataKuliah',
            'detail.pengajar.kelas'
        ])
        ->where('nim',$mahasiswa->nim)
        ->get();

        $semesterList = KrsDetail::with('pengajar.kelas')
            ->whereHas('krs', function($q) use ($mahasiswa){
                $q->where('nim', $mahasiswa->nim);
            })
            ->get()
            ->pluck('pengajar.kelas.semester')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        if($semesterDipilih){
            $krs->each(function($krs) use ($semesterDipilih){

                $krs->setRelation(
                    'detail',
                    $krs->detail->filter(function($detail) use ($semesterDipilih){

                        return $detail->pengajar
                            && $detail->pengajar->kelas
                            && $detail->pengajar->kelas->semester == $semesterDipilih;

                    })
                );

            });

        }

        return view(
            'mahasiswa.KrsMahasiswa',
            compact(
                'krs',
                'semesterList',
                'semesterDipilih'
            )
        );
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