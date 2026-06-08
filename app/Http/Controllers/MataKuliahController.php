<?php

namespace App\Http\Controllers;
use App\Models\Prodi;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
     public function index(Request $request)
{
    $search = $request->search;

    $data = MataKuliah::with('prodi')
        ->when($search, function ($query) use ($search) {
            $query->where('nama_mk', 'like', "%$search%")
                  ->orWhere('kode_mk', 'like', "%$search%")
                  ->orWhereHas('prodi', function ($q) use ($search) {
                      $q->where('nama_prodi', 'like', "%$search%");
                  });
        })
        ->paginate(10)
        ->appends($request->query());

    $prodi = Prodi::all();

    return view('admin.mata-kuliah.index', compact('data', 'prodi', 'search'));
}
     public function store(Request $request)
    {
       if (MataKuliah::where('kode_mk', $request->kode_mk)->exists()) {
        return back()->with('error', 'Kode mata kuliah sudah terdaftar!');
    }
        MataKuliah::create([
    'kode_mk' => $request->kode_mk,
    'nama_mk' => $request->nama_mk,
    'sks' => $request->sks,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi,
]);

        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil ditambahkan');
    }
   
    public function update(Request $request, $kode_mk)
    {
        $mata_kuliah = MataKuliah::findOrFail($kode_mk);
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk,' . $kode_mk . ',kode_mk',
            'nama_mk' => 'required',
            'sks' => 'required|integer|max:4|min:2',
            'semester' => 'required|integer',
            'id_prodi' => 'required|exists:prodi,id_prodi'
        ], [
            'kode_mk.unique' => 'Kode mata kuliah sudah terdaftar!'
        ]);
        $mata_kuliah->update([
    'nama_mk' => $request->nama_mk,
    'sks' => $request->sks,
    'semester' => $request->semester,
    'id_prodi' => $request->id_prodi,
]);

        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil diupdate');
}
    public function delete($kode_mk)
    {
        $mata_kuliah = MataKuliah::findOrFail($kode_mk);
        $mata_kuliah->delete();
        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil dihapus');
}
}
