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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            abort(404, 'Data mahasiswa tidak ditemukan');
        }

        $tahun = TahunAjaran::latest()->first();

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

    $matakuliah = MataKuliah::where('id_prodi', $mahasiswa->id_prodi)
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
        $tahun = TahunAjaran::latest()->first();

        // 1. CARI DATA MATA KULIAH
        // Karena tombol kamu mengirimkan Kode MK atau ID, kita amankan pencariannya di sini
        if (is_numeric($id_mata_kuliah)) {
            $matkulDipilih = MataKuliah::find($id_mata_kuliah);
        } else {
            $matkulDipilih = MataKuliah::where('kode_mk', $id_mata_kuliah)->first();
        }

        if ($matkulDipilih->semester != $mahasiswa->kelas->semester) {
            return back()->with('error', 'Mata kuliah bukan untuk semester aktif.');
        }

        // 2. FIX: Cari pengajar berdasarkan 'kode_mk' sesuai isi database kamu!
        $pengajar = Pengajar::where('kode_mk', $matkulDipilih->kode_mk)->first();

        if (!$pengajar) {
            return back()->with('error', 'Dosen pengajar belum tersedia untuk mata kuliah: ' . $matkulDipilih->nama_mk);
        }

        // 3. BUAT ATAU AMBIL KRS INDUK MAHASISWA
        $krs = Krs::firstOrCreate(
            [
                'nim' => $mahasiswa->nim,
                'id_tahun_ajaran' => $tahun->id_tahun_ajaran
            ]
        );

        // 4. CEGAH MATA KULIAH DOBEL
        $cek = KrsDetail::where('id_krs', $krs->id_krs)
            ->where('pengajar_id', $pengajar->id_pengajar)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Mata kuliah sudah dipilih');
        }

        // 5. VALIDASI AKUMULASI SKS (MAKSIMAL 20)
        $totalSks = 0;
        $detailKrs = KrsDetail::with('pengajar.mataKuliah')
            ->where('id_krs', $krs->id_krs)
            ->get();

        foreach ($detailKrs as $detail) {
            $mk = MataKuliah::where('kode_mk', $detail->pengajar?->kode_mk)->first();
            if ($mk) {
                $totalSks += $mk->sks;
            }
        }

        if (($totalSks + $matkulDipilih->sks) > 20) {
            return back()->with('error', 'Gagal! Maksimal pengambilan SKS hanya 20 SKS.');
        }

    
       // 6. SIMPAN DATA 
        KrsDetail::create([
            'id_krs' => $krs->id_krs,
            'pengajar_id' => $pengajar->id_pengajar,
            'status' => 'diajukan',        
            'status_wali' => 'pending'    
        ]);

        return back()->with('success', 'Mata kuliah ' . $matkulDipilih->nama_mk . ' berhasil disimpan ke KRS!');
    }
}