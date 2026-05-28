<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\Khs;
use App\Models\KrsDetail;

class PenilaianController extends Controller
{
public function index(Request $request)
{
    $prodi = Prodi::all();
    $kelas = Kelas::all();

    // Gunakan 'krs.detail.khs' sesuai nama relasi di Krs.php Anda
    $query = Mahasiswa::with(['prodi', 'kelas', 'krs.detail.khs']);

    // Filter Program Studi
    if ($request->id_prodi) {
        $query->where('id_prodi', $request->id_prodi);
    }

    // Filter Kelas
    if ($request->id_kelas) {
        $query->where('id_kelas', $request->id_kelas);
    }

    // Filter Semester (cek ke tabel kelas)
    if ($request->semester) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('semester', $request->semester);
        });
    }

    // Filter Sesi (cek ke kolom 'kategori' di tabel kelas)
    if ($request->sesi) {
        $query->whereHas('kelas', function ($q) use ($request) {
            $q->where('kategori', $request->sesi); 
        });
    }

    $mahasiswa = $query->get();

    return view('dosen.penilaian', compact('mahasiswa', 'prodi', 'kelas'));
}
public function simpan(Request $request)
{
    if (!$request->has('krs_detail_id') || empty($request->krs_detail_id)) {
        return back()->with('error', 'Tidak ada data nilai mahasiswa untuk disimpan.');
    }

    $statusNilai = $request->input('action') === 'final' ? 'Final' : 'Draft';

    foreach ($request->krs_detail_id as $id) {
        if (is_null($id)) continue;

        $partisipatif = $request->partisipatif[$id] ?? 0;
        $tugas = $request->tugas[$id] ?? 0;
        $quiz = $request->quiz[$id] ?? 0;
        $proyek = $request->proyek[$id] ?? 0;
        $uts = $request->uts[$id] ?? 0;
        $uas = $request->uas[$id] ?? 0;

        // Hitung Nilai Akhir (NA)
        $na = ($partisipatif * 0.1) + ($tugas * 0.2) + ($quiz * 0.1) + ($proyek * 0.2) + ($uts * 0.2) + ($uas * 0.2);

        // Tentukan Nilai Huruf (NH)
        if ($na >= 85) { $nh = 'A'; } 
        elseif ($na >= 75) { $nh = 'B'; } 
        elseif ($na >= 65) { $nh = 'C'; } 
        elseif ($na >= 50) { $nh = 'D'; } 
        else { $nh = 'E'; }

        Khs::updateOrCreate(
            ['krs_detail_id' => $id], 
            [
                'dosen_id' => auth()->id() ?? 3, 
                'partisipatif' => $partisipatif,
                'tugas' => $tugas,
                'quiz' => $quiz,
                'proyek' => $proyek,
                'uts' => $uts,
                'uas' => $uas,
                'na' => $na,
                'nh' => $nh,
                'status' => $statusNilai,
                'keterangan' => $request->keterangan[$id] ?? null,
            ]
        );
    }

    $message = $statusNilai === 'Final' ? 'Nilai berhasil difinalisasi!' : 'Draft nilai berhasil disimpan!';
    return back()->with('success', $message);
}
}