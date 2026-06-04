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
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk',
            'nama_mk' => 'required',
            'sks' => 'required|integer|max:4|min:2',
            'semester' => 'required|integer',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'jenis' => 'required|array'
        ], [
            'kode_mk.unique' => 'Kode mata kuliah sudah terdaftar!',
            'jenis.required' => 'Jenis mata kuliah wajib dipilih!'
        ]);

        $data = $request->all();

$data['jenis'] = implode(',', $request->jenis);

MataKuliah::create($data);

        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil ditambahkan');
    }
   
    public function update(Request $request, $id_mata_kuliah)
    {
        $mata_kuliah = MataKuliah::findOrFail($id_mata_kuliah);
        $request->validate([
            'kode_mk' => 'required|unique:mata_kuliah,kode_mk,'.$mata_kuliah->id_mata_kuliah.',id_mata_kuliah',
            'nama_mk' => 'required',
            'sks' => 'required|integer|max:4|min:2',
            'semester' => 'required|integer',
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'jenis' => 'required|array'
        ], [
            'kode_mk.unique' => 'Kode mata kuliah sudah terdaftar!',
            'jenis.required' => 'Jenis mata kuliah wajib dipilih!'
        ]);
        $data = $request->all();

$data['jenis'] = implode(',', $request->jenis);

$mata_kuliah->update($data);

        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil diupdate');
}
    public function delete($id_mata_kuliah)
    {
        $mata_kuliah = MataKuliah::findOrFail($id_mata_kuliah);
        $mata_kuliah->delete();
        return redirect('/mata-kuliah')
            ->with('success','Data mata kuliah berhasil dihapus');
}
}
