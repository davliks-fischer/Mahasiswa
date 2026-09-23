<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Absensi;

class VendorController extends Controller
{
    // Fungsi untuk nge-GET data (mirip endpoint /api/vendors punya lu)
    // Tambahin ini di dalam VendorController class
    public function getMapel()
    {
        $mapel = \App\Models\Mapel::with(['dosen', 'fakultas'])->get();
        return response()->json(['status' => 'success', 'data' => $mapel]);
    }

    public function getKeuangan()
    {
        $keuangan = \App\Models\Keuangan::with('mahasiswa')->get();
        return response()->json(['status' => 'success', 'data' => $keuangan]);
    }
public function getAbsensi()
    {
        // Narik data absensi sekalian bawa data mapelnya
        $absensi = \App\Models\Absensi::with('mapel')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $absensi
        ]);
    }
    // Fungsi untuk nge-POST data (mirip endpoint /api/playlist/store punya lu)
    public function storeAbsensi(Request $request)
    {
        // Validasi data yang masuk dari POST
        $request->validate([
            'mahasiswa_id' => 'required',
            'mapel_id' => 'required',
            'status' => 'required'
        ]);

        try {
            // Simpan ke database
            $absensi = Absensi::create([
                'mahasiswa_id' => $request->mahasiswa_id,
                'mapel_id' => $request->mapel_id,
                'tanggal' => now()->format('Y-m-d'),
                'clock_in' => now()->format('H:i:s'),
                'status' => $request->status
            ]);

            return response()->json([
                'status' => 'success',
                'pesan' => 'Data absensi berhasil disimpan bro!',
                'data' => $absensi
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'pesan' => $e->getMessage()
            ], 500);
        }
        
    }
}