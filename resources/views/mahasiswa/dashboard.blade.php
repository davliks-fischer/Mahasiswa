<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa — Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

        /* ============================
           1. BASE & CYBER GRID
        ============================ */
        body {
            background-color: #060b14 !important;
            color: #e2e8f0 !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .cyber-grid {
            background-image:
                linear-gradient(rgba(0, 243, 255, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ============================
           2. ANIMASI BERGELOMBANG
        ============================ */
        @keyframes waveUpCyberpunk {
            0%   { opacity: 0; transform: translateY(80px); animation-timing-function: ease-out; }
            45%  { opacity: 1; transform: translateY(-12px); animation-timing-function: ease-in-out; }
            70%  { transform: translateY(5px);  animation-timing-function: ease-in-out; }
            85%  { transform: translateY(-2px); animation-timing-function: ease-in-out; }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-wave { opacity: 0; animation: waveUpCyberpunk 1.5s forwards; }
        .delay-1  { animation-delay: 0.10s; }
        .delay-2  { animation-delay: 0.25s; }
        .delay-3  { animation-delay: 0.40s; }
        .delay-4  { animation-delay: 0.55s; }
        .delay-5  { animation-delay: 0.70s; }
        .delay-6  { animation-delay: 0.85s; }

        /* ============================
           3. MENU CARD (SnackZone product-card style)
        ============================ */
        .menu-card {
            background-color: #111827;
            border: 2px solid rgba(0, 243, 255, 0.08);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            z-index: 10;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .menu-card:hover {
            transform: translateY(-12px);
            z-index: 20;
        }
        /* Cyan theme (Absensi) */
        .theme-cyan:hover {
            border-color: #00f3ff;
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.45), inset 0 0 20px rgba(0, 243, 255, 0.07);
        }
        .theme-cyan:hover .card-title   { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.7); }
        .theme-cyan:hover .card-link-btn { background: #00f3ff; color: #060b14; box-shadow: 0 0 20px rgba(0, 243, 255, 0.6); }

        /* Purple theme (Mapel) */
        .theme-purple:hover {
            border-color: #a855f7;
            box-shadow: 0 0 30px rgba(168, 85, 247, 0.45), inset 0 0 20px rgba(168, 85, 247, 0.07);
        }
        .theme-purple:hover .card-title   { color: #c084fc; text-shadow: 0 0 15px rgba(168, 85, 247, 0.7); }
        .theme-purple:hover .card-link-btn { background: #a855f7; color: #fff; box-shadow: 0 0 20px rgba(168, 85, 247, 0.6); }

        /* Green theme (Keuangan) */
        .theme-green:hover {
            border-color: #39ff14;
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.45), inset 0 0 20px rgba(57, 255, 20, 0.07);
        }
        .theme-green:hover .card-title   { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.7); }
        .theme-green:hover .card-link-btn { background: #39ff14; color: #060b14; box-shadow: 0 0 20px rgba(57, 255, 20, 0.6); }

        .card-title, .card-link-btn { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }

        /* ============================
           4. HERO NEON TEXT
        ============================ */
        .hero-gradient {
            background-image: linear-gradient(to right, #00f3ff, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 20px rgba(0, 243, 255, 0.5));
        }
        .cyan-text  { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.8); }
        .green-text { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }

        /* ============================
           5. SCROLLBAR CUSTOM
        ============================ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0b1120; }
        ::-webkit-scrollbar-thumb { background: rgba(0, 243, 255, 0.4); border-radius: 3px; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen cyber-grid overflow-x-hidden flex flex-col">

    <!-- ===================== NAVBAR ===================== -->
    <nav class="border-b border-[#00f3ff]/30 shadow-[0_0_20px_rgba(0,243,255,0.15)] p-4 sticky top-0 z-50 bg-[#060b14]/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 rounded-full animate-pulse" style="background-color:#00f3ff; box-shadow:0 0 15px #00f3ff;"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text drop-shadow-[0_0_8px_rgba(0,243,255,0.5)]"
                    style="background-image: linear-gradient(to right, #00f3ff, #a855f7);">
                    PORTAL MAHASISWA
                </h1>
            </div>
            <div class="hidden md:flex items-center space-x-6 text-sm font-bold text-gray-400">
                <a href="{{ route('mahasiswa.absensi') }}" class="hover:text-[#00f3ff] transition-colors">ABSENSI</a>
                <a href="{{ route('mahasiswa.mapel') }}" class="hover:text-[#a855f7] transition-colors">MAPEL</a>
                <a href="{{ route('mahasiswa.keuangan') }}" class="hover:text-[#39ff14] transition-colors">KEUANGAN</a>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-400 hidden md:block">
                    Halo, <span class="font-bold text-[#00f3ff]">{{ $user->username ?? 'Mahasiswa' }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-1.5 border border-red-500/60 text-red-400 hover:border-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all font-bold text-sm shadow-[0_0_10px_rgba(220,53,69,0.2)]">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ===================== HERO SECTION ===================== -->
    <section class="max-w-7xl mx-auto px-6 pt-20 pb-16 w-full text-center md:text-left">
        <div class="anim-wave delay-1 relative inline-block mb-4">
            <span class="text-xs tracking-[0.3em] font-bold text-[#39ff14] uppercase flex items-center justify-center md:justify-start gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
                SISTEM PORTAL AKADEMIK
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
            </span>
        </div>
        <div class="anim-wave delay-2">
            <h2 class="text-5xl md:text-7xl font-black leading-tight mb-6">
                Selamat Datang, <span class="hero-gradient">{{ $user->username ?? 'Mahasiswa' }}</span>!<br>
                <span class="text-white drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">Kelola Akademikmu 🎓</span>
            </h2>
            <p class="text-lg md:text-xl text-gray-400 max-w-2xl mb-10 mx-auto md:mx-0">
                Akses absensi, jadwal mata kuliah, dan info keuangan — semua dalam satu portal <span class="cyan-text font-bold">neon</span> yang keren.
            </p>
        </div>
        <div class="anim-wave delay-3 flex flex-wrap gap-4 justify-center md:justify-start">
            <a href="{{ route('mahasiswa.absensi') }}"
               class="px-8 py-3.5 font-black rounded-lg bg-[#00f3ff] text-[#060b14] shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:shadow-[0_0_40px_rgba(0,243,255,0.9)] hover:scale-105 transition-all">
                ABSEN SEKARANG
            </a>
            <a href="{{ route('mahasiswa.keuangan') }}"
               class="px-8 py-3.5 font-black rounded-lg border-2 border-[#00f3ff]/40 text-[#00f3ff] hover:border-[#00f3ff] hover:shadow-[0_0_20px_rgba(0,243,255,0.4)] transition-all">
                CEK KEUANGAN
            </a>
        </div>

        <!-- STATS BAR -->
        <div class="anim-wave delay-4 mt-16 relative bg-[#0b1120] border border-[#00f3ff]/15 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,243,255,0.04)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#00f3ff] shadow-[0_0_12px_#00f3ff]"></div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-3xl font-black cyan-text">{{ $totalSks ?? '144' }}+</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">SKS DISELESAIKAN</p>
                </div>
                <div class="relative">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#00f3ff]/30 to-transparent"></div>
                    <p class="text-3xl font-black text-white drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">{{ $ipk ?? '3.85' }}</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">INDEKS PRESTASI</p>
                    <div class="absolute right-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#00f3ff]/30 to-transparent"></div>
                </div>
                <div>
                    <p class="text-3xl font-black green-text">⚡ {{ $totalMapel ?? '0' }}</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">MATKUL AKTIF</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== MENU SECTION ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="anim-wave delay-2 mb-10">
            <h3 class="text-3xl md:text-4xl font-black text-white flex items-center gap-3 mb-2">
                <svg class="w-8 h-8 cyan-text flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Menu <span class="cyan-text ml-2">Utama</span>
            </h3>
            <p class="text-gray-400">Pilih fitur yang ingin kamu akses hari ini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            <!-- Card Absensi -->
            <div class="anim-wave delay-3">
                <a href="{{ route('mahasiswa.absensi') }}" class="menu-card theme-cyan h-full">
                    <div class="text-6xl text-center py-8 bg-[#0b1120]">📋</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] text-[#00f3ff] font-bold uppercase mb-1">KEHADIRAN</span>
                        <h4 class="card-title text-lg font-black text-white mb-2">Portal Absensi</h4>
                        <p class="text-gray-500 text-sm mb-4 flex-1">
                            Input kehadiran harian, clock-in & clock-out untuk setiap mata kuliah.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Rekam Log Harian</span>
                            <span class="card-link-btn px-4 py-2 rounded-lg border border-[#00f3ff]/50 text-[#00f3ff] text-sm font-bold transition-all">
                                BUKA →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Mapel -->
            <div class="anim-wave delay-4">
                <a href="{{ route('mahasiswa.mapel') }}" class="menu-card theme-purple h-full">
                    <div class="text-6xl text-center py-8 bg-[#0b1120]">📚</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] text-[#c084fc] font-bold uppercase mb-1">PERKULIAHAN</span>
                        <h4 class="card-title text-lg font-black text-white mb-2">Jadwal Mapel</h4>
                        <p class="text-gray-500 text-sm mb-4 flex-1">
                            Lihat daftar mata kuliah aktif, jadwal, SKS, dan info dosen pengajar.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Semester Ini</span>
                            <span class="card-link-btn px-4 py-2 rounded-lg border border-[#a855f7]/50 text-[#c084fc] text-sm font-bold transition-all">
                                BUKA →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card Keuangan -->
            <div class="anim-wave delay-5">
                <a href="{{ route('mahasiswa.keuangan') }}" class="menu-card theme-green h-full">
                    <div class="text-6xl text-center py-8 bg-[#0b1120]">💳</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] text-[#39ff14] font-bold uppercase mb-1">PEMBAYARAN</span>
                        <h4 class="card-title text-lg font-black text-white mb-2">Info Keuangan</h4>
                        <p class="text-gray-500 text-sm mb-4 flex-1">
                            Cek status tagihan kuliah, riwayat pembayaran lunas, dan tunggakan aktif.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xs text-gray-500 font-bold uppercase tracking-wider">Tagihan & Lunas</span>
                            <span class="card-link-btn px-4 py-2 rounded-lg border border-[#39ff14]/50 text-[#39ff14] text-sm font-bold transition-all">
                                BUKA →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <!-- ===================== INFO SECTION ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="anim-wave delay-6 relative bg-[#0b1120] border border-[#a855f7]/20 rounded-2xl p-10 text-center shadow-[0_0_40px_rgba(168,85,247,0.05)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#a855f7] shadow-[0_0_12px_#a855f7]"></div>
            <p class="text-4xl mb-4">🏛️</p>
            <h3 class="text-2xl font-black text-white mb-3">
                Portal <span style="color:#a855f7; text-shadow: 0 0 15px rgba(168,85,247,0.7);">Akademik</span>
            </h3>
            <p class="text-gray-400 max-w-2xl mx-auto mb-6 leading-relaxed">
                Semua informasi perkuliahanmu tersedia di satu tempat. Pantau absensi, jadwal, dan keuangan kuliah dengan mudah dan cepat.
            </p>
            <div class="flex flex-wrap justify-center gap-4 text-[10px] tracking-[0.2em] font-bold text-gray-500 uppercase">
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#00f3ff] shadow-[0_0_6px_#00f3ff]"></span> REALTIME DATA</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_6px_#39ff14]"></span> AKSES 24 JAM</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#a855f7] shadow-[0_0_6px_#a855f7]"></span> SECURE LOGIN</span>
            </div>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-8 text-center text-gray-600 text-sm">
        <p>© {{ date('Y') }} <span class="cyan-text font-bold">Portal Mahasiswa</span> — Sistem Informasi Akademik.</p>
    </footer>

</body>
</html>
