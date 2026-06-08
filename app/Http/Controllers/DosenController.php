<?php

namespace App\Http\Controllers;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
{
    $search = $request->search;

    $data = Dosen::with('user')
        ->when($search, function ($query) use ($search) {
            $query->where('nik', 'like', "%{$search}%")
                  ->orWhere('kode_dosen', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        })
        ->paginate(10);

    return view('admin.dosen.index', compact('data'));
}
   
    public function store(Request $request)
    {
       if (Dosen::where('nik', $request->nik)->exists()) {
        return back()->with('error', 'NIK sudah terdaftar!');
    }

        $user = User::create([
            'username' => $request->nik,
            'name' => $request->nama_dosen,
            'password' => bcrypt($request->password),
            'role' => 'dosen'
        ]);
        Dosen::create([
            'nik' => $request->nik,
            'nama_dosen' => $request->nama_dosen,
            'kode_dosen' => $request->kode_dosen,
            'username' => $user->username,
            'user_id' => $user->id
        ]);

        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil ditambahkan');
    }

public function update(Request $request, $nik)
{
    $dosen = Dosen::findOrFail($nik);

    $request->validate([
        'nama_dosen' => 'required',
        'kode_dosen' => 'required',
    ]);

    $dosen->update([
        'nama_dosen' => $request->nama_dosen,
        'kode_dosen' => $request->kode_dosen,
    ]);

    $userData = [
        'name' => $request->nama_dosen,
    ];

    if ($request->filled('password')) {
        $userData['password'] = bcrypt($request->password);
    }


    $dosen->user->update($userData);

    return redirect('/dosen-admin')
        ->with('success','Data dosen berhasil diubah');
}
    public function delete($nik)
    {
        $dosen = Dosen::findOrFail($nik);
        User::where('username', $dosen->username)->delete();
        
        $dosen->delete();
        return redirect('/dosen-admin')
            ->with('success','Data dosen berhasil dihapus');
    }
}
