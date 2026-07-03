<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Khs;
use App\Models\KrsDetail;
use App\Models\MataKuliah;
use App\Models\PenguncianNilai;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KpsPenguncianController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $prodi = Prodi::where('nik_kps', $dosen->nik)->firstOrFail();

        // dropdown tahun ajaran
        $tahunAjaran = TahunAjaran::orderByDesc('id_tahun_ajaran')->get();

        // tahun yang dipilih
        $tahun = $request->filled('id_tahun_ajaran')
            ? TahunAjaran::findOrFail($request->id_tahun_ajaran)
            : TahunAjaran::where('status', 'aktif')->firstOrFail();

        // data penguncian
        $penguncian = PenguncianNilai::firstOrCreate(
            [
                'id_prodi' => $prodi->id_prodi,
                'id_tahun_ajaran' => $tahun->id_tahun_ajaran,
            ],
            [
                'status' => 'tidak_dikunci'
            ]
        );

        $deadlineLewat = now()->greaterThan($tahun->deadline_nilai);
        if ($deadlineLewat && $penguncian->status == 'tidak_dikunci') {
    $penguncian->status = 'dikunci';
            }

        if ($tahun->semester == 'ganjil') {

    $matkul = MataKuliah::where('id_prodi', $prodi->id_prodi)
        ->whereIn('semester', [1, 3, 5, 7])
        ->get();

} else {

    $matkul = MataKuliah::where('id_prodi', $prodi->id_prodi)
        ->whereIn('semester', [2, 4, 6, 8])
        ->get();

}

        return view('dosen.kps.index', compact(
            'matkul',
            'prodi',
            'tahun',
            'tahunAjaran',
            'penguncian',
            'deadlineLewat'
        ));
    }

    public function update(Request $request, $kode_mk)
    {
        $tahun = TahunAjaran::where('status', 'aktif')->first();

        if ($tahun && now()->greaterThan($tahun->deadline_nilai)) {
            return back()->with('error', 'Deadline penginputan nilai telah berakhir.');
        }

        $mk = MataKuliah::findOrFail($kode_mk);

        if ($mk->dikunci) {
            return back()->with('error', 'Bobot sudah dikunci.');
        }

        $total =
            $request->persen_partisipatif +
            $request->persen_tugas +
            $request->persen_quiz +
            $request->persen_proyek +
            $request->persen_uts +
            $request->persen_uas;

        if ($total != 100) {
            return back()->with('error', 'Total bobot harus 100%.');
        }

        $mk->update([
            'persen_partisipatif' => $request->persen_partisipatif,
            'persen_tugas' => $request->persen_tugas,
            'persen_quiz' => $request->persen_quiz,
            'persen_proyek' => $request->persen_proyek,
            'persen_uts' => $request->persen_uts,
            'persen_uas' => $request->persen_uas,
        ]);

        return back()->with('success', 'Bobot berhasil diubah.');
    }

    public function kunci(Request $request, $kode_mk)
    {
        $tahun = TahunAjaran::where('status', 'aktif')->first();

        if ($tahun && now()->greaterThan($tahun->deadline_nilai)) {
            return back()->with('error', 'Deadline penginputan nilai telah berakhir.');
        }

        $mk = MataKuliah::findOrFail($kode_mk);

        if ($mk->dikunci) {
            return back()->with('error', 'Bobot sudah dikunci.');
        }

        $partisipatif = (int) $request->persen_partisipatif;
        $tugas = (int) $request->persen_tugas;
        $quiz = (int) $request->persen_quiz;
        $proyek = (int) $request->persen_proyek;
        $uts = (int) $request->persen_uts;
        $uas = (int) $request->persen_uas;

        if (($partisipatif + $tugas + $quiz + $proyek + $uts + $uas) != 100) {
            return back()->with('error', 'Total bobot harus 100%.');
        }

        $mk->update([
            'persen_partisipatif' => $partisipatif,
            'persen_tugas' => $tugas,
            'persen_quiz' => $quiz,
            'persen_proyek' => $proyek,
            'persen_uts' => $uts,
            'persen_uas' => $uas,
            'dikunci' => true,
        ]);

        return back()->with('success', 'Bobot berhasil dikunci.');
    }

    public function bukaKunci($kode_mk)
    {
        $mk = MataKuliah::findOrFail($kode_mk);

        $mk->update([
            'dikunci' => false
        ]);

        return back()->with('success', 'Bobot berhasil dibuka.');
    }

    public function tutupNilai(Request $request)
{
    $tahun = TahunAjaran::findOrFail($request->id_tahun_ajaran);

    $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

    $prodi = Prodi::where('nik_kps', $dosen->nik)->firstOrFail();

    PenguncianNilai::updateOrCreate(
        [
            'id_prodi' => $prodi->id_prodi,
            'id_tahun_ajaran' => $tahun->id_tahun_ajaran,
        ],
        [
            'status' => 'dikunci'
        ]
    );

    // AUTO GENERATE KHS LANGSUNG
    $this->storeNilaiOtomatis();

    return back()->with('success', 'Penginputan nilai berhasil ditutup & KHS dibuat.');
}

    public function bukaNilai(Request $request)
    {
        $tahun = TahunAjaran::findOrFail($request->id_tahun_ajaran);

        $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

        $prodi = Prodi::where('nik_kps', $dosen->nik)->firstOrFail();

        PenguncianNilai::updateOrCreate(
            [
                'id_prodi' => $prodi->id_prodi,
                'id_tahun_ajaran' => $tahun->id_tahun_ajaran,
            ],
            [
                'status' => 'tidak_dikunci'
            ]
        );

        return back()->with('success', 'Penginputan nilai berhasil dibuka.');
    }
   public function storeNilaiOtomatis()
{
    $tahun = TahunAjaran::where('status', 'aktif')->first();

    if (!$tahun) {
        return back()->with('error', 'Tidak ada tahun ajaran aktif.');
    }

    $dosen = Dosen::where('user_id', Auth::id())->firstOrFail();

    $prodi = Prodi::where('nik_kps', $dosen->nik)->firstOrFail();

    $penguncian = PenguncianNilai::where('id_prodi', $prodi->id_prodi)
        ->where('id_tahun_ajaran', $tahun->id_tahun_ajaran)
        ->first();

    if (!$penguncian || $penguncian->status != 'dikunci') {
        return back()->with('error', 'Penginputan nilai belum dikunci.');
    }

    // AMBIL KRS DETAIL YANG BENAR (FILTER TAHUN AJARAN + PRODI)
    $krsDetails = KrsDetail::with(['krs.mahasiswa', 'pengajar.mataKuliah'])
        ->whereHas('krs', function ($q) use ($tahun, $prodi) {
            $q->where('id_tahun_ajaran', $tahun->id_tahun_ajaran)
              ->whereHas('mahasiswa.kelas', function ($q2) use ($prodi) {
                  $q2->where('id_prodi', $prodi->id_prodi);
              });
        })
        ->get();

    foreach ($krsDetails as $detail) {

        // CEGAH DUPLIKAT
        $cek = Khs::where('krs_detail_id', $detail->id_krs_detail)->exists();

        if ($cek) continue;

        // AMBIL BOBOT DARI MATKUL
        $mk = $detail->pengajar->mataKuliah;

        Khs::create([
            'krs_detail_id' => $detail->id_krs_detail,
            'nik'           => $detail->pengajar->nik ?? null,

            // DEFAULT NILAI OTOMATIS
            'partisipatif'  => 75,
            'tugas'         => 75,
            'quiz'          => 75,
            'proyek'        => 75,
            'uts'           => 75,
            'uas'           => 75,

            // HITUNG NA SIMPLE
            'na' => 75,
            'nh' => 'B',

            'status' => 'draft',
        ]);
    }

    return back()->with('success', 'Nilai berhasil digenerate.');
}
}