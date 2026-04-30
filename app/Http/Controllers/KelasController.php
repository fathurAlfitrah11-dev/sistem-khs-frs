<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Prodi;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        $dosen = Dosen::all();
        $prodi = Prodi::all();
        return view('admin.kelas.index', compact('data', 'dosen', 'prodi'));
    }

    public function create()
    {
        $dosen = Dosen::doesntHave('kelasWali')->get();
        return view('admin.kelas.create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori' => 'required',
            'semester' => 'required',
            'id_prodi' => 'required',
            'nuptk_wali' => 'nullable|unique:kelas,nuptk_wali'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'id_prodi.required' => 'Program studi wajib diisi',
            'nuptk_wali.unique' => 'Dosen sudah menjadi wali kelas'
        ]);

        Kelas::create([
    'nama_kelas' => $request->nama_kelas,
    'kategori' => $request->kategori,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi,
    'nuptk_wali' => $request->nuptk_wali ?:null
]);
        return redirect('/kelas')
            ->with('success','Kelas berhasil ditambahkan');
    }
    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $dosen = Dosen::doesntHave('kelasWali')
            ->orWhereHas('kelasWali', function ($query) use ($id_kelas) {
                $query->where('id_kelas', $id_kelas);
            })
            ->get();
        return view('admin.kelas.edit', compact('kelas', 'dosen'));
    }
    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'kategori' => 'required',
            'semester' => 'required',
            'id_prodi' => 'required',
            'nuptk_wali' => 'nullable|unique:kelas,nuptk_wali,'.$id_kelas.',id_kelas'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi',
            'kategori.required' => 'Kategori wajib diisi',
            'semester.required' => 'Semester wajib diisi',
            'id_prodi.required' => 'Program studi wajib diisi',
            'nuptk_wali.unique' => 'Dosen sudah menjadi wali kelas'
        ]);
        
        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
    'nama_kelas' => $request->nama_kelas,
    'kategori' => $request->kategori,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi,
    'nuptk_wali' => $request->nuptk_wali
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