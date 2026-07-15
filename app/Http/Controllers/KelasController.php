<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjaran;

class KelasController extends Controller
{
//HITUNG SEMESTER
private function hitungSemester($angkatan)
{
   $tahunAjaran = TahunAjaran::where('status', 'aktif')->first();

    if (!$tahunAjaran) {
        return 1;
    }

    $tahunAktif = $tahunAjaran->tahun_awal;

    // offset: ganjil = 1 (semester 1), genap = 2 (semester 2)
    $offset = $tahunAjaran->semester === 'ganjil' ? 1 : 2;

    $selisih = $tahunAktif - $angkatan;
    if ($selisih < 0) $selisih = 0;

    return ($selisih * 2) + $offset;
}

    /**
     * LIST DATA KELAS
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $idProdi = $request->id_prodi; // 💡 BARU: Mengambil input filter Program Studi

        // Menggunakan join agar bisa melakukan sorting berdasarkan nama_prodi dari tabel prodi
        $data = Kelas::select('kelas.*')
            ->join('prodi', 'kelas.id_prodi', '=', 'prodi.id_prodi')
            ->with('prodi')
            
            //Filter berdasarkan Program Studi jika dipilih
            ->when($idProdi, function ($query) use ($idProdi) {
                $query->where('kelas.id_prodi', $idProdi);
            })
            
            // Fitur Pencarian
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    if (is_numeric($search)) {
                        $q->where('kelas.semester', $search);
                    } else {
                        $q->where('kelas.nama_kelas', 'like', "%{$search}%")
                          ->orWhere('kelas.kategori', 'like', "%{$search}%")
                          ->orWhere('prodi.nama_prodi', 'like', "%{$search}%")
                          ->orWhere('prodi.jenjang', 'like', "%{$search}%");
                    }
                });
            })
          
            ->orderBy('prodi.nama_prodi', 'asc') 
            ->orderBy('kelas.semester', 'asc')   
            ->orderBy('kelas.nama_kelas', 'asc')
            ->paginate(10)
            ->appends($request->query());

        $prodi = Prodi::all();
        $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

        return view('admin.kelas.index', compact('data', 'prodi', 'search', 'tahunAktif', 'idProdi'));
    }
    /**
     * SIMPAN DATA KELAS
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori'   => 'required',
            'id_prodi'   => 'required',
            'angkatan'   => 'required|numeric',
        ]);

        $semester = $this->hitungSemester($request->angkatan);

        $cek = Kelas::where([
            'nama_kelas' => $request->nama_kelas,
            'kategori'   => $request->kategori,
            'id_prodi'   => $request->id_prodi,
            'angkatan'   => $request->angkatan,
        ])->first();

        if ($cek) {
            return back()->with('error', 'Kelas sudah ada.');
        }

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kategori'   => $request->kategori,
            'id_prodi'   => $request->id_prodi,
            'angkatan'   => $request->angkatan,
            'semester'   => $semester,
        ]);

        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * UPDATE DATA KELAS
     */
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori'   => 'required',
            'id_prodi'   => 'required',
            'angkatan'   => 'required|numeric',
        ]);

        $kelas = Kelas::findOrFail($id_kelas);

        $semester = $this->hitungSemester($request->angkatan);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'kategori'   => $request->kategori,
            'id_prodi'   => $request->id_prodi,
            'angkatan'   => $request->angkatan,
            'semester'   => $semester,
        ]);

        return redirect('/kelas')->with('success', 'Kelas berhasil diupdate');
    }

    /**
     * DELETE DATA
     */
    public function delete($id_kelas)
    {
        Kelas::findOrFail($id_kelas)->delete();

        return back()->with('success', 'Kelas berhasil dihapus');
    }
}