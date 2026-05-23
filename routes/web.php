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
use App\Http\Controllers\DosenPartTimeController;
use App\Http\Controllers\PengaturanAkunMahasiswaController;


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
    Route::post('/dosen/edit/{id_dosen}', [DosenController::class, 'edit']);
    Route::post('/dosen/update/{id_dosen}', [DosenController::class, 'update']);
    Route::get('/dosen/delete/{id_dosen}', [DosenController::class, 'delete']);

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::post('/kelas/update/{id_kelas}', [KelasController::class, 'update']);
    Route::get('/kelas/delete/{id_kelas}', [KelasController::class, 'delete']);

    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi');
    Route::post('/prodi/store', [ProdiController::class, 'store']);
    Route::post('/prodi/update/{id_prodi}', [ProdiController::class, 'update']);
    Route::get('/prodi/delete/{id_prodi}', [ProdiController::class, 'delete']);

    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran');
    Route::post('/tahun-ajaran/store', [TahunAjaranController::class, 'store']);
    Route::post('/tahun-ajaran/update/{id_tahun_ajaran}', [TahunAjaranController::class, 'update']);
    Route::get('/tahun-ajaran/status/{id}', [TahunAjaranController::class, 'toggleStatus']);
    Route::get('/tahun-ajaran/delete/{id_tahun_ajaran}', [TahunAjaranController::class, 'delete']);


    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah');
    Route::post('/mata-kuliah/store', [MataKuliahController::class, 'store']);
    Route::post('/mata-kuliah/update/{id_mata_kuliah}', [MataKuliahController::class, 'update']);
    Route::get('/mata-kuliah/delete/{id_mata_kuliah}', [MataKuliahController::class, 'delete']);

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
    Route::post('/mahasiswa/update/{id_mahasiswa}', [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/delete/{id_mahasiswa}', [MahasiswaController::class, 'delete']);

    Route::get('/pengajar', [PengajarController::class, 'index']);
    Route::post('/pengajar/store', [PengajarController::class, 'store']);
    Route::post('/pengajar/update/{id_pengajar}', [PengajarController::class, 'update']);
    Route::get('/pengajar/delete/{id_pengajar}', [PengajarController::class, 'delete']);

    Route::get('/dosen-wali', [DosenWaliController::class, 'index']);
    Route::post('/dosen-wali/store', [DosenWaliController::class, 'store']);
    Route::post('/dosen-wali/update/{id_kelas}', [DosenWaliController::class, 'update']);
    Route::get('/dosen-wali/delete/{id_kelas}', [DosenWaliController::class, 'delete']);

    Route::get('/dosen-part-time', [DosenPartTimeController::class, 'index']);
    Route::post('/dosen_part_time/store', [DosenPartTimeController::class, 'store']);
    Route::post('/dosen_part_time/edit/{id_dosen_part_time}', [DosenPartTimeController::class, 'edit']);
    Route::post('/dosen_part_time/update/{id_dosen_part_time}', [DosenPartTimeController::class, 'update']);
    Route::get('/dosen_part_time/delete/{id_dosen_part_time}', [DosenPartTimeController::class, 'delete']);
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

Route::get('/PengaturanAkunMahasiswa', [PengaturanAkunMahasiswaController::class, 'index']);
});

// DOSEN
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [DosenRealController::class, 'index']);
    Route::get('/perwalian', [DosenWaliKrsController::class, 'index']);
    Route::get('/penilaian', [PenilaianDosenController::class, 'index']);
    Route::get('/lihatkrs', [DosenWaliLihatKrsController::class, 'index']);
});