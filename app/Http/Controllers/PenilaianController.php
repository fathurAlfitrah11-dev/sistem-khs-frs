<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Khs;
use App\Models\KrsDetail;
use App\Models\Pengajar;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index(Request $request)
{
    $prodi = Prodi::all();
    $kelas = Kelas::all();
    $tahunAjaranList = \App\Models\TahunAjaran::orderBy('tahun_awal', 'desc')->get();

    $userId = Auth::id();

    $dosen = \App\Models\Dosen::where('user_id', $userId)->first();
    $nikDosen = $dosen ? $dosen->nik : null;

    $matkulQuery = Pengajar::where('nik', $nikDosen)
    ->when($request->semester, function ($q) use ($request) {
        $q->whereHas('mataKuliah', function ($m) use ($request) {
            $m->where('semester', $request->semester);
        });
    })
    ->when($request->id_tahun_ajaran, function ($q) use ($request) {
        $q->where('id_tahun_ajaran', $request->id_tahun_ajaran);
    });

    $matkulDiampu = $request->filled('semester')
        ? $matkulQuery->get()
        : collect();

    $pengajarIds = $matkulDiampu->pluck('id_pengajar')->toArray();

    if (empty($pengajarIds)) {
        return view('dosen.penilaian', [
            'mahasiswa' => collect(),
            'prodi' => $prodi,
            'kelas' => $kelas,
            'matkulDiampu' => $matkulDiampu,
            'tahunAjaranList' => $tahunAjaranList
        ]);
    }

    $query = KrsDetail::with([
            'krs.mahasiswa.prodi',
            'krs.mahasiswa.kelas',
            'khs',
            'pengajar.mataKuliah'
        ])
        ->whereIn('pengajar_id', $pengajarIds)
        ->where('status_wali', 'disetujui');

    // =========================
    // FILTER BARU: TAHUN AJARAN
    // =========================
    if ($request->id_tahun_ajaran) {
    $query->whereHas('krs', function ($q) use ($request) {
        $q->where('id_tahun_ajaran', $request->id_tahun_ajaran);
    });
}

    // FILTER PRODI
    if ($request->id_prodi) {
        $query->whereHas('krs.mahasiswa', function ($q) use ($request) {
            $q->where('id_prodi', $request->id_prodi);
        });
    }

    // FILTER KELAS
    if ($request->id_kelas) {
        $query->whereHas('krs.mahasiswa.kelas', function ($q) use ($request) {
            $q->where('nama_kelas', $request->id_kelas);
        });
    }

    // FILTER SESI
    if ($request->sesi) {
        $query->whereHas('krs.mahasiswa.kelas', function ($q) use ($request) {
            $q->where('kategori', $request->sesi);
        });
    }

    // FILTER SEMESTER MK
    if ($request->semester) {
        $query->whereHas('pengajar.mataKuliah', function ($q) use ($request) {
            $q->where('semester', $request->semester);
        });
    }

    $krsDetails = $query->get();

    $mahasiswa = $krsDetails->map(function ($detail) {
        return (object) [
            'id_krs_detail' => $detail->id_krs_detail,
            'nim' => $detail->krs->mahasiswa->nim ?? '-',
            'nama' => $detail->krs->mahasiswa->nama ?? '-',
            'nama_mk' => $detail->pengajar->mataKuliah->nama_mk ?? '-',
            'mataKuliah' => $detail->pengajar->mataKuliah,
            'khs' => $detail->khs
        ];
    });

    return view('dosen.penilaian', compact(
        'mahasiswa',
        'prodi',
        'kelas',
        'matkulDiampu',
        'tahunAjaranList'
    ));
}

   public function simpan(Request $request)
{
    if (!$request->has('krs_detail_id') || empty($request->krs_detail_id)) {
        return back()->with('error', 'Tidak ada data nilai mahasiswa untuk disimpan.');
    }

    $statusNilai = $request->input('action') === 'final' ? 'Final' : 'Draft';

    $tahun = \App\Models\TahunAjaran::where('status', 'aktif')->first();

    if (!$tahun) {
        return back()->with('error', 'Tahun ajaran tidak ditemukan.');
    }

    // CEK PENGUNCIAN KPS (INI YANG KUNCI SISTEM)
    $userId = Auth::id();
    $dosen = \App\Models\Dosen::where('user_id', $userId)->first();
    $nikDosen = $dosen?->nik;

    foreach ($request->krs_detail_id as $id) {

        if (is_null($id)) continue;

        $detail = KrsDetail::with('pengajar.mataKuliah')->find($id);

        if (!$detail || !$detail->pengajar || !$detail->pengajar->mataKuliah) {
            continue;
        }

        $mk = $detail->pengajar->mataKuliah;

        // CEK KPS LOCK (INI YANG WAJIB)
        $penguncian = \App\Models\PenguncianNilai::where('id_prodi', $mk->id_prodi ?? null)
            ->where('id_tahun_ajaran', $tahun->id_tahun_ajaran)
            ->first();

        if ($penguncian && $penguncian->status === 'dikunci') {
            return back()->with('error', 'Nilai sudah dikunci oleh KPS.');
        }

        // kalau bobot belum dikunci → tetap block
        if (!$mk->dikunci) {
            return back()->with('error', 'Bobot penilaian belum dikunci oleh KPS.');
        }

        $partisipatif = $request->partisipatif[$id] ?? 0;
        $tugas = $request->tugas[$id] ?? 0;
        $quiz = $request->quiz[$id] ?? 0;
        $proyek = $request->proyek[$id] ?? 0;
        $uts = $request->uts[$id] ?? 0;
        $uas = $request->uas[$id] ?? 0;

        // hitung NA
        $na =
            ($partisipatif * ($mk->persen_partisipatif / 100)) +
            ($tugas * ($mk->persen_tugas / 100)) +
            ($quiz * ($mk->persen_quiz / 100)) +
            ($proyek * ($mk->persen_proyek / 100)) +
            ($uts * ($mk->persen_uts / 100)) +
            ($uas * ($mk->persen_uas / 100));

        // NH
        if ($na >= 85) $nh = 'A';
        elseif ($na >= 80) $nh = 'B+';
        elseif ($na >= 75) $nh = 'B';
        elseif ($na >= 70) $nh = 'C+';
        elseif ($na >= 65) $nh = 'C';
        elseif ($na >= 60) $nh = 'D+';
        elseif ($na >= 55) $nh = 'D';
        else $nh = 'E';

        // UPSERT (BIAR FINAL BERULANG TETAP UPDATE)
        \App\Models\Khs::updateOrCreate(
            [
                'krs_detail_id' => $id
            ],
            [
                'nik' => $nikDosen,
                'partisipatif' => $partisipatif,
                'tugas' => $tugas,
                'quiz' => $quiz,
                'proyek' => $proyek,
                'uts' => $uts,
                'uas' => $uas,
                'na' => $na,
                'nh' => $nh,
                'status' => $statusNilai, // FINAL / DRAFT bebas update terus
            ]
        );
    }

    return back()->with(
        'success',
        $statusNilai === 'Final'
            ? 'Nilai berhasil difinalisasi!'
            : 'Draft nilai berhasil disimpan!'
    );
}

}