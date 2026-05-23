<?php

namespace App\Http\Controllers;
use App\Models\Pengajar;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    public function index(Request $request)
{
    $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

    $idTahun = $request->id_tahun_ajaran 
        ?? optional($tahunAktif)->id_tahun_ajaran;

    $kelas = Kelas::with('prodi')
    ->when($tahunAktif, function ($query) use ($tahunAktif) {

        if ($tahunAktif->semester == 'ganjil') {
            $query->whereRaw('semester % 2 = 1');
        } else {
            $query->whereRaw('semester % 2 = 0');
        }
        })
    ->get();

    $data = Pengajar::with(['dosen', 'mataKuliah', 'tahun', 'kelas'])
        ->when($idTahun, function ($query) use ($idTahun) {
            $query->where('id_tahun_ajaran', $idTahun);
        })
        ->get();

    $dosen = Dosen::with('user')->get();
    $mataKuliah = MataKuliah::all();
    $tahunAjaran = TahunAjaran::all();

    return view('admin.pengajar.index', compact(
        'data',
        'dosen',
        'mataKuliah',
        'tahunAjaran',
        'kelas',
        'tahunAktif',
        'idTahun'
    ));
}
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|exists:dosen,nik',
            'id_mata_kuliah' => 'required|exists:mata_kuliah,id_mata_kuliah',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'semester' => 'required|integer|min:1|max:14',
            'kelas_id' => 'required|exists:kelas,id_kelas'
        ]);

        Pengajar::create([
        'nik' => $request->nik,
        'id_mata_kuliah' => $request->id_mata_kuliah,
        'kelas_id' => $request->kelas_id,
        'id_tahun_ajaran' => $request->id_tahun_ajaran,
        'semester' => $request->semester,
        ]);

        return redirect('/pengajar')
            ->with('success','Data pengajar berhasil ditambahkan');
    }
    
    public function update(Request $request, $id_pengajar)
    {
        $pengajar = Pengajar::findOrFail($id_pengajar);
        $request->validate([
            'nik' => 'required|exists:dosen,nik',
            'id_mata_kuliah' => 'required|exists:mata_kuliah,id_mata_kuliah',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'semester' => 'required|integer|min:1|max:14',
            'kelas_id' => 'required|exists:kelas,id_kelas'
        ]);
        $pengajar->update($request->all());
        return redirect('/pengajar')
            ->with('success','Data pengajar berhasil diupdate');
    }
    public function delete($id_pengajar)
    {        $pengajar = Pengajar::findOrFail($id_pengajar);
        $pengajar->delete();
        return redirect('/pengajar')
            ->with('success','Data pengajar berhasil dihapus');
}
}
