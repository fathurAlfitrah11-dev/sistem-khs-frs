<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenWaliController extends Controller
{
    public function index()
    {
       $kelasWali = Kelas::with(['wali.user', 'prodi'])
        ->whereNotNull('nuptk_wali')
        ->get();
        $allKelas = Kelas::with('prodi')->get();
        $dosen = Dosen::with('user')->get();

return view('admin.dosen-wali.index', compact('kelasWali', 'allKelas', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'nuptk_wali' => 'required|unique:kelas,nuptk_wali'
        ], [
            'nuptk_wali.unique' => 'Dosen sudah menjadi wali kelas'
        ]);

        $kelas = Kelas::findOrFail($request->id_kelas);

        $kelas->update([
            'nuptk_wali' => $request->nuptk_wali
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil ditambahkan');
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nuptk_wali' => 'required|unique:kelas,nuptk_wali,'.$id_kelas.',id_kelas'
        ]);

        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
            'nuptk_wali' => $request->nuptk_wali
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil diupdate');
    }

    public function delete($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
            'nuptk_wali' => null
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil dihapus');
    }
}