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
        Prodi::create($request->all());

        return redirect('/prodi')
            ->with('success','Prodi berhasil ditambahkan');
    }
   
    public function update(Request $request, $id_prodi)
    {
        $prodi = Prodi::findOrFail($id_prodi);
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
