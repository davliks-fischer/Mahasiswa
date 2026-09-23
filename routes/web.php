<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ActivityLogController; // <-- baru

// Route Login
Route::get('/', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// ROLE: MAHASISWA
// ==========================================
Route::prefix('mahasiswa')->middleware(['auth'])->group(function () {
Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
Route::get('/absensi', [MahasiswaController::class, 'viewAbsensi'])->name('mahasiswa.absensi');
Route::post('/absensi/clock-in', [MahasiswaController::class, 'clockIn']);
Route::get('/keuangan', [MahasiswaController::class, 'viewKeuangan']);
Route::get('/mapel', [MahasiswaController::class, 'viewMapel']);
});

// ==========================================
// ROLE: SUPER ADMIN
// ==========================================
Route::prefix('admin')->middleware(['auth', 'log.admin'])->group(function () { // <-- tambah 'log.admin'
// Menampilkan Dashboard Super Admin
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// Menampilkan Halaman Kelola Data Mahasiswa
Route::get('/kelola-mahasiswa', [AdminController::class, 'kelolaMahasiswa'])->name('admin.mahasiswa');
// Menampilkan Halaman Kelola Dosen & Mapel
Route::get('/kelola-dosen-mapel', [AdminController::class, 'kelolaDosenMapel'])->name('admin.dosen_mapel');
// Menampilkan Halaman Kelola Keuangan
Route::get('/kelola-keuangan', [AdminController::class, 'kelolaKeuangan'])->name('admin.keuangan');
// Menampilkan Halaman Rekap Absensi Mahasiswa
Route::get('/kelola-absensi', [AdminController::class, 'kelolaAbsensi'])->name('admin.absensi');
// CRUD DOSEN & MAPEL
Route::post('/dosen/store', [AdminController::class, 'storeDosen'])->name('admin.dosen.store'); // <-- ditambah name
Route::post('/mapel/store', [AdminController::class, 'storeMapel'])->name('admin.mapel.store'); // <-- ditambah name
Route::post('/dosen/{id}/update', [AdminController::class, 'updateDosen'])->name('admin.dosen.update'); // <-- ditambah name
Route::post('/mapel/{id}/plot', [AdminController::class, 'plotMapel'])->name('admin.mapel.plot'); // <-- ditambah name

// Log Aktivitas (baru)
Route::get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('admin.log_aktivitas');

// Rute API internal / POST untuk simpan data (Nanti kepake pas lu bikin fungsi nambah data)
// Route::post('/kelola-mahasiswa/store', [AdminController::class, 'storeMahasiswa'])->name('admin.mahasiswa.store');
});
// ==========================================
// ROLE: DOSEN
// ==========================================
Route::prefix('dosen')->middleware(['auth'])->group(function () {
Route::get('/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
Route::get('/jadwal-ngajar', [DosenController::class, 'jadwal']);
});