<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TahunAjaranController;

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
    });
});
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dosen-admin', [DosenController::class, 'index']);
    Route::get('/dosen/create', [DosenController::class, 'create']);
    Route::post('/dosen/store', [DosenController::class, 'store']);
    Route::post('/dosen/edit/{id}', [DosenController::class, 'edit']);
    Route::post('/dosen/update/{id}', [DosenController::class, 'update']);
    Route::get('/dosen/delete/{id}', [DosenController::class, 'delete']);

    Route::get('/kelas', [KelasController::class, 'index']);
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::post('/kelas/update/{id_kelas}', [KelasController::class, 'update']);
    Route::get('/kelas/delete/{id_kelas}', [KelasController::class, 'delete']);

    Route::get('/prodi', [ProdiController::class, 'index']);
    Route::get('/prodi/create', [ProdiController::class, 'create']);
    Route::post('/prodi/store', [ProdiController::class, 'store']);
    Route::get('/prodi/edit/{id}', [ProdiController::class, 'edit']);
    Route::post('/prodi/update/{id}', [ProdiController::class, 'update']);
    Route::get('/prodi/delete/{id}', [ProdiController::class, 'delete']);

    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index']);
});