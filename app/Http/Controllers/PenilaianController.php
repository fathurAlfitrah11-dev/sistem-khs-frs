<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Khs;
use App\Models\KrsDetail;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $prodi = Prodi::all();
        $kelas = Kelas::all();

        // 1. AMBIL USER ID DARI AKUN YANG LOGIN
        $userId = Auth::id();

        // 2. CARI DATA DOSEN BERDASARKAN user_id UNTUK MENDAPATKAN NIK
        $dosen = \App\Models\Dosen::where('user_id', $userId)->first();

        $nikDosen = $dosen ? $dosen->nik : null;

     $matkulQuery = Pengajar::where('nik', $nikDosen)
    ->when($request->semester, function ($q) use ($request) {
        $q->whereHas('mataKuliah', function ($m) use ($request) {
            $m->where('semester', $request->semester);
        });
    });
        $matkulDiampu = $request->filled('semester')
         ? $matkulQuery->get()
        : collect();
        $pengajarIds = $matkulDiampu->pluck('id_pengajar')->toArray();


       if (empty($pengajarIds)) {

    $mahasiswa = collect();

    return view('dosen.penilaian', compact(
        'mahasiswa',
        'prodi',
        'kelas',
        'matkulDiampu'
    ));
}
$mahasiswa = collect();

if (
    !$request->filled('id_pengajar') &&
    !$request->filled('id_prodi') &&
    !$request->filled('semester') &&
    !$request->filled('sesi') &&
    !$request->filled('id_kelas')
) {
    return view('dosen.penilaian', compact(
        'mahasiswa',
        'prodi',
        'kelas',
        'matkulDiampu'
    ));
}
        // 4. AMBIL DATA MAHASISWA DARI KrsDetail
        $query = KrsDetail::with(['krs.mahasiswa.prodi', 'krs.mahasiswa.kelas', 'khs', 'pengajar.mataKuliah'])
            ->whereIn('pengajar_id', $pengajarIds) // Hanya matkul yang diajar dosen ini
            ->where('status_wali', 'disetujui');   // Hanya krs yang sudah di-ACC dosen wali

        if ($request->id_pengajar) {
            $query->where('pengajar_id', $request->id_pengajar);
        }

        // Filter Program Studi
        if ($request->id_prodi) {
            $query->whereHas('krs.mahasiswa', function ($q) use ($request) {
                $q->where('id_prodi', $request->id_prodi);
            });
        }

        // Filter Kelas
        if ($request->id_kelas) {
    $query->whereHas('krs.mahasiswa.kelas', function ($q) use ($request) {
        $q->where('nama_kelas', $request->id_kelas);
    });
}

        // Filter Sesi
        if ($request->sesi) {
            $query->whereHas('krs.mahasiswa.kelas', function ($q) use ($request) {
                $q->where('kategori', $request->sesi); 
            });
        }
        if ($request->semester) {
    $query->whereHas('pengajar.mataKuliah', function ($q) use ($request) {
        $q->where('semester', $request->semester);
    });
}

        $krsDetails = $query->get();

        $mahasiswa = $krsDetails->map(function ($detail) {
            return (object) [
                'id_krs_detail' => $detail->id_krs_detail,
                'nim'           => $detail->krs->mahasiswa->nim ?? '-',
                'nama'          => $detail->krs->mahasiswa->nama ?? '-',
                'nama_mk'       => $detail->pengajar->mataKuliah->nama_mk ?? $detail->pengajar->kode_mk ?? '-',
                'mataKuliah'    => $detail->pengajar->mataKuliah,
                'khs'           => $detail->khs 
            ];
        });

        return view('dosen.penilaian', compact('mahasiswa', 'prodi', 'kelas', 'matkulDiampu'));
    }

    public function simpan(Request $request)
    {
        if (!$request->has('krs_detail_id') || empty($request->krs_detail_id)) {
            return back()->with('error', 'Tidak ada data nilai mahasiswa untuk disimpan.');
        }

        $statusNilai = $request->input('action') === 'final' ? 'Final' : 'Draft';

        // Ambil NIK dosen yang login
        $userId = auth::id();
        $dosen = \App\Models\Dosen::where('user_id', $userId)->first();
        $nikDosen = $dosen ? $dosen->nik : null;

        foreach ($request->krs_detail_id as $id) {
            if (is_null($id)) continue;

            $partisipatif = $request->partisipatif[$id] ?? 0;
            $tugas = $request->tugas[$id] ?? 0;
            $quiz = $request->quiz[$id] ?? 0;
            $proyek = $request->proyek[$id] ?? 0;
            $uts = $request->uts[$id] ?? 0;
            $uas = $request->uas[$id] ?? 0;

            // Hitung Nilai Akhir (NA)
           $detail = KrsDetail::with('pengajar.mataKuliah')
    ->find($id);

if (!$detail || !$detail->pengajar || !$detail->pengajar->mataKuliah) {
    continue;
}


$mk = $detail->pengajar->mataKuliah;
if(!$mk->dikunci)
{
    return back()
    ->with(
        'error',
        'Bobot penilaian mata kuliah belum dikunci oleh KPS'
    );
}

$na =
($partisipatif * ($mk->persen_partisipatif/100))
+
($tugas * ($mk->persen_tugas/100))
+
($quiz * ($mk->persen_quiz/100))
+
($proyek * ($mk->persen_proyek/100))
+
($uts * ($mk->persen_uts/100))
+
($uas * ($mk->persen_uas/100));

            // Tentukan Nilai Huruf (NH)
if ($na >= 85) { 
    $nh = 'A'; 
} elseif ($na >= 80) { 
    $nh = 'B+';
} elseif ($na >= 75) { 
    $nh = 'B'; 
} elseif ($na >= 70) { 
    $nh = 'C+'; 
} elseif ($na >= 65) { 
    $nh = 'C'; 
} elseif ($na >= 60) { 
    $nh = 'D+'; 
} elseif ($na >= 55) { 
    $nh = 'D'; 
} else { 
    $nh = 'E'; 
}

            // Cek data lama di DB
            $khs = \App\Models\Khs::where('krs_detail_id', $id)->first();

            $dataNilai = [
                'nik'          => $nikDosen,
                'partisipatif' => $partisipatif,
                'tugas'        => $tugas,
                'quiz'         => $quiz,
                'proyek'       => $proyek,
                'uts'          => $uts,
                'uas'          => $uas,
                'na'           => $na,
                'nh'           => $nh,
                'status'       => $statusNilai,
            ];

            if ($khs) {
                $khs->update($dataNilai);
            } else {
                $dataNilai['krs_detail_id'] = $id;
                $baru = new \App\Models\Khs();
                $baru->fill($dataNilai);
                $baru->save();
            }
        }

        $message = $statusNilai === 'Final' ? 'Nilai berhasil difinalisasi!' : 'Draft nilai berhasil disimpan!';
        return back()->with('success', $message);
    }
}