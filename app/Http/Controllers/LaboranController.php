<?php

namespace App\Http\Controllers;
use App\Models\Laboran;
use App\Models\User;
use Illuminate\Http\Request;

class LaboranController extends Controller
{
     public function index()
    {
        $data = Laboran::with('user')->get();

        return view('admin.laboran.index', compact('data'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:laboran,nik',
            'nama_laboran' => 'required',
            'kode_laboran' => 'required',
        ], [
            'nik.unique' => 'NIK sudah terdaftar!',
        ]);
        $user = User::create([
            'username' => $request->nik,
            'name' => $request->nama_laboran,
            'password' => bcrypt($request->password),
            'role' => 'laboran'
        ]);
        Laboran::create([
            'nik' => $request->nik,
            'nama_laboran' => $request->nama_laboran,
            'kode_laboran' => $request->kode_laboran,
            'user_id' => $user->id
        ]);

        return redirect('/laboran')
            ->with('success','Data laboran berhasil ditambahkan');
    }
   
public function update(Request $request, $id_laboran)
{
    $laboran = Laboran::findOrFail($id_laboran);

    $request->validate([
        'nama_laboran' => 'required',
        'kode_laboran' => 'required',
    ]);

    $laboran->update([
        'nama_laboran' => $request->nama_laboran,
        'kode_laboran' => $request->kode_laboran,
    ]);

    // data update user
    $userData = [
        'name' => $request->nama_laboran,
    ];

    // kalau password diisi
    if ($request->filled('password')) {
        $userData['password'] = bcrypt($request->password);
    }

    // update user
    $laboran->user->update($userData);

    return redirect('/laboran')
        ->with('success','Data laboran berhasil diubah');
}
    public function delete($id_laboran)
    {
        $laboran = Laboran::findOrFail($id_laboran);
        User::where('id', $laboran->user_id)->delete();
        
        $laboran->delete();
        return redirect('/laboran')
            ->with('success','Data laboran berhasil dihapus');
    }
    }
