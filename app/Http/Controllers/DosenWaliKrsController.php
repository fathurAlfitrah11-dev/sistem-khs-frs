<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Krs;
use App\Models\KrsDetail;

class DosenWaliKrsController extends Controller
{
   public function index()
{
    $dosen = \App\Models\Dosen::where('user_id', \Auth::id())->first();

    if (!$dosen) {
        return redirect()->back()->with('error', 'Data Dosen tidak ditemukan.');
    }

    $kelasDosenWali = \App\Models\Kelas::where('nik_wali', $dosen->nik)->pluck('id_kelas')->toArray();
    if (empty($kelasDosenWali)) {
        $krs = collect();
        return view('dosen.wali.krs.index', compact('krs'));
    } 

    $krs = \App\Models\Krs::with(['mahasiswa.kelas', 'detail'])
        ->whereIn('nim', function($query) use ($kelasDosenWali) {
            $query->select('nim')
                  ->from('mahasiswa')
                  ->whereIn('id_kelas', $kelasDosenWali);
        })
        ->get();

    return view('dosen.wali.krs.index', compact('krs'));
}

    public function detail($id_krs)
   {
        $krs = Krs::with(['mahasiswa', 'detail.pengajar.mataKuliah'])->findOrFail($id_krs);
        
        return view('dosen.wali.krs.detail', compact('krs'));
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
