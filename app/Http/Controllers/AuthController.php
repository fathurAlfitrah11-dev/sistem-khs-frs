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
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ], [
        'username.required' => 'Username belum diisi',
        'password.required' => 'Password belum diisi',
    ]);

    $user = User::where('username', $request->username)->first();

if (!$user) {
    return back()
        ->withInput()
        ->with('login_error', 'Username tidak ditemukan');
}

if (!Hash::check($request->password, $user->password)) {
    return back()
        ->withInput()
        ->with('login_error', 'Password salah');
}

    Auth::login($user);

    if ($user->role == 'admin') {
        return redirect('/admin')
            ->with('login_success', 'Login berhasil sebagai Admin');
    } elseif ($user->role == 'mahasiswa') {
        return redirect('/mahasiswa-real')
            ->with('login_success', 'Login berhasil sebagai Mahasiswa');
    } elseif (
        $user->role == 'dosen') {
        return redirect('/dosen')
            ->with('login_success', 'Login berhasil sebagai Dosen');
    }
}
  public function logout()
{
    Auth::logout();
    return redirect('/login')->with('logout','Logout berhasil');
}
}