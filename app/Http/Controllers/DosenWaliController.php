<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenWaliController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $kelasWali = Kelas::with(['wali.user', 'prodi'])
        ->whereNotNull('nik_wali')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {

                $q->where('nik_wali', 'like', "%$search%")
                  ->orWhereHas('wali.user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%$search%");
                  })
                  ->orWhereHas('prodi', function ($q3) use ($search) {
                      $q3->where('nama_prodi', 'like', "%$search%");
                  });
            });
        })
        ->paginate(10)
        ->withQueryString();

    $allKelas = Kelas::with('prodi')->get();
    $dosen = Dosen::with('user')->get();

    $dosenWali = Kelas::whereNotNull('nik_wali')
        ->pluck('nik_wali')
        ->toArray();

    return view('admin.dosen-wali.index', compact(
        'kelasWali',
        'allKelas',
        'dosen',
        'dosenWali'
    ));
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
        'nik_wali' => 'required|exists:dosen,nik'
    ]);

    $kelasBaru = Kelas::findOrFail($id_kelas);

    $nikBaru = $request->nik_wali;

    $kelasLama = Kelas::where('nik_wali', $nikBaru)
        ->where('id_kelas', '!=', $id_kelas)
        ->first();

    if ($kelasLama) {
        $kelasLama->update([
            'nik_wali' => null
        ]);
    }

    $kelasBaru->update([
        'nik_wali' => $nikBaru
    ]);

    return redirect('/dosen-wali')
        ->with('success', 'Dosen wali berhasil dipindahkan');
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