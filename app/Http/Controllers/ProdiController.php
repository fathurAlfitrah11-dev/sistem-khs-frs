<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
class ProdiController extends Controller
{
    public function index()
    {
        $data = Prodi::all();
        return view('admin.prodi.index', compact('data'));
    }

    public function create()
    {
        $prodi = Prodi::all();
        return view('admin.prodi.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        Prodi::create($request->all());

        return redirect('/prodi')
            ->with('success','Prodi berhasil ditambahkan');
    }
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        return view('admin.prodi.edit', compact('prodi'));
    }
    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return redirect('/prodi')
            ->with('success','Prodi berhasil diupdate');
    }
    public function delete($id)
    {
        Prodi::findOrFail($id)->delete();

        return redirect('/prodi')
            ->with('success','Prodi berhasil dihapus');
    }
}
