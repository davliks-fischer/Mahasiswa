<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Mapel;
use App\Models\Keuangan;
use App\Models\Absensi; 

class AdminController extends Controller
{
    // Sesuai route: Route::get('/dashboard', [AdminController::class, 'index'])
    // Sesuai route: Route::get('/dashboard', [AdminController::class, 'index'])
    public function index()
    {
        $user = Auth::user();
        
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalMapel = Mapel::count();

        // LOGIC BARU: Hitung total mahasiswa hadir hari ini
        $totalHadirHariIni = \App\Models\Absensi::where('tanggal', now()->format('Y-m-d'))
                                    ->whereNotNull('clock_in')
                                    ->distinct('mahasiswa_id')
                                    ->count('mahasiswa_id');

        return view('admin.dashboard', compact('user', 'totalMahasiswa', 'totalDosen', 'totalMapel', 'totalHadirHariIni'));
    }

    // Sesuai route: Route::get('/kelola-mahasiswa', [AdminController::class, 'kelolaMahasiswa'])
    public function kelolaMahasiswa()
    {
        // Narik data mahasiswa beserta relasi nama fakultas dan data akun (username)
        $dataMahasiswa = Mahasiswa::with(['fakultas', 'user'])->get();
        
        return view('admin.kelola_mahasiswa', compact('dataMahasiswa'));
    }

    // FUNGSI KELOLA DOSEN & MAPEL
    public function kelolaDosenMapel()
    {
        $dataDosen = Dosen::all();
        $dataMapel = Mapel::with(['dosen', 'fakultas'])->get();
        
        return view('admin.kelola_dosen_mapel', compact('dataDosen', 'dataMapel'));
    }

    // FUNGSI KELOLA KEUANGAN
    public function kelolaKeuangan()
    {
        // Tarik data keuangan sekalian bawa data nama mahasiswanya
        $dataKeuangan = Keuangan::with('mahasiswa')->get();
        
        return view('admin.kelola_keuangan', compact('dataKeuangan'));
    }
    // FUNGSI KELOLA REKAP ABSENSI
    public function kelolaAbsensi()
    {
        // Tarik data absensi, sekalian relasi ke mahasiswa dan mapelnya
        $dataAbsensi = Absensi::with(['mahasiswa', 'mapel'])
                              ->orderBy('tanggal', 'desc') // Urutin dari yang terbaru
                              ->get();
        
        return view('admin.kelola_absensi', compact('dataAbsensi'));
    }
    // ==========================================
    // FUNGSI AKSI CRUD DOSEN & MAPEL
    // ==========================================

    // 1. Simpan Dosen Baru
    public function storeDosen(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255'
        ]);

        Dosen::create([
            'nama_dosen' => $request->nama_dosen
        ]);

        return redirect()->back()->with('success', 'Data Dosen berhasil ditambahkan ke sistem!');
    }

    // 2. Simpan Mapel Baru
    public function storeMapel(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'sks' => 'required|integer',
            'waktu' => 'required|string'
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'sks' => $request->sks,
            'waktu' => $request->waktu
            // dosen_id dibiarin kosong dulu, nanti di-plot
        ]);

        return redirect()->back()->with('success', 'Mata Kuliah baru berhasil didaftarkan!');
    }

    // 3. Aksi Plotting (Jodohin Mapel sama Dosen)
    public function plotMapel(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required'
        ]);

        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'dosen_id' => $request->dosen_id
        ]);

        return redirect()->back()->with('success', 'Dosen pengampu berhasil di-plot ke Mata Kuliah!');
    }
    // Fungsi Edit Dosen
    public function updateDosen(Request $request, $id)
    {
        $request->validate([
            'nama_dosen' => 'required|string|max:255'
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update([
            'nama_dosen' => $request->nama_dosen
        ]);

        return redirect()->back()->with('success', 'Data Dosen berhasil diperbarui!');
    }
}