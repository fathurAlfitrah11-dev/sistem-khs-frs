<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Prodi;

class KelasController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $data = Kelas::with('prodi')
    ->when($search, function ($query) use ($search) {

        $query->where(function ($q) use ($search) {

            if (is_numeric($search)) {
                $q->where('semester', $search);
            } else {

                $q->where('nama_kelas', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(semester, nama_kelas) LIKE ?", ["%{$search}%"])
                  ->orWhereHas('prodi', function ($p) use ($search) {
                      $p->where('nama_prodi', 'like', "%{$search}%")
                        ->orWhere('jenjang', 'like', "%{$search}%");
                  });
            }
        });

    })
    ->orderBy('id_kelas', 'desc')
    ->paginate(10)
    ->appends($request->query());

    $dosen = Dosen::all();
    $prodi = Prodi::all();

    return view('admin.kelas.index', compact('data', 'dosen', 'prodi', 'search'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori' => 'required',
            'semester' => 'required',
            'id_prodi' => 'required',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'id_prodi.required' => 'Program studi wajib diisi'
        ]);

        Kelas::create([
    'nama_kelas' => $request->nama_kelas,
    'kategori' => $request->kategori,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi
]);
        return redirect('/kelas')
            ->with('success','Kelas berhasil ditambahkan');
    }
   
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori' => 'required',
            'semester' => 'required',
            'id_prodi' => 'required',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'id_prodi.required' => 'Program studi wajib diisi',
        ]);
        
        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
    'nama_kelas' => $request->nama_kelas,
    'kategori' => $request->kategori,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi,
]);

        return redirect('/kelas')
            ->with('success','Kelas berhasil diupdate');
    }
    public function delete($id_kelas)
    {
        Kelas::findOrFail($id_kelas)->delete();

        return redirect('/kelas')
            ->with('success','Kelas berhasil dihapus');
    }
}