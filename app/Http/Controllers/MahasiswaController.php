<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Mapel;

class MahasiswaController extends Controller
{
    // =========================================================
    // URL ngrok API — ganti sesuai URL aktif
    // =========================================================
    private string $urlNgrok = 'https://empirical-brigade-amusable.ngrok-free.dev';

    /**
     * Helper: buat headers standar untuk request ke ngrok API
     */
    private function apiHeaders(): array
    {
        return [
            'ngrok-skip-browser-warning' => 'true',
            'Accept'                     => 'application/json',
        ];
    }

    // =========================================================
    // 1. DASHBOARD
    // =========================================================
    public function index()
    {
        $user = Auth::user();

        // Ambil data mapel untuk hitung jumlah matkul aktif
        $totalMapel = 0;
        try {
            $res = Http::withHeaders($this->apiHeaders())
                       ->timeout(5)
                       ->get($this->urlNgrok . '/api/mapel');
            if ($res->successful()) {
                $totalMapel = count($res->json()['data'] ?? []);
            }
        } catch (\Exception $e) {
            // API tidak tersedia, tampilkan default
        }

        // Placeholder stats — bisa diganti dengan data real dari DB/API
        $totalSks = 144;
        $ipk      = '3.85';

        return view('mahasiswa.dashboard', compact(
            'user',
            'totalSks',
            'ipk',
            'totalMapel'
        ));
    }

    // =========================================================
    // 2. ABSENSI — Tampil History + Form
    // =========================================================
    public function viewAbsensi()
    {
        // History absensi dari API
        $dataAbsensi = [];
        try {
            $resAbsensi = Http::withHeaders($this->apiHeaders())
                              ->timeout(5)
                              ->get($this->urlNgrok . '/api/absensi');
            $dataAbsensi = $resAbsensi->successful()
                ? ($resAbsensi->json()['data'] ?? [])
                : [];
        } catch (\Exception $e) {
            // Fallback ke DB lokal jika API down
            $mahasiswa = \App\Models\Mahasiswa::where('user_id', Auth::id())->first();
            if ($mahasiswa) {
                $dataAbsensi = Absensi::with('mapel')
                    ->where('mahasiswa_id', $mahasiswa->id)
                    ->orderByDesc('tanggal')
                    ->get()
                    ->map(fn($a) => [
                        'tanggal'   => $a->tanggal,
                        'clock_in'  => $a->clock_in,
                        'clock_out' => $a->clock_out,
                        'status'    => $a->status,
                        'mapel'     => ['nama_mapel' => $a->mapel->nama_mapel ?? '-'],
                    ])
                    ->toArray();
            }
        }

        // List mapel untuk dropdown form clock-in
        $listMapel = [];
        try {
            $resMapel = Http::withHeaders($this->apiHeaders())
                            ->timeout(5)
                            ->get($this->urlNgrok . '/api/mapel');
            $listMapel = $resMapel->successful()
                ? ($resMapel->json()['data'] ?? [])
                : [];
        } catch (\Exception $e) {
            // Fallback ke DB lokal
            $listMapel = Mapel::all()
                ->map(fn($m) => ['id' => $m->id, 'nama_mapel' => $m->nama_mapel])
                ->toArray();
        }

        return view('mahasiswa.absensi', compact('dataAbsensi', 'listMapel'));
    }

    // =========================================================
    // 3. CLOCK-IN & CLOCK-OUT (Smart Logic)
    // =========================================================
    public function clockIn(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required',
        ]);

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', Auth::id())->first();

        if (! $mahasiswa) {
            return redirect()->back()->with('error', 'Data profil mahasiswa belum lengkap!');
        }

        $absenHariIni = Absensi::where('mahasiswa_id', $mahasiswa->id)
                               ->where('mapel_id', $request->mapel_id)
                               ->where('tanggal', now()->format('Y-m-d'))
                               ->first();

        // LOGIC CLOCK-OUT
        if ($absenHariIni) {
            if ($absenHariIni->clock_out === null) {
                $absenHariIni->update([
                    'clock_out' => now()->format('H:i:s'),
                ]);
                return redirect()->back()->with('success', 'Mantap! Berhasil Clock-Out. 🎉');
            }
            return redirect()->back()->with('error', 'Kamu sudah selesai absen untuk matkul ini hari ini!');
        }

        // LOGIC CLOCK-IN
        Absensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'mapel_id'     => $request->mapel_id,
            'tanggal'      => now()->format('Y-m-d'),
            'clock_in'     => now()->format('H:i:s'),
            'status'       => 'hadir',
        ]);

        return redirect()->back()->with('success', 'Berhasil Clock-In! Jangan lupa nanti Clock-Out ya. 🚀');
    }

    // =========================================================
    // 4. JADWAL MAPEL
    // =========================================================
    public function viewMapel()
    {
        $dataMapel = [];
        try {
            $response = Http::withHeaders($this->apiHeaders())
                            ->timeout(5)
                            ->get($this->urlNgrok . '/api/mapel');
            if ($response->successful()) {
                $dataMapel = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
            // Fallback ke DB lokal
            $dataMapel = Mapel::with(['dosen', 'fakultas'])
                ->get()
                ->map(fn($m) => [
                    'id'         => $m->id,
                    'nama_mapel' => $m->nama_mapel,
                    'sks'        => $m->sks,
                    'waktu'      => $m->waktu,
                    'jam_mulai'  => $m->jam_mulai,
                    'jam_selesai'=> $m->jam_selesai,
                    'dosen'      => ['nama_dosen' => $m->dosen->nama_dosen ?? 'Belum ada'],
                    'fakultas'   => ['nama_fakultas' => $m->fakultas->nama_fakultas ?? '-'],
                ])
                ->toArray();
        }

        return view('mahasiswa.mapel', compact('dataMapel'));
    }

    // =========================================================
    // 5. INFO KEUANGAN
    // =========================================================
    public function viewKeuangan()
    {
        $dataKeuangan = [];
        try {
            $response = Http::withHeaders($this->apiHeaders())
                            ->timeout(5)
                            ->get($this->urlNgrok . '/api/keuangan');
            if ($response->successful()) {
                $dataKeuangan = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
            // Fallback ke DB lokal
            $mahasiswa = \App\Models\Mahasiswa::where('user_id', Auth::id())->first();
            if ($mahasiswa) {
                $dataKeuangan = \App\Models\Keuangan::where('mahasiswa_id', $mahasiswa->id)
                    ->orderByDesc('tanggal')
                    ->get()
                    ->map(fn($k) => [
                        'tanggal'     => $k->tanggal,
                        'jumlah'      => $k->jumlah,
                        'status'      => $k->status,
                        'keterangan'  => $k->keterangan ?? null,
                    ])
                    ->toArray();
            }
        }

        return view('mahasiswa.keuangan', compact('dataKeuangan'));
    }
}
