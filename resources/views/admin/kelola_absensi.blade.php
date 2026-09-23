<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi - Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-grid {
            background-image: linear-gradient(rgba(16, 185, 129, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid">

    <!-- NAVBAR -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-emerald-500 shadow-[0_0_20px_rgba(16,185,129,0.4)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(16,185,129,1)]"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-400">
                    SISTEM REKAP ABSENSI
                </h1>
            </div>
            <a href="/admin/dashboard" class="px-4 py-2 bg-gray-900 border border-emerald-500 text-emerald-400 hover:bg-emerald-500 hover:text-gray-900 rounded transition-all shadow-[0_0_10px_rgba(16,185,129,0.3)] font-bold">
                &larr; KEMBALI
            </a>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="max-w-7xl mx-auto p-6 mt-8">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-emerald-300 drop-shadow-[0_0_8px_rgba(16,185,129,0.5)]">Log Aktivitas Mahasiswa</h2>
                <p class="text-emerald-200/60 mt-2">Monitor jam masuk dan pulang dari seluruh fakultas.</p>
            </div>
            <button class="px-6 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold rounded shadow-[0_0_15px_rgba(16,185,129,0.6)]">
                EXPORT DATA CSV
            </button>
        </div>

        <!-- TABEL DATA -->
        <div class="bg-gray-900 border border-emerald-600/30 rounded-xl overflow-hidden shadow-[0_0_30px_rgba(16,185,129,0.15)] relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-950 border-b border-emerald-800 text-emerald-400 text-sm uppercase">
                        <tr>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Nama Mahasiswa</th>
                            <th class="p-4">Mata Kuliah</th>
                            <th class="p-4 text-center">Waktu Masuk</th>
                            <th class="p-4 text-center">Waktu Keluar</th>
                            <th class="p-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataAbsensi as $absen)
                        <tr class="border-b border-gray-800 hover:bg-emerald-900/20 transition-colors">
                            <td class="p-4 text-gray-400 font-mono">{{ $absen->tanggal }}</td>
                            <td class="p-4 text-gray-200 font-bold">{{ $absen->mahasiswa->nama ?? 'Unknown' }}</td>
                            <td class="p-4 text-emerald-300">{{ $absen->mapel->nama_mapel ?? '-' }}</td>
                            <td class="p-4 text-center text-cyan-400 font-bold font-mono">{{ $absen->clock_in }}</td>
                            <td class="p-4 text-center text-purple-400 font-bold font-mono">{{ $absen->clock_out ?? '--:--:--' }}</td>
                            <td class="p-4 text-center">
                                @if($absen->status == 'hadir')
                                    <span class="px-3 py-1 border border-emerald-500 text-emerald-400 bg-emerald-500/10 rounded-full text-xs shadow-[0_0_10px_rgba(16,185,129,0.3)]">HADIR</span>
                                @else
                                    <span class="px-3 py-1 border border-red-500 text-red-400 bg-red-500/10 rounded-full text-xs shadow-[0_0_10px_rgba(239,68,68,0.3)] uppercase">{{ $absen->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 font-mono">>> BELUM ADA LOG ABSENSI <<</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>