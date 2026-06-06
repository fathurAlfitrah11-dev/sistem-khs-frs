<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\Dosen;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class PerwalianController extends Controller
{

    public function index()
    {
        // Cari data dosen berdasarkan user yang sedang login
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->back()->with('error', 'Data Dosen tidak ditemukan.');
        }

        $krs = Krs::with(['mahasiswa.kelas'])
            ->whereHas('mahasiswa.kelas', function($query) use ($dosen) {
                $query->where('nik_wali', $dosen->nik);
            })->get();

        return view('perwalian.index', compact('krs'));
    }

    // 2. Menampilkan detail mata kuliah yang diambil oleh mahasiswa pilihan
    public function detail($id_krs)
    {
        $krs = Krs::with(['mahasiswa', 'detail.pengajar.mataKuliah'])->findOrFail($id_krs);
        
        return view('perwalian.detail', compact('krs'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'id_krs' => 'required',
            'status_wali' => 'required|array'
        ]);

        foreach ($request->status_wali as $id_detail => $status) {
            KrsDetail::where('id_krs_detail', $id_detail)->update([
                'status_wali' => $status
            ]);
        }

        return redirect()->back()->with('success', 'Status perwalian KRS berhasil diperbarui!');
    }
}