<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Krs;
use App\Models\KrsDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PerwalianController extends Controller
{
    private function getSemesterFromTahun($tahun)
{
    return $tahun->semester; // ganjil / genap
}

   public function index(Request $request): View
{
    $nikDosen = Auth::user()->username;

    $kelasDosenWali = Kelas::where('nik_wali', $nikDosen)
        ->pluck('id_kelas')
        ->toArray();

    if (empty($kelasDosenWali)) {
        return view('dosen.wali.krs.index', [
            'krs' => collect(),
            'tahunAjaranList' => collect(),
            'tahunAktif' => null,
            'selectedTahun' => null
        ]);
    }

    // LIST SEMUA TAHUN
    $tahunAjaranList = \App\Models\TahunAjaran::orderBy('tahun_awal', 'desc')->get();

    // TAHUN AKTIF
    $tahunAktif = \App\Models\TahunAjaran::where('status', 'aktif')->first();

    // FIX: kalau tidak pilih, pakai tahun aktif
    $selectedTahun = $request->id_tahun_ajaran ?? $tahunAktif?->id_tahun_ajaran;

    // QUERY KRS (SUPPORT HISTORY + FILTER)
    $krs = Krs::with(['mahasiswa.kelas', 'detail.pengajar.mataKuliah'])
        ->whereIn('nim', function ($query) use ($kelasDosenWali) {
            $query->select('nim')
                ->from('mahasiswa')
                ->whereIn('id_kelas', $kelasDosenWali);
        })
        ->when($selectedTahun, function ($q) use ($selectedTahun) {
            $q->where('id_tahun_ajaran', $selectedTahun);
        })
        ->orderBy('id_krs', 'desc')
        ->get();

    return view('dosen.wali.krs.index', compact(
        'krs',
        'tahunAjaranList',
        'tahunAktif',
        'selectedTahun'
    ));
}

    public function detail($id_krs): View
    {
        $krs = Krs::with(['mahasiswa', 'detail.pengajar.mataKuliah'])->findOrFail($id_krs);
        
        return view('dosen.wali.krs.detail', compact('krs')); 
    }

    public function proses(Request $request): RedirectResponse
    {
        $request->validate([
            'id_krs'      => 'required',
            'status_wali' => 'required|array'
        ]);

        $nikDosenSelesai = Auth::user()->username;

        DB::transaction(function () use ($request, $nikDosenSelesai) {
            foreach ($request->status_wali as $id_detail => $status) {
                KrsDetail::where('id_krs_detail', $id_detail)->update([
                    'status_wali' => $status
                ]);
            }
            Krs::where('id_krs', $request->id_krs)->update([
                'status_wali' => 'disetujui',
                'nik_wali'    => $nikDosenSelesai 
            ]);
        });

        return redirect()->back()->with('success', 'Status perwalian KRS berhasil diperbarui!');
    }
}