<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\DosenWaliController;
use App\Http\Controllers\MahasiswaRealController;
use App\Http\Controllers\MatakuliahMahasiswaController;
use App\Http\Controllers\KrsMahasiswaController;
use App\Http\Controllers\KhsMahasiswaController;
use App\Http\Controllers\DosenRealController;
use App\Http\Controllers\DosenWaliKrsController;
use App\Http\Controllers\PenilaianDosenController;
use App\Http\Controllers\DosenWaliLihatKrsController;

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/logout', [AuthController::class, 'logout']);

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dosen-admin', [DosenController::class, 'index']);
    Route::get('/dosen/create', [DosenController::class, 'create']);
    Route::post('/dosen/store', [DosenController::class, 'store']);
    Route::post('/dosen/edit/{id}', [DosenController::class, 'edit']);
    Route::post('/dosen/update/{id}', [DosenController::class, 'update']);
    Route::get('/dosen/delete/{id}', [DosenController::class, 'delete']);

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::post('/kelas/update/{id_kelas}', [KelasController::class, 'update']);
    Route::get('/kelas/delete/{id_kelas}', [KelasController::class, 'delete']);

    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi');
    Route::get('/prodi/create', [ProdiController::class, 'create']);
    Route::post('/prodi/store', [ProdiController::class, 'store']);
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit']);
    Route::post('/prodi/update/{id}', [ProdiController::class, 'update']);
    Route::get('/prodi/delete/{id}', [ProdiController::class, 'delete']);

    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran');
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah');
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/pengajar', [PengajarController::class, 'index']);
    Route::get('/dosen-wali', [DosenWaliController::class, 'index']);
});
//MAHASISWA
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa-real', function () {
        return view('mahasiswa.dashboard');
    });
});
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
Route::get('/mahasiswa-real', [MahasiswaRealController::class, 'index']);

Route::get('/matakuliahmahasiswa', [MatakuliahMahasiswaController::class, 'index']);

Route::get('/krsmahasiswa', [KrsMahasiswaController::class, 'index']);

Route::get('/khsmahasiswa', [KhsMahasiswaController::class, 'index']);
});

// DOSEN
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [DosenRealController::class, 'index']);
    Route::get('/perwalian', [DosenWaliKrsController::class, 'index']);
    Route::get('/penilaian', [PenilaianDosenController::class, 'index']);
    Route::get('/lihatkrs', [DosenWaliLihatKrsController::class, 'index']);
});