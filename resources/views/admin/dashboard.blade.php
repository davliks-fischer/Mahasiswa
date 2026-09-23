<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Terminal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* 1. Background Cyberpunk Grid */
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.08) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        /* ==========================================================
           2. ANIMASI MUNCUL (FADE IN UP & EFEK BERGELOMBANG SMOOTH)
           Diadaptasi dari kodingan PKL lu dengan penyempurnaan transform
        ========================================================== */
        @keyframes waveUpCyberpunk {
            0% { opacity: 0; transform: translateY(80px); animation-timing-function: ease-out; }
            45% { opacity: 1; transform: translateY(-12px); animation-timing-function: ease-in-out; }
            70% { transform: translateY(5px); animation-timing-function: ease-in-out; }
            85% { transform: translateY(-2px); animation-timing-function: ease-in-out; }
            100% { opacity: 1; transform: translateY(0); }
        }

        .anim-wave {
            opacity: 0;
            /* Durasi 1.5s biar pergerakannya agak melayang sesuai request lu */
            animation: waveUpCyberpunk 1.5s forwards;
            height: 100%; 
        }

        /* Jeda waktu gelombang (berurutan dari kiri atas ke kanan bawah) */
        .delay-1 { animation-delay: 0.10s; }
        .delay-2 { animation-delay: 0.25s; }
        .delay-3 { animation-delay: 0.40s; }
        .delay-4 { animation-delay: 0.55s; }
        .delay-5 { animation-delay: 0.70s; } /* Mulai baris bawah */
        .delay-6 { animation-delay: 0.85s; }
        .delay-7 { animation-delay: 1.00s; }
        .delay-8 { animation-delay: 1.15s; }

        /* 3. Base Card - Transisi Smooth Buat Hover */
        .stat-card, .menu-card {
            background-color: #111827;
            position: relative;
            z-index: 10;
            height: 100%; 
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .stat-card {
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .menu-card {
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 2rem;
            display: block;
        }

        /* 4. EFEK NAIK (ELEVATE) SAAT DIARAHIN KURSOR */
        .stat-card:hover, .menu-card:hover {
            transform: translateY(-12px); /* Naik ke atas dikit secara smooth */
            z-index: 20;
        }

        /* 5. Tema Cahaya (Glow) Terang per Modul */
        .theme-blue:hover {
            border-color: #60a5fa;
            box-shadow: 0 15px 35px -5px rgba(59, 130, 246, 0.5), 0 0 25px rgba(59, 130, 246, 0.4);
        }
        .theme-blue:hover .icon-bg { background-color: rgba(59, 130, 246, 0.3); box-shadow: 0 0 15px rgba(59, 130, 246, 0.6); }
        .theme-blue:hover .menu-link { color: #93c5fd; text-shadow: 0 0 10px rgba(147, 197, 253, 0.7); }

        .theme-cyan:hover {
            border-color: #22d3ee;
            box-shadow: 0 15px 35px -5px rgba(6, 182, 212, 0.5), 0 0 25px rgba(6, 182, 212, 0.4);
        }
        .theme-cyan:hover .icon-bg { background-color: rgba(6, 182, 212, 0.3); box-shadow: 0 0 15px rgba(6, 182, 212, 0.6); }
        .theme-cyan:hover .menu-link { color: #67e8f9; text-shadow: 0 0 10px rgba(103, 232, 249, 0.7); }

        .theme-indigo:hover {
            border-color: #818cf8;
            box-shadow: 0 15px 35px -5px rgba(99, 102, 241, 0.5), 0 0 25px rgba(99, 102, 241, 0.4);
        }
        .theme-indigo:hover .icon-bg { background-color: rgba(99, 102, 241, 0.3); box-shadow: 0 0 15px rgba(99, 102, 241, 0.6); }
        .theme-indigo:hover .menu-link { color: #a5b4fc; text-shadow: 0 0 10px rgba(165, 180, 252, 0.7); }

        .theme-emerald:hover {
            border-color: #34d399;
            box-shadow: 0 15px 35px -5px rgba(16, 185, 129, 0.5), 0 0 25px rgba(16, 185, 129, 0.4);
        }
        .theme-emerald:hover .icon-bg { background-color: rgba(16, 185, 129, 0.3); box-shadow: 0 0 15px rgba(16, 185, 129, 0.6); }
        .theme-emerald:hover .menu-link { color: #6ee7b7; text-shadow: 0 0 10px rgba(110, 231, 183, 0.7); }

        /* 6. Animasi Panah (Gak bakal ngilang) */
        .menu-link, .menu-arrow, .icon-bg { transition: all 0.4s ease; }
        .menu-card:hover .menu-arrow { transform: translateX(8px); }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid overflow-x-hidden">

    <!-- NAVBAR NEON -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.6)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(59,130,246,1)]"></div>
                <h1 class="text-2xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 drop-shadow-[0_0_10px_rgba(59,130,246,0.8)]">
                    SUPER ADMIN TERMINAL
                </h1>
            </div>
                                                                                                   
            <div class="flex items-center space-x-6">
                <span class="text-blue-300 font-bold hidden md:block">ID: {{ $user->username ?? 'ROOT' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-all shadow-[0_0_10px_rgba(239,68,68,0.3)] hover:shadow-[0_0_20px_rgba(239,68,68,0.8)]">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto p-6 mt-8">
        
        <!-- HEADER TEXT -->
        <div class="mb-10 text-center md:text-left anim-wave delay-1">
            <h2 class="text-4xl font-black text-white drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">Sistem Kontrol Utama</h2>
            <p class="text-blue-400 mt-2 text-lg">Akses penuh ke seluruh database universitas.</p>
        </div>

        <!-- STATISTIK GRID (4 KOTAK ATAS) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">
            <!-- Stat 1 (Biru) -->
            <div class="anim-wave delay-1">
                <div class="stat-card theme-blue flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Total Mahasiswa</p>
                        <h3 class="text-4xl font-black text-blue-400 mt-1">{{ $totalMahasiswa }}</h3>
                    </div>
                    <div class="icon-bg p-3 bg-blue-500/10 rounded-full border border-blue-500/30">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
            </div>
            
            <!-- Stat 2 (Cyan) -->
            <div class="anim-wave delay-2">
                <div class="stat-card theme-cyan flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Total Dosen</p>
                        <h3 class="text-4xl font-black text-cyan-400 mt-1">{{ $totalDosen }}</h3>
                    </div>
                    <div class="icon-bg p-3 bg-cyan-500/10 rounded-full border border-cyan-500/30">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>
                 
            <!-- Stat 3 (Indigo) -->
            <div class="anim-wave delay-3">
                <div class="stat-card theme-indigo flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Mata Kuliah Aktif</p>
                        <h3 class="text-4xl font-black text-indigo-400 mt-1">{{ $totalMapel }}</h3>
                    </div>
                    <div class="icon-bg p-3 bg-indigo-500/10 rounded-full border border-indigo-500/30">
                        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Stat 4 (Emerald) -->
            <div class="anim-wave delay-4">
                <div class="stat-card theme-emerald flex justify-between items-center">
                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider">Hadir Hari Ini</p>
                        <h3 class="text-4xl font-black text-emerald-400 mt-1">{{ $totalHadirHariIni }}</h3>
                    </div>
                    <div class="icon-bg p-3 bg-emerald-500/10 rounded-full border border-emerald-500/30">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU KONTROL UTAMA (4 KOTAK BAWAH) -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
            
            <!-- Card 1 (Biru) -->
            <div class="anim-wave delay-5">
                <a href="{{ route('admin.mahasiswa') }}" class="menu-card theme-blue">
                    <h3 class="text-2xl font-black mb-2 text-white">Data Mahasiswa</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Kontrol penuh CRUD data pendaftaran mahasiswa dan fakultas.</p>
                    <div class="flex items-center text-blue-500 font-bold menu-link">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Card 2 (Cyan) -->
            <div class="anim-wave delay-6">
                <a href="{{ route('admin.dosen_mapel') }}" class="menu-card theme-cyan">
                    <h3 class="text-2xl font-black mb-2 text-white">Dosen & Mapel</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Manajemen jadwal SKS, plotting dosen, dan alokasi waktu.</p>
                    <div class="flex items-center text-cyan-500 font-bold menu-link">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Card 3 (Indigo) -->
            <div class="anim-wave delay-7">
                <a href="{{ route('admin.keuangan') }}" class="menu-card theme-indigo">
                    <h3 class="text-2xl font-black mb-2 text-white">Sistem Keuangan</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Verifikasi pembayaran lunas/belum lunas dan tagihan mahasiswa.</p>
                    <div class="flex items-center text-indigo-500 font-bold menu-link">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Card 4 (Emerald) -->
            <div class="anim-wave delay-8">
                <a href="{{ route('admin.absensi') }}" class="menu-card theme-emerald">
                    <h3 class="text-2xl font-black mb-2 text-white">Rekap Absensi</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Pantau log clock-in & clock-out seluruh mahasiswa aktif hari ini.</p>
                    <div class="flex items-center text-emerald-500 font-bold menu-link">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

        </div>

        <br><br>  
                <!-- Card 5 (Log Aktivitas) -->
            <div class="anim-wave delay-8">
                <a href="{{ route('admin.log_aktivitas') }}" class="menu-card theme-blue">
                    <h3 class="text-2xl font-black mb-2 text-white">Log Aktivitas</h3>
                    <p class="text-gray-400 mb-6 text-sm leading-relaxed">Pantau seluruh riwayat aksi admin di sistem.</p>
                    <div class="flex items-center text-blue-500 font-bold menu-link">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>
    
        </div>                                                                                                             
    </div> <!-- END KONTEN UTAMA -->

</body>
</html>