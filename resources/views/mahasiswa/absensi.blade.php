<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen p-8">

    <div class="max-w-5xl mx-auto">
        <a href="/mahasiswa/dashboard" class="text-blue-400 hover:text-blue-300 mb-6 inline-block">&larr; Kembali ke Dashboard</a>
        
        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text text-transparent mb-8">
            Portal Absensi Mahasiswa
        </h2>

        <!-- Alert Success kalau habis Clock-in atau Clock-out -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-900/50 border border-emerald-500 text-emerald-300 rounded-lg shadow-[0_0_15px_rgba(16,185,129,0.3)]">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Alert Error kalau udah absen 2x atau error logic lainnya -->
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-900/50 border border-red-500 text-red-300 rounded-lg shadow-[0_0_15px_rgba(239,68,68,0.3)]">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- FORM CLOCK IN & OUT -->
            <div class="md:col-span-1 bg-gray-800 border border-gray-700 rounded-xl p-6 shadow-[0_0_20px_rgba(59,130,246,0.15)] hover:shadow-[0_0_25px_rgba(59,130,246,0.3)] transition-all h-fit">
                <h3 class="text-xl font-bold mb-4 text-blue-400">Input Kehadiran</h3>
                <form action="/mahasiswa/absensi/clock-in" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Pilih Mata Kuliah</label>
                        <select name="mapel_id" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all cursor-pointer" required>
                            <option value="">-- Pilih Matkul --</option>
                            @foreach($listMapel as $mapel)
                                <option value="{{ $mapel['id'] }}">{{ $mapel['nama_mapel'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Teks tombol udah gw ganti biar sesuai sama smart logic kita -->
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 hover:shadow-[0_0_20px_rgba(59,130,246,0.6)]">
                        🚀 Submit Clock-In / Out
                    </button>
                </form>
            </div>

            <!-- TABEL HISTORY ABSENSI -->
            <div class="md:col-span-2 bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-[0_0_20px_rgba(59,130,246,0.15)] hover:shadow-[0_0_25px_rgba(59,130,246,0.3)] transition-all">
                <div class="p-6 border-b border-gray-700 bg-gray-900/50">
                    <h3 class="text-xl font-bold text-gray-200">Riwayat Kehadiran (API Fetched)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-900 text-gray-400 text-sm uppercase tracking-wider">
                                <th class="p-4 border-b border-gray-700">Tanggal</th>
                                <th class="p-4 border-b border-gray-700">Mata Kuliah</th>
                                <th class="p-4 border-b border-gray-700">Clock-In</th>
                                <!-- Kolom Clock-Out ditambah di sini -->
                                <th class="p-4 border-b border-gray-700">Clock-Out</th>
                                <th class="p-4 border-b border-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataAbsensi as $absen)
                            <tr class="border-b border-gray-700/50 hover:bg-gray-700/50 transition-colors">
                                <td class="p-4 text-gray-300">{{ $absen['tanggal'] }}</td>
                                <td class="p-4 text-gray-300">{{ $absen['mapel']['nama_mapel'] ?? '-' }}</td>
                                <td class="p-4 font-bold text-white">{{ $absen['clock_in'] }}</td>
                                <!-- Data Clock-Out ditampilin di sini -->
                                <td class="p-4 font-bold text-gray-400">{{ $absen['clock_out'] ?? 'Belum' }}</td>
                                <td class="p-4">
                                    @if($absen['status'] == 'hadir')
                                        <span class="px-3 py-1 bg-blue-500/20 text-blue-400 border border-blue-500/50 rounded-full text-xs capitalize">{{ $absen['status'] }}</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/50 rounded-full text-xs capitalize">{{ $absen['status'] }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @if(empty($dataAbsensi))
                        <div class="p-6 text-center text-gray-500">Belum ada riwayat absensi bro.</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</body>
</html>