<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{   
    public function index(Request $request)
    {
        $search = $request->search;
        $prodiFilter = $request->prodi;
        $angkatanFilter = $request->angkatan; //

        $query = Mahasiswa::select('mahasiswa.*')
            ->join('prodi', 'mahasiswa.id_prodi', '=', 'prodi.id_prodi')
            ->join('kelas', 'mahasiswa.id_kelas', '=', 'kelas.id_kelas')
            ->with('kelas.prodi', 'prodi');

        // Filter Berdasarkan Program Studi
        if ($prodiFilter) {
            $query->where('mahasiswa.id_prodi', $prodiFilter);
        }

        // Filter Berdasarkan Angkatan
        if ($angkatanFilter) {
            $query->where('mahasiswa.angkatan', $angkatanFilter);
        }

        // Fitur Pencarian Kata Kunci
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('mahasiswa.nim', 'like', "%{$search}%")
                  ->orWhere('mahasiswa.nama', 'like', "%{$search}%")
                  ->orWhere('mahasiswa.angkatan', 'like', "%{$search}%")
                  ->orWhere('kelas.nama_kelas', 'like', "%{$search}%")
                  ->orWhere('kelas.kategori', 'like', "%{$search}%")
                  ->orWhere('prodi.nama_prodi', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('prodi.nama_prodi', 'asc')
                      ->orderBy('mahasiswa.angkatan', 'desc') // Angkatan terbaru di atas
                      ->orderBy('kelas.semester', 'asc')
                      ->orderBy('kelas.nama_kelas', 'asc')
                      ->orderBy('mahasiswa.nama', 'asc')
                      ->paginate(10)
                      ->appends($request->query());

        $kelas = Kelas::with('prodi')->get();
        $prodi = Prodi::all();
        
        $listAngkatan = Mahasiswa::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan');
        
        $tahunAktif = TahunAjaran::where('status', 'aktif')->first();

        return view('admin.mahasiswa.index', compact('data', 'kelas', 'prodi', 'listAngkatan', 'tahunAktif'));
    }
   
    public function store(Request $request)
    {
        if (Mahasiswa::where('nim', $request->nim)->exists()) {
            return back()->with('error', 'NIM sudah terdaftar!');
        }

        $validator = Validator::make($request->all(), [
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

    if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'tambah')
        ->with('open_modal', 'tambah');
    }
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
        $validator = Validator::make($request->all(), [
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
        'password.min' => 'Password minimal 6 karakter',
    ]);
     if ($validator->fails()) {
    return redirect()->back()
        ->withInput()
        ->withErrors($validator, 'edit')
        ->with('open_modal', 'edit');
    }
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
                'Data mahasiswa berhasil diubah');
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
