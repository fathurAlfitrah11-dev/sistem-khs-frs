<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class KpsController extends Controller
{
    public function index()
    {
        $prodiKps = Prodi::with(['kps.user'])
            ->whereNotNull('nik_kps')
            ->get();

        $allProdi = Prodi::all();

        $dosen = Dosen::with('user')->get();

        return view('admin.kps.index', compact(
            'prodiKps',
            'allProdi',
            'dosen'
        ));
    }

    // TAMBAH KPS
    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'nik_kps' => 'required|unique:prodi,nik_kps'
        ]);

        $prodi = Prodi::findOrFail($request->id_prodi);

        $prodi->update([
            'nik_kps' => $request->nik_kps
        ]);

        return redirect('/kps')
            ->with('success', 'KPS berhasil ditambahkan');
    }

    // UPDATE KPS
    public function update(Request $request, $id_prodi)
    {
        $request->validate([
            'nik_kps' =>
                'required|unique:prodi,nik_kps,' .
                $id_prodi .
                ',id_prodi'
        ]);

        $prodi = Prodi::findOrFail($id_prodi);

        $prodi->update([
            'nik_kps' => $request->nik_kps
        ]);

        return redirect('/kps')
            ->with('success', 'KPS berhasil diupdate');
    }

    // HAPUS KPS
    public function delete($id_prodi)
    {
        $prodi = Prodi::findOrFail($id_prodi);

        $prodi->update([
            'nik_kps' => null
        ]);

        return redirect('/kps')
            ->with('success', 'KPS berhasil dihapus');
    }
}