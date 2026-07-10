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
    $totalSks = 0;

    if ($krs) {
        $kodeMatkulDipilih = KrsDetail::with('pengajar')
            ->where('id_krs', $krs->id_krs)
            ->where('status_wali', '!=', 'ditolak')
            ->get()
            ->pluck('pengajar.kode_mk')
            ->filter()
            ->toArray();

        $totalSks = KrsDetail::with('pengajar.mataKuliah')
            ->where('id_krs', $krs->id_krs)
            ->where('status_wali', '!=', 'ditolak')
            ->get()
            ->sum(function ($detail) {
                return $detail->pengajar->mataKuliah->sks ?? 0;
            });
    }

    $semesterAktif = strtolower($tahun->semester);

if ($semesterAktif == 'genap') {
    $semesterTarget = [2, 4, 6, 8];
} else {
    $semesterTarget = [1, 3, 5, 7, 9];
}

    //  1. HITUNG SEMESTER MAKSIMAL YANG REAL DIBUAT OLEH ADMIN DI PRODI INI
    $maxSemesterAdmin = MataKuliah::where('id_prodi', $idProdi)
        ->whereIn('semester', $semesterTarget)
        ->max('semester') ?? 0;

    //  2. FILTER OPTION UNTUK DROPDOWN AGAR TIDAK MELEBIHI BUATAN ADMIN
    $dropdownSemesters = array_filter($semesterTarget, function($sem) use ($maxSemesterAdmin) {
        return $sem <= $maxSemesterAdmin;
    });

    $search = $request->search;
    $selectedSemester = $request->semester;

    // 3. QUERY UTAMA DENGAN FILTER DROPDOWN SEMESTER
    $matakuliah = MataKuliah::where('id_prodi', $idProdi)
        ->whereNotIn('kode_mk', $kodeMatkulDipilih)
        ->when($selectedSemester, function ($query) use ($selectedSemester) {
            // Jika dropdown dipilih, kunci ke semester tersebut
            $query->where('semester', $selectedSemester);
        })
        ->when(!$selectedSemester, function ($query) use ($semesterTarget) {
            // Jika default (semua), tampilkan range ganjil/genap
            $query->whereIn('semester', $semesterTarget);
        })
        ->orderBy('semester', 'asc')                  
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
        'search',
        'totalSks',
        'dropdownSemesters', 
        'selectedSemester'   
    ));
}

   public function tambahKrs($id_mata_kuliah)
{
    $mahasiswa = Mahasiswa::with('kelas')
        ->where('user_id', Auth::id())->first();

    if (!$mahasiswa) {
        abort(404, 'Data mahasiswa tidak ditemukan');
    }

    // Ambil tahun ajaran AKTIF
    $tahun = TahunAjaran::where('status', 'aktif')->first();

    if (!$tahun) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif');
    }

    // Cari matkul berdasarkan kode_mk
    $matkulDipilih = MataKuliah::where('kode_mk', $id_mata_kuliah)->first();

    if (!$matkulDipilih) {
        return back()->with('error', 'Mata kuliah tidak ditemukan');
    }

    //  PERBAIKAN UTAMA: Validasi Semester Mahasiswa vs Semester Mata Kuliah
    $semesterMahasiswa = $mahasiswa->kelas->semester ?? null;
    if ($semesterMahasiswa && $matkulDipilih->semester != $semesterMahasiswa) {
        return back()->with('error', 'Mata kuliah ini ditujukan untuk Semester ' . $matkulDipilih->semester . ', bukan untuk semester aktif Anda yakni Semester ' . $semesterMahasiswa . '.');
    }

    // Cari pengajar yang spesifik untuk kelas mahasiswa
    $pengajar = Pengajar::where('kode_mk', $matkulDipilih->kode_mk)
        ->where('kelas_id', $mahasiswa->id_kelas ?? $mahasiswa->kelas_id) 
        ->first();

    if (!$pengajar) {
        return back()->with('error', 'Mata kuliah ini belum dijadwalkan atau pengajar belum tersedia untuk kelas Anda.');
    }

    // Ambil atau buat data KRS semester aktif
    $krs = Krs::firstOrCreate([
        'nim' => $mahasiswa->nim,
        'id_tahun_ajaran' => $tahun->id_tahun_ajaran
    ]);

    // Cek duplikat matkul di KRS Detail
    $cek = KrsDetail::where('id_krs', $krs->id_krs)
        ->where('pengajar_id', $pengajar->id_pengajar)
        ->exists();

    if ($cek) {
        return back()->with('error', 'Mata kuliah sudah dipilih');
    }

    // Hitung akumulasi SKS saat ini
    $totalSks = KrsDetail::with('pengajar.mataKuliah')
        ->where('id_krs', $krs->id_krs)
        ->get()
        ->sum(function ($detail) {
            return $detail->pengajar->mataKuliah->sks ?? 0;
        });

    if (($totalSks + $matkulDipilih->sks) > 20) {
        return back()->with('error', 'Maksimal kuota pengambilan adalah 20 SKS');
    }

    // Simpan ke KRS Detail
    KrsDetail::create([
        'id_krs' => $krs->id_krs,
        'pengajar_id' => $pengajar->id_pengajar,
        'status' => 'diajukan',
        'status_wali' => 'pending'
    ]);

    return back()->with('success', 'Mata kuliah berhasil ditambahkan ke KRS');
}
}