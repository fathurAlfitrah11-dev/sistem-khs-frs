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
        ->whereNotNull('nik_wali')
        ->get();
        $allKelas = Kelas::with('prodi')->get();
        $dosen = Dosen::with('user')->get();
        $dosenWali = Kelas::whereNotNull('nik_wali')
    ->pluck('nik_wali')
    ->toArray();

return view('admin.dosen-wali.index', compact('kelasWali', 'allKelas', 'dosen', 'dosenWali'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'nik_wali' => 'required|unique:kelas,nik_wali'
        ], [
            'nik_wali.unique' => 'Dosen sudah menjadi wali kelas'
        ]);

        $kelas = Kelas::findOrFail($request->id_kelas);
        if($kelas->nik_wali !=null){
            return redirect()->back()
            ->withInput()
            ->with('error', 'Kelas ini sudah memiliki dosen wali.');
        }

        $kelas->update([
            'nik_wali' => $request->nik_wali
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil ditambahkan');
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'nik_wali' => 'required|unique:kelas,nik_wali,'.$id_kelas.',id_kelas'
        ]);

        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
            'nik_wali' => $request->nik_wali
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil diupdate');
    }

    public function delete($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);

        $kelas->update([
            'nik_wali' => null
        ]);

        return redirect('/dosen-wali')
            ->with('success','Dosen wali berhasil dihapus');
    }
}