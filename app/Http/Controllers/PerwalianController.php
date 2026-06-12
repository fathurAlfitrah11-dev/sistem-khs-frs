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
    /**
     * Menampilkan daftar KRS mahasiswa bimbingan secara dinamis.
     */
    public function index(): View
    {
        // 1. Ambil NIK dosen langsung dari username akun yang sedang login
        $nikDosen = Auth::user()->username; 

        // 2. Ambil seluruh id_kelas yang di-wali-i
        $kelasDosenWali = Kelas::where('nik_wali', $nikDosen)->pluck('id_kelas')->toArray();

        // 3. Proteksi jika dosen belum memiliki kelas wali sama sekali
        if (empty($kelasDosenWali)) {
            return view('perwalian.index', ['krs' => collect()]);
        }

        // 4. Tarik data KRS hanya untuk mahasiswa yang berada di kelas wali dosen tersebut
        $krs = Krs::with(['mahasiswa.kelas', 'detail'])
            ->whereIn('nim', function($query) use ($kelasDosenWali) {
                $query->select('nim')
                      ->from('mahasiswa')
                      ->whereIn('id_kelas', $kelasDosenWali);
            })
            ->get();

        return view('perwalian.index', compact('krs'));
    }

    /**
     * Menampilkan detail mata kuliah KRS mahasiswa.
     */
    public function detail($id_krs): View
    {
        $krs = Krs::with(['mahasiswa', 'detail.pengajar.mataKuliah'])->findOrFail($id_krs);
        
        return view('perwalian.detail', compact('krs'));
    }

    /**
     * Memproses persetujuan KRS mahasiswa secara aman (Database Transaction).
     */
    public function proses(Request $request): RedirectResponse
    {
        $request->validate([
            'id_krs'      => 'required',
            'status_wali' => 'required|array'
        ]);

        // Menggunakan Database Transaction agar update data sinkron dan anti-gagal/korup
        DB::transaction(function () use ($request) {
            // 1. Update status tiap baris mata kuliah di krs_detail
            foreach ($request->status_wali as $id_detail => $status) {
                KrsDetail::where('id_krs_detail', $id_detail)->update([
                    'status_wali' => $status
                ]);
            }

            // 2. Sinkronisasi status di tabel KRS utama menjadi disetujui
            Krs::where('id_krs', $request->id_krs)->update([
                'status_wali' => 'disetujui' 
            ]);
        });

        return redirect()->back()->with('success', 'Status perwalian KRS berhasil diperbarui!');
    }
}