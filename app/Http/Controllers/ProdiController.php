<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
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
        $cek = Prodi::where('nama_prodi', $request->nama_prodi)
        ->where('jenjang', $request->jenjang)
        ->first();

    if ($cek) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Program studi dengan jenjang tersebut sudah ada.');
    }
        Prodi::create($request->all());

        return redirect('/prodi')
            ->with('success','Prodi berhasil ditambahkan');
    }
   
    public function update(Request $request, $id_prodi)
    {
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
        $prodi->update($request->all());

        return redirect('/prodi')
            ->with('success','Prodi berhasil diupdate');
    }
    public function delete($id_prodi)
    {
        Prodi::findOrFail($id_prodi)->delete();

        return redirect('/prodi')
            ->with('success','Prodi berhasil dihapus');
    }
}
