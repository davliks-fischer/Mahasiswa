<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;

class MahasiswaController extends Controller
{
    // 1. FUNGSI UNTUK MENAMPILKAN DASHBOARD (Ini yang tadi hilang bro!)
    public function index()
    {
        $user = Auth::user(); 
        return view('mahasiswa.dashboard', compact('user'));
    }

    // 2. FUNGSI UNTUK VIEW ABSENSI
    public function viewAbsensi()
    {
        $urlNgrok = 'https://empirical-brigade-amusable.ngrok-free.dev'; 
        
        // 1. Tarik History Absensi
        $resAbsensi = Http::withHeaders([
            'ngrok-skip-browser-warning' => 'true',
            'Accept' => 'application/json'
        ])->get($urlNgrok . '/api/absensi');
        
        $dataAbsensi = $resAbsensi->successful() ? $resAbsensi->json()['data'] ?? [] : [];

        // 2. Tarik Data Mapel (Buat pilihan di form dropdown)
        $resMapel = Http::withHeaders([
            'ngrok-skip-browser-warning' => 'true',
            'Accept' => 'application/json'
        ])->get($urlNgrok . '/api/mapel');
        
        $listMapel = $resMapel->successful() ? $resMapel->json()['data'] ?? [] : [];

        // Kirim 2 data ini ke view
        return view('mahasiswa.absensi', compact('dataAbsensi', 'listMapel'));
    }

    // 3. FUNGSI CLOCK-IN & CLOCK-OUT ABSENSI (SMART LOGIC)
public function clockIn(Request $request)
{
    $request->validate([
        'mapel_id' => 'required'
    ]);

    // PERBAIKAN ERROR FOREIGN KEY: Cari id mahasiswa berdasarkan user_id yang login
    $mahasiswa = \App\Models\Mahasiswa::where('user_id', Auth::user()->id)->first();

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data profil mahasiswa belum lengkap bro!');
    }

    // Cek apakah mahasiswa ini sudah absen untuk mapel yang dipilih pada hari ini
    $absenHariIni = Absensi::where('mahasiswa_id', $mahasiswa->id)
                           ->where('mapel_id', $request->mapel_id)
                           ->where('tanggal', now()->format('Y-m-d'))
                           ->first();

    // LOGIC CLOCK-OUT
    if ($absenHariIni) {
        if ($absenHariIni->clock_out == null) {
            // Kalau sudah clock-in tapi belum clock-out, update data clock-out nya
            $absenHariIni->update([
                'clock_out' => now()->format('H:i:s')
            ]);
            return redirect()->back()->with('success', 'Mantap! Berhasil Clock-Out.');
        } else {
            // Kalau dua-duanya sudah terisi
            return redirect()->back()->with('error', 'Kamu sudah selesai absen untuk matkul ini hari ini!');
        }
    } 
    // LOGIC CLOCK-IN
    else {
        Absensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'mapel_id' => $request->mapel_id,
            'tanggal' => now()->format('Y-m-d'),
            'clock_in' => now()->format('H:i:s'),
            'status' => 'hadir'
        ]);
        return redirect()->back()->with('success', 'Berhasil Clock-In! Jangan lupa nanti Clock-Out ya.');
    }
}

    // 4. FUNGSI VIEW MAPEL (API FETCH)
    public function viewMapel()
    {
        $urlNgrok = 'https://empirical-brigade-amusable.ngrok-free.dev'; 
        
        $response = Http::withHeaders([
            'ngrok-skip-browser-warning' => 'true',
            'Accept' => 'application/json'
        ])->get($urlNgrok . '/api/mapel'); // <-- Hapus /get di belakang
        
        $dataMapel = [];
        if($response->successful()) {
            $dataMapel = $response->json()['data'] ?? [];
        }

        return view('mahasiswa.mapel', compact('dataMapel'));
    }

    public function viewKeuangan()
    {
        $urlNgrok = 'https://empirical-brigade-amusable.ngrok-free.dev'; 
        
        $response = Http::withHeaders([
            'ngrok-skip-browser-warning' => 'true',
            'Accept' => 'application/json'
        ])->get($urlNgrok . '/api/keuangan'); // <-- Hapus /vendor di tengah
        
        $dataKeuangan = [];
        if($response->successful()) {
            $dataKeuangan = $response->json()['data'] ?? [];
        }

        return view('mahasiswa.keuangan', compact('dataKeuangan'));
    }
}