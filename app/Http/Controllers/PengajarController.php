<?php

namespace App\Http\Controllers;
use App\Models\Pengajar;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
   public function index(Request $request)
{
    $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

    $idTahun = $request->id_tahun_ajaran
        ?? optional($tahunAktif)->id_tahun_ajaran;

    $search = $request->search;

    $tahunTerpilih = TahunAjaran::find($idTahun);

    $kelas = Kelas::with('prodi')
        ->when($tahunTerpilih, function ($query) use ($tahunTerpilih) {
            if ($tahunTerpilih->semester == 'ganjil') {
                $query->whereRaw('semester % 2 = 1');
            } else {
                $query->whereRaw('semester % 2 = 0');
            }
        })
        ->get();

    $data = Pengajar::with(['dosen', 'mataKuliah', 'tahun', 'kelas.prodi'])
        ->when($idTahun, function ($query) use ($idTahun) {
            $query->where('id_tahun_ajaran', $idTahun);
        })

        ->when($search, function ($query) use ($search) {
            $query->whereHas('dosen.user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhereHas('dosen.user', function ($q) use ($search) {
                $q->where('username', 'like', "%$search%");
            })
            ->orWhereHas('mataKuliah', function ($q) use ($search) {
                $q->where('nama_mk', 'like', "%$search%");
            })
            ->orWhereHas('kelas', function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%$search%");
            });
        })

        ->paginate(10)
        ->withQueryString();

    $dosen = Dosen::with('user')->get();

    $mataKuliah = MataKuliah::query();

    if ($tahunTerpilih) {
        if ($tahunTerpilih->semester == 'ganjil') {
            $mataKuliah->whereRaw('semester % 2 = 1');
        } else {
            $mataKuliah->whereRaw('semester % 2 = 0');
        }
    }

    $mataKuliah = $mataKuliah
    ->orderBy('semester')
    ->orderBy('kode_mk')
    ->get()
    ->groupBy('semester');
    
    $tahunAjaran = TahunAjaran::all();

    return view('admin.pengajar.index', compact(
        'data',
        'dosen',
        'mataKuliah',
        'tahunAjaran',
        'kelas',
        'tahunAktif',
        'idTahun',
        'search'
    ));
}
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|exists:dosen,nik',
            'kode_mk' => 'required|exists:mata_kuliah,kode_mk',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'semester' => 'required|integer|min:1|max:14',
            'kelas_id' => 'required|exists:kelas,id_kelas'
        ],[
            'nik.required' => 'Dosen wajib diisi',
            'kode_mk.required' => 'Kode Mata Kuliah Wajib Diisi',
            'id_tahun_ajaran.required' => 'Tahun Ajaran Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
            'kelas_id.required' => 'Kelas Wajib Diisi'
        ]);
        if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'tambah')
        ->with('open_modal', 'tambah');
    }

        $cek = Pengajar::where('kode_mk', $request->kode_mk)
            ->where('kelas_id', $request->kelas_id)
            ->where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->first();

        if ($cek) {
            return redirect()->back()
            ->withInput()
            ->with('error', 'Mata kuliah pada kelas tersebut sudah memiliki pengajar.');
}
        Pengajar::create([
        'nik' => $request->nik,
        'kode_mk' => $request->kode_mk,
        'kelas_id' => $request->kelas_id,
        'id_tahun_ajaran' => $request->id_tahun_ajaran,
        'semester' => $request->semester,
        ]);

       return redirect('/pengajar?id_tahun_ajaran=' . $request->id_tahun_ajaran)
    ->with('success','Data pengajar berhasil ditambahkan');
    }
    
    public function update(Request $request, $id_pengajar)
    {
        $pengajar = Pengajar::findOrFail($id_pengajar);
         $validator = Validator::make($request->all(), [
            'nik' => 'required|exists:dosen,nik',
            'kode_mk' => 'required|exists:mata_kuliah,kode_mk',
            'id_tahun_ajaran' => 'required|exists:tahun_ajaran,id_tahun_ajaran',
            'semester' => 'required|integer|min:1|max:14',
            'kelas_id' => 'required|exists:kelas,id_kelas'
        ],[
            'nik.required' => 'Dosen wajib diisi',
            'kode_mk.required' => 'Kode Mata Kuliah Wajib Diisi',
            'id_tahun_ajaran.required' => 'Tahun Ajaran Wajib Diisi',
            'semester.required' => 'Semester Wajib Diisi',
            'kelas_id.required' => 'Kelas Wajib Diisi'
        ]);
        if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'edit')
        ->with('open_modal', 'edit');
    }
        $cek = Pengajar::where('kode_mk', $request->kode_mk)
             ->where('kelas_id', $request->kelas_id)
            ->where('id_tahun_ajaran', $request->id_tahun_ajaran)
            ->where('id_pengajar', '!=', $id_pengajar)
            ->first();

        if ($cek) {
            return redirect()->back()
            ->withInput()
            ->with('error', 'Mata kuliah pada kelas tersebut sudah memiliki pengajar.');
}
         $pengajar->update([
    'nik' => $request->nik,
    'kode_mk' => $request->kode_mk,
    'kelas_id' => $request->kelas_id,
    'id_tahun_ajaran' => $request->id_tahun_ajaran,
    'semester' => $request->semester,
]);
        return redirect('/pengajar?id_tahun_ajaran=' . $request->id_tahun_ajaran)
    ->with('success','Data pengajar berhasil diubah');
    }
    public function delete($id_pengajar)
    {        $pengajar = Pengajar::findOrFail($id_pengajar);
        $pengajar->delete();
        return redirect('/pengajar')
            ->with('success','Data pengajar berhasil dihapus');
}
}
