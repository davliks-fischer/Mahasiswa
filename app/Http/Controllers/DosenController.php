<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Mapel;

class DosenController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Hitung total mahasiswa aktif di sistem
        $totalMahasiswa = Mahasiswa::count();

        // Tarik semua data mapel beserta nama dosen pengampunya
        $dataMapel = Mapel::with('dosen')->get();
        
        // Hitung total mapel aktif
        $totalMapel = $dataMapel->count();

        return view('dosen.dashboard', compact('user', 'totalMahasiswa', 'dataMapel', 'totalMapel'));
    }
    public function jadwal()
    {
        // Nanti lu isi kodingan buat narik jadwal spesifik dosen di sini
        return "Ini halaman jadwal ngajar dosen (Masih tahap development)"; 
    }
}