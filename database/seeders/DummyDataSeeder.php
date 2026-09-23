<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fakultas;
use App\Models\Dosen;
use App\Models\Mapel;
use App\Models\Keuangan;
use App\Models\Mahasiswa;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Bikin Fakultas
        $fakultas = fakultas::create(['nama_fakultas' => 'Ilmu Komputer']);

        // 2. Bikin Dosen
        $dosen = dosen::create(['nama_dosen' => 'Dr. Budi Santoso']);

        // 3. Pastikan ada 1 Mahasiswa (asumsi user_id 3 itu si 'mahasiswa_rajin' dari seeder sebelumnya)
        $mahasiswa = mahasiswa::updateOrCreate(
            ['nim' => '20261001'],
            [
                'user_id' => 3, 
                'fakultas_id' => $fakultas->id, 
                'nama' => 'Mahasiswa Rajin'
            ]
        );

        // 4. Bikin Data Mapel (Jadwal)
        mapel::create([
            'dosen_id' => $dosen->id,
            'fakultas_id' => $fakultas->id,
            'nama_mapel' => 'Pemrograman Web Advanced',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:30:00',
            'sks' => 3,
            'waktu' => 'pagi'
        ]);

        // 5. Bikin Data Keuangan (Tagihan)
        keuangan::create([
            'mahasiswa_id' => $mahasiswa->id,
            'jumlah' => 5500000.00,
            'status' => 'belum',
            'tanggal' => now()->format('Y-m-d')
        ]);
        // ... (kodingan seeder sebelumnya biarin aja)

        // 6. Bikin Data Absensi Dummy
        \App\Models\Absensi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'mapel_id' => 1, // Asumsi Mapel yang dibikin di atas ID-nya 1
            'tanggal' => now()->format('Y-m-d'),
            'clock_in' => '07:50:00',
            'clock_out' => '10:30:00',
            'status' => 'hadir'
        ]);
    }
}