<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Pengajar;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class MatakuliahMahasiswaController extends Controller
{

public function index()
    {
        $mahasiswa = Mahasiswa::where(
            'user_id',
            Auth::id()
        )->first();

        if(!$mahasiswa){
            abort(404,'Data mahasiswa tidak ditemukan');
        }

        $matakuliah = MataKuliah::where(
            'id_prodi',
            $mahasiswa->id_prodi
        )->paginate(5);

        return view(
            'mahasiswa.MatakuliahMahasiswa',
            compact('matakuliah')
        );
    }

    public function tambahKrs($id_mata_kuliah)
{
    $mahasiswa = Mahasiswa::where(
        'user_id',
        Auth::id()
    )->first();

    // tahun ajaran aktif
    $tahun = TahunAjaran::latest()->first();

    // ambil pengajar berdasarkan matkul
    $pengajar = Pengajar::where(
        'id_mata_kuliah',
        $id_mata_kuliah
    )->first();

    if(!$pengajar){
        return back()
        ->with('error','Pengajar belum tersedia');
    }

    // buat KRS jika belum ada
    $krs = Krs::firstOrCreate(

        [
            'nim'=>$mahasiswa->nim,
            'id_tahun_ajaran'=>$tahun->id_tahun_ajaran
        ],

        [
            'status'=>'diajukan',
            'status_wali'=>'pending',
            'nik_wali'=>$mahasiswa->wali?->nik
        ]
    );

    // cegah matkul dobel
    $cek = KrsDetail::where(
        'id_krs',
        $krs->id_krs
    )
    ->where(
        'pengajar_id',
        $pengajar->id_pengajar
    )
    ->exists();

    if($cek){
        return back()
        ->with(
            'error',
            'Mata kuliah sudah dipilih'
        );
    }


    // ==========================
    // VALIDASI TOTAL SKS MAX 20
    // ==========================

    $totalSks = 0;

    $detailKrs = KrsDetail::with(
        'pengajar.mataKuliah'
    )
    ->where(
        'id_krs',
        $krs->id_krs
    )
    ->get();

    foreach($detailKrs as $detail){

        $mk = $detail->pengajar?->mataKuliah;

        if($mk){
            $totalSks += $mk->sks;
        }
    }

    // SKS matkul yg mau ditambah
    $matkulDipilih = MataKuliah::findOrFail(
        $id_mata_kuliah
    );

    $totalBaru = $totalSks + $matkulDipilih->sks;

    if($totalBaru > 20){

        return back()
        ->with(
            'error',
            'Gagal! Maksimal pengambilan SKS hanya 20'
        );
    }


    // ==========================
    // SIMPAN KRS
    // ==========================

    KrsDetail::create([

        'id_krs'=>$krs->id_krs,
        'pengajar_id'=>$pengajar->id_pengajar,
        'status_wali'=>'pending'

    ]);

    return back()
    ->with(
        'success',
        'Mata kuliah berhasil ditambahkan'
    );
}
}