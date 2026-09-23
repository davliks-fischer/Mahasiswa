<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Premium Cyberpunk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

        /* 1. BACKGROUND DARI WEB PKL & GRID NEON NGEJRENG */
        body { 
            background-color: #060b14 !important; /* Deep Navy dari web PKL lu */
            color: #e2e8f0 !important; 
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .cyber-grid {
            background-image: 
                linear-gradient(rgba(0, 243, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ==========================================================
           2. ANIMASI BERGELOMBANG MANTUL (DARI KODINGAN PKL LU)
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
            animation: waveUpCyberpunk 1.5s forwards;
            height: 100%; 
        }

        /* Jeda waktu gelombang */
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.25s; }
        .delay-3 { animation-delay: 0.4s; }
        .delay-4 { animation-delay: 0.55s; }
        .delay-5 { animation-delay: 0.7s; }

        /* ==========================================================
           3. BASE CARD & HOVER EFFECTS
        ========================================================== */
        .menu-card {
            background-color: #111827;
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            position: relative;
            z-index: 10;
            display: block;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* Efek Naik & Mantul Pas Di-Hover */
        .menu-card:hover {
            transform: translateY(-12px);
            z-index: 20;
        }

        /* ==========================================================
           4. TEMA WARNA GLOWING NEON
        ========================================================== */
        
        /* TEMA BIRU NEON (Absensi) */
        .theme-blue:hover {
            border-color: #00f3ff;
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.6), inset 0 0 10px rgba(0, 243, 255, 0.2);
        }
        .theme-blue:hover .icon-bg { 
            background-color: rgba(0, 243, 255, 0.15); 
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.6); 
            transform: scale(1.15); 
        }
        .theme-blue:hover .menu-title { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.8); }
        .theme-blue:hover .menu-link { color: #00f3ff; text-shadow: 0 0 10px rgba(0, 243, 255, 0.5); }

        /* TEMA UNGU NEON (Mapel) */
        .theme-purple:hover {
            border-color: #a855f7;
            box-shadow: 0 0 25px rgba(168, 85, 247, 0.6), inset 0 0 10px rgba(168, 85, 247, 0.2);
        }
        .theme-purple:hover .icon-bg { 
            background-color: rgba(168, 85, 247, 0.15); 
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.6); 
            transform: scale(1.15); 
        }
        .theme-purple:hover .menu-title { color: #c084fc; text-shadow: 0 0 15px rgba(168, 85, 247, 0.8); }
        .theme-purple:hover .menu-link { color: #c084fc; text-shadow: 0 0 10px rgba(168, 85, 247, 0.5); }

        /* TEMA HIJAU NEON (Keuangan) */
        .theme-emerald:hover {
            border-color: #39ff14; 
            box-shadow: 0 0 25px rgba(57, 255, 20, 0.6), inset 0 0 10px rgba(57, 255, 20, 0.2);
        }
        .theme-emerald:hover .icon-bg { 
            background-color: rgba(57, 255, 20, 0.15); 
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.6); 
            transform: scale(1.15); 
        }
        .theme-emerald:hover .menu-title { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }
        .theme-emerald:hover .menu-link { color: #39ff14; text-shadow: 0 0 10px rgba(57, 255, 20, 0.5); }

        /* 5. Transisi Halus untuk elemen dalam card */
        .menu-title, .menu-link, .menu-arrow, .icon-bg { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }
        .menu-card:hover .menu-arrow { transform: translateX(8px); }

        /* 6. Tambahan CSS buat pemisah border di section statistik */
        .fade-border-x {
            position: absolute;
            right: 0;
            top: 15%;
            height: 70%;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(0,243,255,0.3), transparent);
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen cyber-grid overflow-x-hidden flex flex-col">

    <!-- NAVBAR NEON NGEJRENG -->
    <nav class="border-b border-[#00f3ff]/40 shadow-[0_0_20px_rgba(0,243,255,0.2)] p-4 sticky top-0 z-50 bg-[#060b14]/90 backdrop-blur-md">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <!-- Titik Glowing -->
                <div class="w-3 h-3 rounded-full animate-pulse" style="background-color: #00f3ff; box-shadow: 0 0 15px #00f3ff;"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text drop-shadow-[0_0_8px_rgba(0,243,255,0.6)]" style="background-image: linear-gradient(to right, #00f3ff, #3b82f6);">
                    PORTAL MAHASISWA
                </h1>
            </div>
            
            <div class="flex items-center space-x-6">
                <span class="text-[#e2e8f0] text-sm hidden md:block">ID: <span class="font-bold text-[#00f3ff]">{{ $user->username ?? 'ROOT' }}</span></span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-all shadow-[0_0_10px_rgba(220,53,69,0.3)] hover:shadow-[0_0_20px_rgba(220,53,69,0.8)] font-bold text-sm">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-6xl mx-auto p-6 mt-10 w-full">
        
        <!-- SECTION 1: STATISTIK ALA WEB PKL TAPI NEON (Muncul Paling Awal) -->
        <div class="anim-wave delay-1 relative bg-[#0b1120] border border-[#00f3ff]/20 rounded-2xl p-8 md:p-12 mb-16 shadow-[0_0_30px_rgba(0,243,255,0.05)]">
            <!-- Garis ambient orange/emas di atas box -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-[2px] shadow-[0_0_15px_#f5a623] bg-[#f5a623]"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center relative">
                <!-- Stat 1 (Orange/Gold Glow) -->
                <div class="relative pb-6 md:pb-0">
                    <h3 class="text-5xl md:text-6xl font-black mb-3" style="color: #f5a623; text-shadow: 0 0 20px rgba(245,166,35,0.5);">144+</h3>
                    <p class="text-[10px] tracking-[0.25em] text-[#9aa0ae] uppercase font-bold">SKS DISELESAIKAN</p>
                    <div class="fade-border-x hidden md:block"></div>
                </div>
                <!-- Stat 2 (Cyan Glow) -->
                <div class="relative pb-6 md:pb-0">
                    <h3 class="text-5xl md:text-6xl font-black mb-3" style="color: #00f3ff; text-shadow: 0 0 20px rgba(0,243,255,0.5);">3.85</h3>
                    <p class="text-[10px] tracking-[0.25em] text-[#9aa0ae] uppercase font-bold">INDEKS PRESTASI</p>
                    <div class="fade-border-x hidden md:block"></div>
                </div>
                <!-- Stat 3 (White/Clean) -->
                <div class="relative">
                    <h3 class="text-5xl md:text-6xl font-black text-white mb-3 drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">6</h3>
                    <p class="text-[10px] tracking-[0.25em] text-[#9aa0ae] uppercase font-bold">SEMESTER AKTIF</p>
                </div>
            </div>
            
            <!-- Bullet points ala "INFRASTRUCTURE • AUTOMATION..." -->
            <div class="mt-10 flex flex-wrap justify-center gap-4 md:gap-8 text-[10px] tracking-[0.2em] font-bold text-[#9aa0ae] uppercase">
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#00f3ff] shadow-[0_0_8px_#00f3ff]"></span> INFORMATIKA</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#f5a623] shadow-[0_0_8px_#f5a623]"></span> KELAS KARYAWAN</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#00f3ff] shadow-[0_0_8px_#00f3ff]"></span> ANGKATAN 2023</span>
            </div>
        </div>

        <!-- SECTION 2: HERO TEXT -->
        <div class="anim-wave delay-2 text-center md:text-left mb-16 px-4">
            <h2 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 drop-shadow-[0_0_10px_rgba(255,255,255,0.2)]">
                Selamat Datang, <span style="color: #00f3ff; text-shadow: 0 0 15px rgba(0,243,255,0.6);">{{ $user->username ?? 'Mahasiswa' }}</span>!
            </h2>
            <p class="text-lg" style="color: #9aa0ae;">Pilih menu di bawah untuk mengelola perkuliahanmu hari ini.</p>
        </div>

        <!-- SECTION 3: GRID CARDS (Warna Icon Default Udah Nyala) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full pb-20">
            
            <!-- Card 1: Absensi -->
            <div class="anim-wave delay-3">
                <a href="{{ route('mahasiswa.absensi') }}" class="menu-card theme-blue">
                    <div class="mb-6">
                        <!-- Icon Background & Text udah pake warna Biru tipis -->
                        <div class="icon-bg w-14 h-14 rounded-full bg-[#00f3ff]/10 flex items-center justify-center border border-[#00f3ff]/30">
                            <svg class="w-7 h-7 text-[#00f3ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="menu-title text-2xl font-black mb-3 text-white">Absensi Portal</h3>
                    <p class="mb-8 text-sm leading-relaxed" style="color: #9aa0ae;">Input kehadiran, clock-in, & clock-out harian untuk merekam log absensimu.</p>
                    <div class="flex items-center font-bold menu-link" style="color: #64b5f6;">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Card 2: Mapel -->
            <div class="anim-wave delay-4">
                <a href="/mahasiswa/mapel" class="menu-card theme-purple">
                    <div class="mb-6">
                        <!-- Icon Background & Text udah pake warna Ungu tipis -->
                        <div class="icon-bg w-14 h-14 rounded-full bg-[#a855f7]/10 flex items-center justify-center border border-[#a855f7]/30">
                            <svg class="w-7 h-7 text-[#c084fc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                    <h3 class="menu-title text-2xl font-black mb-3 text-white">Jadwal Mapel</h3>
                    <p class="mb-8 text-sm leading-relaxed" style="color: #9aa0ae;">Lihat daftar jadwal mata kuliah aktif, total SKS, dan dosen pengajarmu.</p>
                    <div class="flex items-center font-bold menu-link" style="color: #c084fc;">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

            <!-- Card 3: Keuangan -->
            <div class="anim-wave delay-5">
                <a href="/mahasiswa/keuangan" class="menu-card theme-emerald">
                    <div class="mb-6">
                        <!-- Icon Background & Text udah pake warna Hijau tipis -->
                        <div class="icon-bg w-14 h-14 rounded-full bg-[#39ff14]/10 flex items-center justify-center border border-[#39ff14]/30">
                            <svg class="w-7 h-7 text-[#39ff14]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <h3 class="menu-title text-2xl font-black mb-3 text-white">Info Keuangan</h3>
                    <p class="mb-8 text-sm leading-relaxed" style="color: #9aa0ae;">Cek status tagihan kuliah, riwayat pembayaran lunas, dan tunggakan.</p>
                    <div class="flex items-center font-bold menu-link" style="color: #39ff14;">
                        Akses Modul <span class="menu-arrow ml-2">&rarr;</span>
                    </div>
                </a>
            </div>

        </div>
    </div>

</body>
</html>