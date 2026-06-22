<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\Validator;
class ProdiController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $data = Prodi::when($search, function ($query) use ($search) {
            $query->where('nama_prodi', 'like', "%$search%")
                  ->orWhere('jenjang', 'like', "%$search%");
        })
        ->orderBy('id_prodi', 'desc')
        ->paginate(10)
        ->appends($request->query());

    return view('admin.prodi.index', compact('data', 'search'));
}

   public function store(Request $request)
{
   $validator = Validator::make($request->all(), [
    'jenjang' => 'required',
    'nama_prodi' => 'required',
], [
    'jenjang.required' => 'Jenjang wajib dipilih',
    'nama_prodi.required' => 'Nama prodi wajib diisi',
]);

if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'tambah')
        ->with('open_modal', 'tambah');
}
    $cek = Prodi::where('nama_prodi', $request->nama_prodi)
        ->where('jenjang', $request->jenjang)
        ->first();

    if ($cek) {
        return back()
            ->withInput()
            ->with('error', 'Program studi dengan jenjang tersebut sudah ada.');
    }

    Prodi::create([
        'jenjang' => $request->jenjang,
        'nama_prodi' => $request->nama_prodi,
    ]);

    return redirect('/prodi')
        ->with('success', 'Prodi berhasil ditambahkan');
}
   
    public function update(Request $request, $id_prodi)
    {
    $validator = Validator::make($request->all(), [
    'jenjang' => 'required',
    'nama_prodi' => 'required',
], [
    'jenjang.required' => 'Jenjang wajib dipilih',
    'nama_prodi.required' => 'Nama Program Studi wajib diisi',
]);

if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'edit')
        ->with('open_modal', 'edit');
}

        $prodi = Prodi::findOrFail($id_prodi);
        $cek = Prodi::where('nama_prodi', $request->nama_prodi)
        ->where('jenjang', $request->jenjang)
        ->where('id_prodi', '!=', $id_prodi)
        ->first();

    if ($cek) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Program studi dengan jenjang tersebut sudah ada.');
    }
    $prodi->update([
        'jenjang' => $request->jenjang,
        'nama_prodi' => $request->nama_prodi,
    ]);

        return redirect('/prodi')
            ->with('success','Prodi berhasil diubah');
    }
    public function delete($id_prodi)
    {
        Prodi::findOrFail($id_prodi)->delete();

        return redirect('/prodi')
            ->with('success','Prodi berhasil dihapus');
    }
}
