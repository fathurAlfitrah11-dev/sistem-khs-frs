<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $user = User::where('username', $request->username)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error','Login gagal');
    }

    Auth::login($user);

    // redirect + notifikasi
    if ($user->role == 'admin') {
        return redirect('/admin')->with('success','Login berhasil sebagai Admin');
    } elseif ($user->role == 'mahasiswa') {
        return redirect('/mahasiswa-real')->with('success','Login berhasil sebagai Mahasiswa');
    } elseif ($user->role == 'dosen') {
        return redirect('/dosen')->with('success','Login berhasil sebagai Dosen');
    } else {
        return redirect('/dosen-wali')->with('success','Login berhasil sebagai Dosen Wali');
    }
}
    public function logout()
{
    Auth::logout();
    return redirect('/login')->with('success','Logout berhasil');
}
}