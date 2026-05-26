<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\KrsDetail;

class KrsMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where(
            'user_id',
            Auth::id()
        )->first();

        $krs = Krs::with('detail.pengajar.mataKuliah')
                ->where('nim', $mahasiswa->nim)
                ->get();

        return view(
            'mahasiswa.KrsMahasiswa',
            compact('krs')
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