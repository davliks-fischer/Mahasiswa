<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - Portal Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

        /* 1. BACKGROUND DEEP NAVY DENGAN GRID HIJAU NEON */
        body { 
            background-color: #060b14 !important; 
            color: #e2e8f0 !important; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(57, 255, 20, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(57, 255, 20, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* 2. ANIMASI BERGELOMBANG MANTUL */
        @keyframes waveUpCyberpunk {
            0% { opacity: 0; transform: translateY(80px); animation-timing-function: ease-out; }
            45% { opacity: 1; transform: translateY(-12px); animation-timing-function: ease-in-out; }
            70% { transform: translateY(5px); animation-timing-function: ease-in-out; }
            85% { transform: translateY(-2px); animation-timing-function: ease-in-out; }
            100% { opacity: 1; transform: translateY(0); }
        }

        .anim-wave {
            opacity: 0;
            animation: waveUpCyberpunk 3.5s forwards;
        }

        .delay-1 { animation-delay: 0.80s; }
        .delay-2 { animation-delay: 0.60s; }
        .delay-3 { animation-delay: 0.55s; }

        /* 3. TEMA HIJAU NEON THE MATRIX */
        .theme-matrix {
            background-color: #111827;
            border: 2px solid rgba(57, 255, 20, 0.1);
            border-radius: 1rem;
            transition: all 0.9s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .theme-matrix:hover {
            transform: translateY(-8px);
            border-color: #39ff14;
            box-shadow: 0 0 25px rgba(57, 255, 20, 0.4), inset 0 0 15px rgba(57, 255, 20, 0.1);
        }

        .matrix-text { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }
        
        /* Pemisah Border Statistik */
        .fade-border-x {
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(57, 255, 20, 0.4), transparent);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen cyber-grid overflow-x-hidden flex flex-col">

    <!-- NAVBAR HIJAU NEON -->
    <nav class="border-b border-[#39ff14]/40 shadow-[0_0_20px_rgba(57,255,20,0.2)] p-4 sticky top-0 z-50 bg-[#060b14]/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-5">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full animate-pulse" style="background-color: #39ff14; box-shadow: 0 0 15px #39ff14;"></div>
                    <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text drop-shadow-[0_0_8px_rgba(57,255,20,0.6)]" style="background-image: linear-gradient(to right, #39ff14, #10b981);">
                        PORTAL DOSEN
                    </h1>
                </div>
                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dosen.dashboard') }}"
                       class="px-3 py-1.5 text-sm rounded font-bold transition-all"
                       style="color:#39ff14; background: rgba(57,255,20,0.08); border: 1px solid rgba(57,255,20,0.25); text-shadow: 0 0 8px rgba(57,255,20,0.5);">
                        Dashboard
                    </a>
                    <a href="{{ route('dosen.tugas') }}"
                       class="px-3 py-1.5 text-sm text-gray-400 hover:text-amber-400 rounded transition-colors hover:bg-amber-500/10 font-medium border border-transparent hover:border-amber-500/20">
                        Upload Tugas
                    </a>
                </div>
            </div>
            
            <div class="flex items-center space-x-6">
                <span class="text-[#e2e8f0] text-sm hidden md:block">NIDN: <span class="font-bold matrix-text">{{ $user->username ?? 'DSN-001' }}</span></span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-all shadow-[0_0_10px_rgba(220,53,69,0.3)] font-bold text-sm">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto p-6 mt-10 w-full">
        
        <!-- HEADER TEXT -->
        <div class="anim-wave delay-1 mb-10 text-center md:text-left">
            <h2 class="text-4xl font-black text-white drop-shadow-[0_0_10px_rgba(255,255,255,0.2)]">
                Ruang Kendali <span class="matrix-text">Dosen</span>
            </h2>
            <p class="mt-2 text-lg text-gray-400">Monitor data mahasiswa dan jadwal mata kuliah yang ditugaskan kepada Anda.</p>
        </div>

        <!-- STATISTIK (2 KOTAK) -->
        <div class="anim-wave delay-2 relative bg-[#0b1120] border border-[#39ff14]/20 rounded-2xl p-8 mb-12 shadow-[0_0_30px_rgba(57,255,20,0.05)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-[2px] shadow-[0_0_15px_#39ff14] bg-[#39ff14]"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-center relative">
                <!-- Stat 1 -->
                <div class="relative pb-6 md:pb-0">
                    <h3 class="text-5xl md:text-6xl font-black mb-3 matrix-text">{{ $totalMapel }}</h3>
                    <p class="text-[10px] tracking-[0.25em] text-gray-400 uppercase font-bold">TOTAL MATA KULIAH AKTIF</p>
                    <div class="fade-border-x hidden md:block"></div>
                </div>
                <!-- Stat 2 -->
                <div class="relative">
                    <h3 class="text-5xl md:text-6xl font-black text-white mb-3 drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">{{ $totalMahasiswa }}</h3>
                    <p class="text-[10px] tracking-[0.25em] text-gray-400 uppercase font-bold">TOTAL MAHASISWA TERDAFTAR</p>
                </div>
            </div>
        </div>

        <!-- TABEL DATA MAPEL & DOSEN PENGAMPU -->
        <div class="anim-wave delay-3">
            <h3 class="text-2xl font-bold text-white mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 matrix-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Daftar Plotting Mata Kuliah
            </h3>
            
            <div class="theme-matrix overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-900/50 border-b border-[#39ff14]/30 text-[#39ff14] text-xs uppercase tracking-wider font-bold">
                            <tr>
                                <th class="p-5">Nama Mata Kuliah</th>
                                <th class="p-5">Dosen Pengampu</th>
                                <th class="p-5 text-center">SKS</th>
                                <th class="p-5 text-center">Jadwal Sesi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($dataMapel as $mapel)
                            <tr class="border-b border-gray-800/50 hover:bg-[#39ff14]/10 transition-colors">
                                <td class="p-5 text-white font-semibold">{{ $mapel->nama_mapel }}</td>
                                
                                <td class="p-5">
                                    @if($mapel->dosen_id)
                                        <span class="matrix-text font-bold">{{ $mapel->dosen->nama_dosen }}</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-900/40 border border-red-500/50 text-red-400 rounded text-xs">Belum Diplot</span>
                                    @endif
                                </td>
                                
                                <td class="p-5 text-center text-gray-300 font-mono">{{ $mapel->sks }}</td>
                                <td class="p-5 text-center">
                                    <span class="px-3 py-1 border border-gray-600 bg-gray-800 rounded-full text-xs text-gray-300 uppercase">
                                    
                                        {{ $mapel->waktu }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center text-gray-500 font-mono">
                                    >> BELUM ADA DATA MATA KULIAH <<
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- END KONTEN UTAMA -->

</body>
</html>