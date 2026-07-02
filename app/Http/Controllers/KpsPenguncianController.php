<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use App\Models\Khs;
use App\Models\KrsDetail;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KpsPenguncianController extends Controller
{
    public function index()
    {
        // ambil dosen login
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $prodi = Prodi::where('nik_kps', $dosen->nik)->first();
        // matkul sesuai prodi yang dia KPS-kan
        $matkul = MataKuliah::whereHas('prodi', function ($q) use ($dosen) {
            $q->where('nik_kps', $dosen->nik);
        })->get();

        return view('dosen.kps.index', compact('matkul', 'prodi'));
    }

    public function update(Request $request, $kode_mk)
    {
        $mk = MataKuliah::findOrFail($kode_mk);

        if ($mk->dikunci) {
            return back()->with('error', 'Bobot sudah dikunci');
        }

        $total =
            $request->persen_partisipatif +
            $request->persen_tugas +
            $request->persen_quiz +
            $request->persen_proyek +
            $request->persen_uts +
            $request->persen_uas;

        if ($total != 100) {
            return back()->with('error', 'Total bobot harus 100%');
        }

        $mk->update([
            'persen_partisipatif' => $request->persen_partisipatif,
            'persen_tugas'        => $request->persen_tugas,
            'persen_quiz'         => $request->persen_quiz,
            'persen_proyek'       => $request->persen_proyek,
            'persen_uts'          => $request->persen_uts,
            'persen_uas'          => $request->persen_uas
        ]);

        return back()->with('success', 'Bobot berhasil diubah');
    }

    public function kunci(Request $request, $kode_mk)
    {
        $mk = MataKuliah::findOrFail($kode_mk);

        if ($mk->dikunci) {
            return back()->with('error', 'Bobot sudah dikunci');
        }

        $partisipatif = (int) $request->persen_partisipatif;
        $tugas        = (int) $request->persen_tugas;
        $quiz         = (int) $request->persen_quiz;
        $proyek       = (int) $request->persen_proyek;
        $uts          = (int) $request->persen_uts;
        $uas          = (int) $request->persen_uas;

        $total = $partisipatif + $tugas + $quiz + $proyek + $uts + $uas;

        if ($total !== 100) {
            return back()->with('error', 'Total bobot harus 100%');
        }

        $mk->update([
            'persen_partisipatif' => $partisipatif,
            'persen_tugas'        => $tugas,
            'persen_quiz'         => $quiz,
            'persen_proyek'       => $proyek,
            'persen_uts'          => $uts,
            'persen_uas'          => $uas,
            'dikunci'             => true
        ]);

        return back()->with('success', 'Bobot berhasil dikunci');
    }

    public function bukaKunci($kode_mk)
    {
        $mk = MataKuliah::findOrFail($kode_mk);

        $mk->update([
            'dikunci' => false
        ]);

        return back()->with('success', 'Bobot berhasil dibuka');
    }

    // PER PRODI

    public function tutupNilai()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        // tutup hanya prodi yang dia KPS-kan
        Prodi::where('nik_kps', $dosen->nik)
            ->update(['nilai_dikunci' => true]);

        return back()->with('success', 'Penginputan nilai prodi berhasil ditutup');
    }

    public function bukaNilai()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        // buka hanya prodi yang dia KPS-kan
        Prodi::where('nik_kps', $dosen->nik)
            ->update(['nilai_dikunci' => false]);

        return back()->with('success', 'Penginputan nilai prodi berhasil dibuka');
    }

    public function storeNilaiOtomatis()
    {
        $krsDetails = KrsDetail::with('pengajar')
            ->doesntHave('khs')
            ->get();

        foreach ($krsDetails as $detail) {
            Khs::create([
                'krs_detail_id' => $detail->id_krs_detail,
                'nik'           => $detail->pengajar->nik,

                'partisipatif'  => 75,
                'tugas'         => 75,
                'quiz'          => 75,
                'proyek'        => 75,
                'uts'           => 75,
                'uas'           => 75,

                'na'            => 75,
                'nh'            => 'B',

                'status'        => 'Final'
            ]);
        }

        return back()->with('success', 'Nilai berhasil ditutup & di-generate');
    }
}