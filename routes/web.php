<?php

use Illuminate\Support\Facades\Route;

// AUTH
use App\Http\Controllers\AuthController;

// ADMIN
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\DosenWaliController;
use App\Http\Controllers\DosenPartTimeController;
use App\Http\Controllers\LaboranController;
use App\Http\Controllers\KpsController;

// MAHASISWA
use App\Http\Controllers\MahasiswaRealController;
use App\Http\Controllers\MatakuliahMahasiswaController;
use App\Http\Controllers\KrsMahasiswaController;
use App\Http\Controllers\KhsMahasiswaController;
use App\Http\Controllers\PengaturanAkunMahasiswaController;

// DOSEN
use App\Http\Controllers\DosenRealController;
use App\Http\Controllers\DosenWaliKrsController;
use App\Http\Controllers\DosenWaliLihatKrsController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\KpsPenguncianController;
use App\Http\Controllers\PerwalianController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| ADMIN ROLE ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // DOSEN
    Route::get('/dosen-admin', [DosenController::class, 'index']);
    Route::post('/dosen/store', [DosenController::class, 'store']);
    Route::post('/dosen/edit/{nik}', [DosenController::class, 'edit']);
    Route::post('/dosen/update/{nik}', [DosenController::class, 'update']);
    Route::get('/dosen/delete/{nik}', [DosenController::class, 'delete']);

    // KELAS
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id_kelas}', [KelasController::class, 'edit']);
    Route::post('/kelas/update/{id_kelas}', [KelasController::class, 'update']);
    Route::get('/kelas/delete/{id_kelas}', [KelasController::class, 'delete']);

    // PRODI
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi');
    Route::post('/prodi/store', [ProdiController::class, 'store']);
    Route::post('/prodi/update/{id_prodi}', [ProdiController::class, 'update']);
    Route::get('/prodi/delete/{id_prodi}', [ProdiController::class, 'delete']);

    // TAHUN AJARAN
    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('tahun-ajaran');
    Route::post('/tahun-ajaran/store', [TahunAjaranController::class, 'store']);
    Route::post('/tahun-ajaran/update/{id_tahun_ajaran}', [TahunAjaranController::class, 'update']);
    Route::get('/tahun-ajaran/status/{id}', [TahunAjaranController::class, 'toggleStatus']);
    Route::get('/tahun-ajaran/delete/{id_tahun_ajaran}', [TahunAjaranController::class, 'delete']);

    // MATA KULIAH
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mata-kuliah');
    Route::post('/mata-kuliah/store', [MataKuliahController::class, 'store']);
    Route::put('/mata-kuliah/update/{kode_mk}', [MataKuliahController::class, 'update']); 
    Route::get('/mata-kuliah/delete/{kode_mk}', [MataKuliahController::class, 'delete']);

    // MAHASISWA ADMIN SIDE
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
    Route::post('/mahasiswa/update/{nim}', [MahasiswaController::class, 'update']);
    Route::get('/mahasiswa/delete/{nim}', [MahasiswaController::class, 'delete']);

    // PENGAJAR
    Route::get('/pengajar', [PengajarController::class, 'index']);
    Route::post('/pengajar/store', [PengajarController::class, 'store']);
    Route::post('/pengajar/update/{id_pengajar}', [PengajarController::class, 'update']);
    Route::get('/pengajar/delete/{id_pengajar}', [PengajarController::class, 'delete']);

    // DOSEN WALI (MANAJEMEN OLEH ADMIN)
    Route::get('/dosen-wali', [DosenWaliController::class, 'index']);
    Route::post('/dosen-wali/store', [DosenWaliController::class, 'store']);
    Route::post('/dosen-wali/update/{id_kelas}', [DosenWaliController::class, 'update']);
    Route::get('/dosen-wali/delete/{id_kelas}', [DosenWaliController::class, 'delete']);

    // DOSEN PART TIME
    Route::get('/dosen-part-time', [DosenPartTimeController::class, 'index']);
    Route::post('/dosen_part_time/store', [DosenPartTimeController::class, 'store']);
    Route::post('/dosen_part_time/edit/{id_dosen_part_time}', [DosenPartTimeController::class, 'edit']);
    Route::post('/dosen_part_time/update/{id_dosen_part_time}', [DosenPartTimeController::class, 'update']);
    Route::get('/dosen_part_time/delete/{id_dosen_part_time}', [DosenPartTimeController::class, 'delete']);

    // LABORAN
    Route::get('/laboran', [LaboranController::class, 'index']);
    Route::post('/laboran/store', [LaboranController::class, 'store']);
    Route::post('/laboran/update/{id_laboran}', [LaboranController::class, 'update']);
    Route::get('/laboran/delete/{id_laboran}', [LaboranController::class, 'delete']);

    // KPS MANAGEMENT SIDE
    Route::get('/kps', [KpsController::class, 'index']);
    Route::post('/kps/store', [KpsController::class, 'store']);
    Route::post('/kps/update/{id_prodi}', [KpsController::class, 'update']);
    Route::get('/kps/delete/{id_prodi}', [KpsController::class, 'delete']);
}); // Kunci Penutup Grup Admin Berakhir di Sini

/*
|--------------------------------------------------------------------------
| MAHASISWA ROLE ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa-real', [MahasiswaRealController::class, 'index']);
    Route::get('/matakuliahmahasiswa', [MatakuliahMahasiswaController::class, 'index']);
    Route::get('/krsmahasiswa', [KrsMahasiswaController::class, 'index']);
    Route::post('/mahasiswa/tambah-krs/{id}', [MatakuliahMahasiswaController::class, 'tambahKrs']);
    Route::delete('/mahasiswa/krs/hapus/{id}', [KrsMahasiswaController::class, 'hapusmatkul']);
    Route::get('/khsmahasiswa', [KhsMahasiswaController::class, 'index']);
    Route::get('/PengaturanAkunMahasiswa', [PengaturanAkunMahasiswaController::class, 'index']);
    Route::get('/khsmahasiswa/cetak', [KhsMahasiswaController::class, 'cetakPdf'])->name('khs.cetak');
    Route::get('/khsmahasiswa', [KhsMahasiswaController::class, 'index'])->name('khs.index');  
});

/*
|--------------------------------------------------------------------------
| DOSEN ROLE ONLY (TERMASUK DOSEN WALI & KPS)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', [DosenRealController::class, 'index']);

    Route::get('/perwalian', [PerwalianController::class, 'index'])->name('perwalian.index');
    Route::get('/perwalian/detail/{id_krs}', [PerwalianController::class, 'detail'])->name('perwalian.detail');
    Route::post('/dosen/wali/krs/proses', [PerwalianController::class, 'proses']);

    // Penilaian Nilai Kuliah
    Route::get('/penilaian', [PenilaianController::class, 'index']);
    Route::post('/penilaian/simpan', [PenilaianController::class, 'simpan']);

    // Validasi Penguncian Nilai oleh KPS
    Route::get('/kps-penguncian', [KpsPenguncianController::class, 'index']);
    Route::get('/kps-penilaian',[KpsPenguncianController::class,'index']);
   Route::post(
    '/kps-penilaian/simpan',
    [KpsPenguncianController::class,'simpan']
);

Route::get(
    '/kps-penilaian/{kode_mk}',
    [KpsPenguncianController::class,'update']
);

Route::get(
    '/kps-penilaian/kunci/{kode_mk}',
    [KpsPenguncianController::class,'kunci']
);

Route::get(
    '/kps-penilaian/buka/{kode_mk}',
    [KpsPenguncianController::class,'bukaKunci']
);
});