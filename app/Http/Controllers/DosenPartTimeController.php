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
            'nidk' => 'required|unique:dosen_part_time_,nidk',
            'nama_dosen' => 'required',
        ], [
            'nidk.unique' => 'NIDK sudah terdaftar!',
        ]);
        $user = User::create([
            'username' => $request->nidk,
            'name' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'role' => 'dosen_part_time'
        ]);
        DosenPartTime::create([
            'nidk' => $request->nidk,
            'nama_dosen' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'tempat_part_time' => $request->tempat_part_time,
            'user_id' => $user->id
        ]);

        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dosen = DosenPartTime::findOrFail($id);
        return view('admin.dosen_part_time.edit', compact('dosen'));
    }
    public function update(Request $request, $id)
{
    $dosen = DosenPartTime::findOrFail($id);

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

    return redirect('/dosen-admin')
        ->with('success','Data dosen berhasil diubah');
}
    public function delete($id)
    {
        $dosen = DosenPartTime::findOrFail($id);
        User::where('id', $dosen->user_id)->delete();
        
        $dosen->delete();
        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil dihapus');
    }
}
