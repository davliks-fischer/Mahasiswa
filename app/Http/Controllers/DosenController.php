<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use App\Models\Mapel;
use App\Models\Dosen;
use App\Models\Tugas;

class DosenController extends Controller
{
    // ─── DASHBOARD ────────────────────────────────────────────────────────────
    public function index()
    {
        $user = Auth::user();

        $totalMahasiswa = Mahasiswa::count();
        $dataMapel      = Mapel::with('dosen')->get();
        $totalMapel     = $dataMapel->count();

        return view('dosen.dashboard', compact('user', 'totalMahasiswa', 'dataMapel', 'totalMapel'));
    }

    // ─── HALAMAN TUGAS (list) ─────────────────────────────────────────────────
    public function tugas()
    {
        $user   = Auth::user();
        $dosen  = Dosen::where('user_id', $user->id)->first();

        $listTugas = collect();
        $dataMapel = collect();

        if ($dosen) {
            $listTugas = Tugas::where('dosen_id', $dosen->id)
                              ->with('mapel')
                              ->latest()
                              ->get();
            $dataMapel = Mapel::where('dosen_id', $dosen->id)->get();
        }

        return view('dosen.tugas', compact('user', 'dosen', 'listTugas', 'dataMapel'));
    }

    // ─── UPLOAD TUGAS ─────────────────────────────────────────────────────────
    public function uploadTugas(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'nullable|string|max:2000',
            'mapel_id' => 'nullable|exists:mapel,id',
            'deadline' => 'nullable|date',
            'file'     => 'required|file|max:20480|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar,png,jpg,jpeg',
        ], [
            'file.max'   => 'Ukuran file maksimal 20 MB.',
            'file.mimes' => 'Format file tidak didukung.',
        ]);

        $user  = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        if (!$dosen) {
            return back()->with('error', 'Data dosen tidak ditemukan.');
        }

        $file     = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('tugas', 'public');
        $fileSize = $file->getSize();

        Tugas::create([
            'dosen_id'  => $dosen->id,
            'mapel_id'  => $request->mapel_id ?: null,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $fileSize,
            'deadline'  => $request->deadline ?: null,
        ]);

        return back()->with('success', 'Tugas berhasil diupload!');
    }

    // ─── HAPUS TUGAS ──────────────────────────────────────────────────────────
    public function hapusTugas($id)
    {
        $user  = Auth::user();
        $dosen = Dosen::where('user_id', $user->id)->first();

        $tugas = Tugas::where('id', $id)->where('dosen_id', $dosen?->id)->firstOrFail();

        // Hapus file fisik dari storage
        Storage::disk('public')->delete($tugas->file_path);

        $tugas->delete();

        return back()->with('success', 'Tugas berhasil dihapus.');
    }

    // ─── JADWAL ───────────────────────────────────────────────────────────────
    public function jadwal()
    {
        return "Ini halaman jadwal ngajar dosen (Masih tahap development)";
    }
}
