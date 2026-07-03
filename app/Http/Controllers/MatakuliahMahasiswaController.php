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
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::with('kelas')
        ->where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan');
        }

        $tahun = TahunAjaran::where('status', 'aktif')->first();

if (!$tahun) {
    return back()->with('error', 'Tidak ada tahun ajaran aktif');
}
        $idProdi = $mahasiswa->kelas->id_prodi;
        $krs = Krs::where('nim', $mahasiswa->nim)
            ->where('id_tahun_ajaran', $tahun->id_tahun_ajaran)
            ->first();

        $kodeMatkulDipilih = [];

        if ($krs) {
            $kodeMatkulDipilih = KrsDetail::with('pengajar')
                ->where('id_krs', $krs->id_krs)
                ->where('status_wali','!=','ditolak')
                ->get()
                ->pluck('pengajar.kode_mk')
                ->filter()
                ->toArray();
                
        }

        // Tampilkan mata kuliah berdasarkan prodi mahasiswa yang BELUM dipilih
         $search = $request->search;

    $matakuliah = MataKuliah::where('id_prodi', $idProdi)
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_mk', 'like', '%' . $search . '%')
                  ->orWhere('nama_mk', 'like', '%' . $search . '%');
            });
        })
        ->paginate(5)
        ->withQueryString();

    return view('mahasiswa.MatakuliahMahasiswa', compact(
        'matakuliah',
        'search'
    ));
    }

    public function tambahKrs($id_mata_kuliah)
{
    $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

    if (!$mahasiswa) {
        abort(404, 'Data mahasiswa tidak ditemukan');
    }

    // WAJIB: ambil tahun ajaran AKTIF
    $tahun = TahunAjaran::where('status', 'aktif')->first();

    if (!$tahun) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif');
    }

    // ambil matkul
    if (is_numeric($id_mata_kuliah)) {
        $matkulDipilih = MataKuliah::find($id_mata_kuliah);
    } else {
        $matkulDipilih = MataKuliah::where('kode_mk', $id_mata_kuliah)->first();
    }

    if (!$matkulDipilih) {
        return back()->with('error', 'Mata kuliah tidak ditemukan');
    }

    if ($matkulDipilih->semester != $mahasiswa->kelas->semester) {
        return back()->with('error', 'Mata kuliah bukan untuk semester aktif.');
    }

    // pengajar
    $pengajar = Pengajar::where('kode_mk', $matkulDipilih->kode_mk)->first();

    if (!$pengajar) {
        return back()->with('error', 'Dosen pengajar belum tersedia');
    }

    // FIX KRS: selalu pakai tahun ajaran AKTIF
    $krs = Krs::firstOrCreate([
        'nim' => $mahasiswa->nim,
        'id_tahun_ajaran' => $tahun->id_tahun_ajaran
    ]);

    // cek duplikat
    $cek = KrsDetail::where('id_krs', $krs->id_krs)
        ->where('pengajar_id', $pengajar->id_pengajar)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Mata kuliah sudah dipilih');
    }

    // hitung SKS
    $totalSks = KrsDetail::with('pengajar.mataKuliah')
        ->where('id_krs', $krs->id_krs)
        ->get()
        ->sum(function ($detail) {
            return $detail->pengajar->mataKuliah->sks ?? 0;
        });

    if (($totalSks + $matkulDipilih->sks) > 20) {
        return back()->with('error', 'Maksimal SKS 20');
    }

    // simpan
    KrsDetail::create([
        'id_krs' => $krs->id_krs,
        'pengajar_id' => $pengajar->id_pengajar,
        'status' => 'diajukan',
        'status_wali' => 'pending'
    ]);

    return back()->with('success', 'Mata kuliah berhasil ditambahkan');
}
}