<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;
class TahunAjaranController extends Controller
{
    public function index()
    {
        $data = TahunAjaran::all();
        return view('admin.tahun-ajaran.index', compact('data'));
    }
     public function store(Request $request)
    {
    $request->validate([
    'tahun_awal' => 'required',
    'tahun_akhir' => 'required',
    'semester' => 'required|in:ganjil,genap',
    ]);
    
    $cek = TahunAjaran::where('tahun_awal', $request->tahun_awal)
        ->where('tahun_akhir', $request->tahun_akhir)
        ->where('semester', $request->semester)
        ->first();

    if ($cek) {
        return redirect('/tahun-ajaran')
            ->with('error', 'Tahun ajaran sudah ada');
    }

    TahunAjaran::query()->update(['status' => 0]);

    TahunAjaran::create([
        'tahun_awal' => $request->tahun_awal,
        'tahun_akhir' => $request->tahun_akhir,
        'semester' => $request->semester,
        'status' => 1
    ]);

        return redirect('/tahun-ajaran')
            ->with('success','Data tahun ajaran berhasil ditambahkan');
    }
    
    public function update(Request $request, $id_tahun_ajaran)
{
    $tahun_ajaran = TahunAjaran::findOrFail($id_tahun_ajaran);

    $request->validate([
        'tahun_awal' => 'required',
        'tahun_akhir' => 'required',
        'semester' => 'required|in:ganjil,genap',
    ]);

    $tahun_ajaran->update([
        'tahun_awal' => $request->tahun_awal,
        'tahun_akhir' => $request->tahun_akhir,
        'semester' => $request->semester,
    ]);

    return redirect('/tahun-ajaran')
        ->with('success','Data tahun ajaran berhasil diupdate');
}

public function setActive($id_tahun_ajaran)
{
    TahunAjaran::query()->update(['status' => 0]);

    $tahun = TahunAjaran::findOrFail($id_tahun_ajaran);
    $tahun->status = 1;
    $tahun->save();

    return redirect('/tahun-ajaran')
        ->with('success', 'Tahun ajaran berhasil diaktifkan');
}

    public function delete($id_tahun_ajaran)
    {
        $tahun_ajaran = TahunAjaran::findOrFail($id_tahun_ajaran);
        $tahun_ajaran->delete();
        return redirect('/tahun-ajaran')
            ->with('success','Data tahun ajaran berhasil dihapus');
}
}
