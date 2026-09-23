<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mahasiswa - Super Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid">

    <!-- NAVBAR NEON -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.6)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(59,130,246,1)]"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">
                    SUPER ADMIN TERMINAL
                </h1>
            </div>
            <div>
                <a href="/admin/dashboard" class="px-4 py-2 bg-gray-900 border border-blue-500 text-blue-400 hover:bg-blue-500 hover:text-white rounded transition-all shadow-[0_0_10px_rgba(59,130,246,0.3)]">
                    &larr; KEMBALI
                </a>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto p-6 mt-8">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-white drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">Data Master Mahasiswa</h2>
                <p class="text-blue-400 mt-2">Sistem manajemen dan CRUD pendaftaran mahasiswa.</p>
            </div>
            <!-- Tombol Tambah Data -->
            <button class="mt-4 md:mt-0 px-6 py-2 bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold rounded shadow-[0_0_15px_rgba(59,130,246,0.6)] hover:shadow-[0_0_25px_rgba(59,130,246,0.9)] transition-all transform hover:-translate-y-1">
                + TAMBAH DATA
            </button>
        </div>

        <!-- TABEL DATA -->
        <div class="bg-gray-900 border border-blue-600/30 rounded-xl overflow-hidden shadow-[0_0_30px_rgba(59,130,246,0.15)] relative">
            <!-- Efek Glow Sudut -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-950 border-b border-blue-800 text-blue-400 text-sm uppercase tracking-wider font-bold">
                            <th class="p-4">NIM</th>
                            <th class="p-4">Nama Mahasiswa</th>
                            <th class="p-4">Fakultas</th>
                            <th class="p-4">Username Akun</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataMahasiswa as $mhs)
                        <tr class="border-b border-gray-800 hover:bg-blue-900/20 transition-colors">
                            <td class="p-4 font-mono text-cyan-300">{{ $mhs->nim }}</td>
                            <td class="p-4 text-gray-200 font-semibold">{{ $mhs->nama }}</td>
                            <td class="p-4 text-gray-400">{{ $mhs->fakultas->nama_fakultas ?? 'Belum Diatur' }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 bg-gray-800 border border-gray-700 rounded text-sm text-gray-300">
                                    {{ $mhs->user->username ?? 'Tidak Ada Akun' }}
                                </span>
                            </td>
                            <td class="p-4 flex justify-center space-x-2">
                                <!-- Tombol Edit (Kuning/Orange Cyber) -->
                                <button class="px-3 py-1 bg-gray-800 border border-yellow-500/50 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 rounded transition-colors text-sm shadow-[0_0_10px_rgba(234,179,8,0.2)]">
                                    EDIT
                                </button>
                                <!-- Tombol Delete (Merah Cyber) -->
                                <button class="px-3 py-1 bg-gray-800 border border-red-500/50 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors text-sm shadow-[0_0_10px_rgba(239,68,68,0.2)]">
                                    HAPUS
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500 font-mono">
                                >> DATABASE_KOSONG : 0 ROWS RETURNED <<
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>