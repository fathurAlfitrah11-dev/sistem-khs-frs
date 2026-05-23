<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Prodi;
class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::with('kelas', 'prodi')->get();
        $kelas = Kelas::all();
        $prodi = Prodi::all();
        return view('admin.mahasiswa.index', compact('data', 'kelas', 'prodi'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
        'nim' => 'required|unique:mahasiswa,nim',
        'nama' => 'required',
        'id_kelas' => 'required',
        'id_prodi' => 'required',
        'angkatan' => 'required'
    ], [
        'nim.unique' => 'NIM sudah terdaftar!'
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
            'password' => bcrypt($request->password),
            'id_kelas' => $request->id_kelas,
            'id_prodi' => $request->id_prodi
        ]);

        return redirect('/mahasiswa')
            ->with('success','Data mahasiswa berhasil ditambahkan');
    }

    public function update(Request $request, $id_mahasiswa)
    {
        $mhs = Mahasiswa::findOrFail($id_mahasiswa);
        $mhs->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'id_prodi' => $request->id_prodi,
            'angkatan' => $request->angkatan,
        ]);

        return redirect('/mahasiswa')
            ->with('success','Data mahasiswa berhasil diupdate');
    }

    public function delete($id_mahasiswa)
    {
        $mhs = Mahasiswa::findOrFail($id_mahasiswa);

        User::where('id', $mhs->user_id)->delete();
        
        $mhs->delete();

        return redirect('/mahasiswa')
            ->with('success','Data mahasiswa berhasil dihapus');
    }
}
