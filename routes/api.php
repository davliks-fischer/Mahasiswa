<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendorController; // Pastikan controller di-import

// 1. ENDPOINT GET (Contoh narik jadwal mapel)
// Kalau diakses jadinya: domain-ngrok.com/api/mapel/get
Route::get('/mapel', [VendorController::class, 'getMapel']);
Route::get('/keuangan', [VendorController::class, 'getKeuangan']);
// 2. ENDPOINT POST (Contoh nyimpen data absensi)
// Kalau diakses jadinya: domain-ngrok.com/api/absensi/store
Route::post('/absensi/store', [VendorController::class, 'storeAbsensi']);
Route::get('/absensi', [VendorController::class, 'getAbsensi']);