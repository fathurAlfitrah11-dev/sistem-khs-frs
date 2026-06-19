<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;
class TahunAjaranController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $data = TahunAjaran::when($search, function ($query) use ($search) {
            $query->where('tahun_awal', 'like', "%$search%")
                  ->orWhere('tahun_akhir', 'like', "%$search%")
                  ->orWhere('semester', 'like', "%$search%")
                  ->orWhereRaw("CONCAT(tahun_awal,'/',tahun_akhir) LIKE ?", ["%$search%"]);
        })
        ->orderBy('id_tahun_ajaran', 'desc')
        ->paginate(10)
        ->appends($request->query());

    return view('admin.tahun-ajaran.index', compact('data', 'search'));
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

    TahunAjaran::query()->update(['status' => 'non-aktif']);

    TahunAjaran::create([
        'tahun_awal' => $request->tahun_awal,
        'tahun_akhir' => $request->tahun_akhir,
        'semester' => $request->semester,
        'status' => 'aktif',
        'deadline_input_nilai' => $request->deadline_input_nilai
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
    $cek = TahunAjaran::where('tahun_awal', $request->tahun_awal)
        ->where('tahun_akhir', $request->tahun_akhir)
        ->where('semester', $request->semester)
        ->where('id_tahun_ajaran', '!=', $id_tahun_ajaran)
        ->first();
    if ($cek) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Tahun ajaran dengan tahun awal, tahun akhir, dan semester tersebut sudah ada.');
    }
    $tahun_ajaran->update([
        'tahun_awal' => $request->tahun_awal,
        'tahun_akhir' => $request->tahun_akhir,
        'semester' => $request->semester,
        'deadline_input_nilai' => $request->deadline_input_nilai
    ]);

    return redirect('/tahun-ajaran')
        ->with('success','Data tahun ajaran berhasil diupdate');
}

public function setActive($id_tahun_ajaran)
{
    TahunAjaran::query()->update(['status' => 'non-aktif']);

    $tahun = TahunAjaran::findOrFail($id_tahun_ajaran);
    $tahun->status = 'aktif';
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
public function toggleStatus($id)
{
    $tahun = TahunAjaran::findOrFail($id);

    // kalau mau hanya 1 tahun ajaran aktif
    if ($tahun->status == 'non-aktif') {

        // nonaktifkan semua dulu
        TahunAjaran::query()->update([
            'status' => 'non-aktif'
        ]);

        // aktifkan yang dipilih
        $tahun->status = 'aktif';

    } else {

        // kalau sudah aktif → jadi nonaktif
        $tahun->status = 'non-aktif';
    }

    $tahun->save();

    return redirect()->back()
        ->with('success', 'Status berhasil diubah');
}

}
