<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Mahasiswa;

class PengaturanAkunMahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.PengaturanAkun');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'password_lama' => 'required',
        'password_baru' => 'required|min:6',
        'konfirmasi_password' => 'required|same:password_baru',
    ]);

    $userId = Auth::id();

    $user = User::find($userId);

    if (!$user) {
        return back()->withErrors([
            'error' => 'User tidak ditemukan'
        ]);
    }

    if (!Hash::check($request->password_lama, $user->password)) {
        return back()->withErrors([
            'password_lama' => 'Password lama tidak sesuai'
        ]);
    }

    User::where('id', $userId)->update([
        'password' => Hash::make($request->password_baru)
    ]);

    return back()->with('success', 'Password berhasil diubah');
}
}
