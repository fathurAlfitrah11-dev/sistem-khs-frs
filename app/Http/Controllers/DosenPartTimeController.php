<?php

namespace App\Http\Controllers;
use App\Models\DosenPartTime;
use App\Models\User;
use Illuminate\Http\Request;

class DosenPartTimeController extends Controller
{
    public function index()
    {
        $data = DosenPartTime::with('user')->get();
        return view('admin.dosen_part_time.index', compact('data'));
    }
    public function create()
    {
        return view('admin.dosen_part_time.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nuptk' => 'required|unique:dosen_part_time,nuptk',
            'nama_dosen' => 'required',
        ], [
            'nuptk.unique' => 'NUPTK sudah terdaftar!',
        ]);
        $user = User::create([
            'username' => $request->nuptk,
            'name' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'role' => 'dosen_part_time'
        ]);
        DosenPartTime::create([
            'nuptk' => $request->nuptk,
            'nama_dosen' => $request->nama_dosen,
            'tempat_part_time' => $request->tempat_part_time,
            'user_id' => $user->id
        ]);

        return redirect('/dosen-part-time')
            ->with('success','Data dosen berhasil ditambahkan');
    }
    public function edit($id_dosen_part_time)
    {
        $dosen = DosenPartTime::findOrFail($id_dosen_part_time);
        return view('admin.dosen_part_time.edit', compact('dosen'));
    }
    public function update(Request $request, $id_dosen_part_time)
{
    $dosen = DosenPartTime::findOrFail($id_dosen_part_time);

    $request->validate([
        'nama_dosen' => 'required',
    ]);

    $dosen->update([
        'nama_dosen' => $request->nama_dosen,
        'tempat_part_time' => $request->tempat_part_time,
    ]);

    $dosen->user->update([
        'name' => $request->nama_dosen,
    ]);

    return redirect('/dosen-part-time')
        ->with('success','Data dosen berhasil diubah');
}
    public function delete($id_dosen_part_time)
    {
        $dosen = DosenPartTime::findOrFail($id_dosen_part_time);
        User::where('id', $dosen->user_id)->delete();
        
        $dosen->delete();
        return redirect('/dosen-part-time')
            ->with('success','Data dosen berhasil dihapus');
    }
}
