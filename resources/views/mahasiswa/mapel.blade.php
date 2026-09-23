<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mata Kuliah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen p-8">

    <div class="max-w-4xl mx-auto">
        <a href="/mahasiswa/dashboard" class="text-purple-400 hover:text-purple-300 mb-6 inline-block">&larr; Kembali ke Dashboard</a>
        
        <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-6">
            Jadwal Mata Kuliah 
        </h2>

        <div class="grid gap-6">
            @foreach($dataMapel as $mapel)
            <!-- Card Mapel -->
            <div class="group relative p-6 rounded-xl bg-gray-800 border border-gray-700 hover:border-purple-500 transition-all hover:shadow-[0_0_20px_rgba(168,85,247,0.3)]">
                <h3 class="text-xl font-bold text-white mb-2">{{ $mapel['nama_mapel'] }} ({{ $mapel['sks'] }} SKS)</h3>
                <div class="text-gray-400 text-sm grid grid-cols-2 gap-4">
                    <p>👨‍🏫 Dosen: <span class="text-gray-200">{{ $mapel['dosen']['nama_dosen'] ?? 'Belum ada' }}</span></p>
                    <p>🏢 Fakultas: <span class="text-gray-200">{{ $mapel['fakultas']['nama_fakultas'] ?? 'Umum' }}</span></p>
                    <p>⏰ Waktu: <span class="text-gray-200 capitalize">{{ $mapel['waktu'] }} ({{ $mapel['jam_mulai'] }} - {{ $mapel['jam_selesai'] }})</span></p>
                </div>
            </div>
            @endforeach
            
            @if(empty($dataMapel))
                <div class="p-4 bg-red-900/50 border border-red-500 text-red-300 rounded-lg">Gagal narik data dari API / Data Kosong.</div>
            @endif
        </div>
    </div>

</body>
</html>