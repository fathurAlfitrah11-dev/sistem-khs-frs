<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::with('user')->get();
        return view('admin.dosen.index', compact('data'));
    }
    public function create()
    {
        return view('admin.dosen.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosen,nidn',
            'nama_dosen' => 'required',
        ], [
            'nidn.unique' => 'NIDN sudah terdaftar!',
        ]);
        $user = User::create([
            'username' => $request->nidn,
            'name' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'role' => 'dosen'
        ]);
        Dosen::create([
            'nidn' => $request->nidn,
            'nama_dosen' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'user_id' => $user->id
        ]);

        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil ditambahkan');
    }
    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }
    public function update(Request $request, $id)
{
    $dosen = Dosen::findOrFail($id);

    $request->validate([
        'nama_dosen' => 'required',
    ]);

    $dosen->update([
        'nama_dosen' => $request->nama_dosen,
    ]);

    $dosen->user->update([
        'name' => $request->nama_dosen,
    ]);

    return redirect('/dosen-admin')
        ->with('success','Data dosen berhasil diubah');
}
    public function delete($id)
    {
        $dosen = Dosen::findOrFail($id);
        User::where('id', $dosen->user_id)->delete();
        
        $dosen->delete();
        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil dihapus');
    }
}
