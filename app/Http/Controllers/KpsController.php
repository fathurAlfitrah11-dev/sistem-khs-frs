<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class KpsController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $prodiKps = Prodi::with(['kps.user'])
        ->whereNotNull('nik_kps')
        ->when($search, function ($query) use ($search) {
            $query->where('nama_prodi', 'like', "%$search%")
                  ->orWhere('nik_kps', 'like', "%$search%")
                  ->orWhereHas('kps.user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
        })
        ->paginate(10)
        ->appends($request->query());

    $allProdi = Prodi::all();

    $dosen = Dosen::with('user')->get();

    $DosenKps = Prodi::whereNotNull('nik_kps')
        ->pluck('nik_kps')
        ->toArray();

    return view('admin.kps.index', compact(
        'prodiKps',
        'allProdi',
        'dosen',
        'DosenKps',
        'search'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|exists:prodi,id_prodi',
            'nik_kps' => 'required|unique:prodi,nik_kps'
        ]);

        $prodi = Prodi::findOrFail($request->id_prodi);
        
        if ($prodi->nik_kps != null) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Program studi ini sudah memiliki KPS.');
    }

        $prodi->update([
            'nik_kps' => $request->nik_kps
        ]);

        return redirect('/kps')
            ->with('success', 'KPS berhasil ditambahkan');
    }

  public function update(Request $request, $id_prodi)
{
    $request->validate([
        'nik_kps' => 'required|exists:dosen,nik',
        'id_prodi' => 'required|exists:prodi,id_prodi'
    ]);

    $prodiLama = Prodi::findOrFail($id_prodi);

    $nikKps = $request->nik_kps;
    $prodiTujuan = Prodi::findOrFail($request->id_prodi);

    if ($prodiTujuan->nik_kps && $prodiTujuan->nik_kps != $nikKps) {
        return back()->with('error', 'Program studi sudah memiliki KPS');
    }

    $prodiLama->update([
        'nik_kps' => null
    ]);

    $prodiTujuan->update([
        'nik_kps' => $nikKps
    ]);

    return redirect('/kps')
        ->with('success', 'KPS berhasil dipindahkan');
}

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