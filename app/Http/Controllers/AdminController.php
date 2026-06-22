<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Khs;

class AdminController extends Controller
{
    public function index()
{
    $totalMahasiswa   = Mahasiswa::count();
    $totalDosen       = Dosen::count();
    $totalMataKuliah  = MataKuliah::count();

    // TOTAL Mata Kuliah YANG SUDAH DIAMBIL SEMUA MAHASISWA
    $totalEnrollment = KrsDetail::where('status_wali', '!=', 'ditolak')
        ->count();

    // AKTIVITAS MAHASISWA AMBIL Mata Kuliah
    $aktivitasKrs = KrsDetail::with([
        'krs.mahasiswa',
        'pengajar.mataKuliah'
    ])
    ->latest()
    ->take(10)
    ->get()
    ->map(function ($item) {
        return (object)[
            'timestamp' => $item->created_at,
            'tipe'       => 'Ambil Mata Kuliah',
            'user'       => $item->krs->mahasiswa->nama ?? '-',
            'deskripsi'  =>
                'Mengambil mata kuliah ' .
                ($item->pengajar->mataKuliah->nama_mk ?? '-'),
            'status'     => 'Success'
        ];
    });

    // DOSEN WALI ACC KRS
    $aktivitasPerwalian = Krs::with('mahasiswa')
    ->whereNotNull('nik_wali')
    ->latest('updated_at')
    ->take(10)
    ->get()
    ->map(function ($item) {

        $dosen = Dosen::where('nik', $item->nik_wali)->first();

        return (object)[
            'timestamp' => $item->updated_at,
            'tipe' => 'ACC KRS',
            'user' => $dosen->nama_dosen ?? $item->nik_wali,
            'deskripsi' =>
                'Menyetujui KRS mahasiswa ' .
                ($item->mahasiswa->nama ?? '-'),
            'status' => 'Success'
        ];
    });

    // DOSEN INPUT NILAI
    $aktivitasNilai = Khs::with([
        'krsDetail.krs.mahasiswa'
    ])
    ->latest()
    ->take(10)
    ->get()
    ->map(function ($item) {
        return (object)[
            'timestamp' => $item->updated_at,
            'tipe'       => 'Input Nilai',
            'user'       => $item->nik,
            'deskripsi'  =>
                'Menginput nilai mahasiswa ' .
                ($item->krsDetail->krs->mahasiswa->nama ?? '-'),
            'status'     => $item->status == 'Final'
                            ? 'Success'
                            : 'Pending'
        ];
    });

    // SEMUA AKTIVITAS
    $aktivitas = collect()
        ->merge($aktivitasKrs)
        ->merge($aktivitasPerwalian)
        ->merge($aktivitasNilai)
        ->sortByDesc('timestamp')
        ->take(10);

    return view('admin.dashboard', compact(
        'totalMahasiswa',
        'totalDosen',
        'totalMataKuliah',
        'totalEnrollment',
        'aktivitas'
    ));
}
}