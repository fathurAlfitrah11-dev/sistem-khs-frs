<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjaran;
class MahasiswaController extends Controller
{   
    public function index(Request $request)
{
    $query = Mahasiswa::with('kelas.prodi', 'prodi');

    if ($request->prodi) {
        $query->where('id_prodi', $request->prodi);
    }

    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('nim', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%")
              ->orWhere('angkatan', 'like', "%{$search}%")

              ->orWhereHas('kelas', function ($k) use ($search) {
                  $k->where('nama_kelas', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(semester, nama_kelas) LIKE ?", ["%{$search}%"]);
              })

              // prodi
              ->orWhereHas('prodi', function ($p) use ($search) {
                  $p->where('nama_prodi', 'like', "%{$search}%");
              });

        });
    }

    $data = $query->orderBy('nim', 'desc')
                  ->paginate(10)
                  ->appends($request->query());

    $kelas = Kelas::with('prodi')->get();
    $prodi = Prodi::all();
    // ambil tahun ajaran aktif
$tahunAktif = TahunAjaran::where('status', 'aktif')->first();

// default genap kalau tidak ada data
$semesterAktif = $tahunAktif?->semester ?? 'genap';

// filter kelas berdasarkan semester ganjil/genap
$kelasQuery = Kelas::with('prodi');

if ($semesterAktif == 'ganjil') {
    // 1,3,5,7
    $kelasQuery->whereRaw('MOD(semester,2) = 1');
} else {
    // 2,4,6,8
    $kelasQuery->whereRaw('MOD(semester,2) = 0');
}

$kelas = $kelasQuery->get();

    return view('admin.mahasiswa.index', compact('data', 'kelas', 'prodi'));
}
   
    public function store(Request $request)
    {
        if (Mahasiswa::where('nim', $request->nim)->exists()) {
            return back()->with('error', 'NIM sudah terdaftar!');
        }

        $request->validate([
        'nim' => 'required|unique:mahasiswa,nim',
        'nama' => 'required',
        'id_kelas' => 'required',
        'id_prodi' => 'required',
        'angkatan' => 'required',
        'password' => 'required|min:6',
    ], [
        'nim.unique' => 'NIM sudah terdaftar!',
        'nim.required' => 'NIM wajib diisi',
        'nama.required' => 'Nama wajib diisi',
        'id_kelas.required' => 'Kelas wajib diisi',
        'id_prodi.required' => 'Program studi wajib diisi',
        'angkatan.required' => 'Angkatan wajib diisi',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 6 karakter',
    ]);

        $user = User::create([
            'username' => $request->nim,
            'name' => $request->nama,
            'password' => bcrypt($request->password),
            'role' => 'mahasiswa'
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'id_kelas' => $request->id_kelas,
            'id_prodi' => $request->id_prodi
        ]);

        return redirect('/mahasiswa')
            ->with('success','Data mahasiswa berhasil ditambahkan');
    }

    public function update(Request $request, $nim)
    {
        $request->validate([
        'nim' => 'required|unique:mahasiswa,nim,' . $nim . ',nim',
        'nama' => 'required',
        'id_kelas' => 'required',
        'id_prodi' => 'required',
        'angkatan' => 'required'
    ], [
        'nim.unique' => 'NIM sudah terdaftar!',
        'nim.required' => 'NIM wajib diisi',
        'nama.required' => 'Nama wajib diisi',
        'id_kelas.required' => 'Kelas wajib diisi',
        'id_prodi.required' => 'Program studi wajib diisi',
        'angkatan.required' => 'Angkatan wajib diisi',
    ]);

        $mhs = Mahasiswa::findOrFail($nim);

        $mhs->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_prodi' => $request->id_prodi,
            'angkatan' => $request->angkatan,
        ]);

        // kalau password diisi
        if($request->password){

            User::where(
                'id',
                $mhs->user_id
            )->update([
                'password'=>bcrypt($request->password)
            ]);
        }

        return redirect('/mahasiswa')
            ->with(
                'success',
                'Data mahasiswa berhasil diupdate');
    }

    public function delete($nim)
    {
        $mhs = Mahasiswa::findOrFail($nim);

        User::where('id', $mhs->user_id)->delete();
        
        $mhs->delete();

        return redirect('/mahasiswa')
            ->with('success','Data mahasiswa berhasil dihapus');
    }
}
