<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Terminal</title>
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
        .delay-7  { animation-delay: 1.00s; }
        .delay-8  { animation-delay: 1.15s; }

        /* ============================
           3. MENU CARD
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

        /* Cyan theme (Mahasiswa) */
        .theme-cyan:hover {
            border-color: #00f3ff;
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.45), inset 0 0 20px rgba(0, 243, 255, 0.07);
        }
        .theme-cyan:hover .card-title    { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.7); }
        .theme-cyan:hover .card-link-btn { background: #00f3ff; color: #060b14; box-shadow: 0 0 20px rgba(0, 243, 255, 0.6); }

        /* Orange theme (Dosen & Mapel) */
        .theme-orange:hover {
            border-color: #f97316;
            box-shadow: 0 0 30px rgba(249, 115, 22, 0.45), inset 0 0 20px rgba(249, 115, 22, 0.07);
        }
        .theme-orange:hover .card-title    { color: #f97316; text-shadow: 0 0 15px rgba(249, 115, 22, 0.7); }
        .theme-orange:hover .card-link-btn { background: #f97316; color: #060b14; box-shadow: 0 0 20px rgba(249, 115, 22, 0.6); }

        /* Purple theme (Keuangan) */
        .theme-purple:hover {
            border-color: #a855f7;
            box-shadow: 0 0 30px rgba(168, 85, 247, 0.45), inset 0 0 20px rgba(168, 85, 247, 0.07);
        }
        .theme-purple:hover .card-title    { color: #c084fc; text-shadow: 0 0 15px rgba(168, 85, 247, 0.7); }
        .theme-purple:hover .card-link-btn { background: #a855f7; color: #fff; box-shadow: 0 0 20px rgba(168, 85, 247, 0.6); }

        /* Green theme (Absensi) */
        .theme-green:hover {
            border-color: #39ff14;
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.45), inset 0 0 20px rgba(57, 255, 20, 0.07);
        }
        .theme-green:hover .card-title    { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.7); }
        .theme-green:hover .card-link-btn { background: #39ff14; color: #060b14; box-shadow: 0 0 20px rgba(57, 255, 20, 0.6); }

        /* Blue theme (Log Aktivitas) */
        .theme-blue:hover {
            border-color: #60a5fa;
            box-shadow: 0 0 30px rgba(96, 165, 250, 0.45), inset 0 0 20px rgba(96, 165, 250, 0.07);
        }
        .theme-blue:hover .card-title    { color: #93c5fd; text-shadow: 0 0 15px rgba(96, 165, 250, 0.7); }
        .theme-blue:hover .card-link-btn { background: #60a5fa; color: #060b14; box-shadow: 0 0 20px rgba(96, 165, 250, 0.6); }

        .card-title, .card-link-btn { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }

        /* ============================
           4. NEON TEXT HELPERS
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
           5. SCROLLBAR CUSTOM CYAN
        ============================ */
        ::-webkit-scrollbar       { width: 6px; }
        ::-webkit-scrollbar-track { background: #0b1120; }
        ::-webkit-scrollbar-thumb { background: rgba(0, 243, 255, 0.4); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0, 243, 255, 0.7); }
    </style>
</head>
<body class="font-sans antialiased min-h-screen cyber-grid overflow-x-hidden flex flex-col">

    <!-- ===================== NAVBAR ===================== -->
    <nav class="sticky top-0 z-50 bg-[#060b14]/90 backdrop-blur-md border-b border-[#00f3ff]/30 shadow-[0_0_20px_rgba(0,243,255,0.15)] px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">

            <!-- Logo -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <div class="w-2.5 h-2.5 rounded-full animate-pulse" style="background:#00f3ff; box-shadow:0 0 12px #00f3ff;"></div>
                <h1 class="text-lg font-black tracking-widest text-transparent bg-clip-text drop-shadow-[0_0_8px_rgba(0,243,255,0.5)]"
                    style="background-image: linear-gradient(to right, #00f3ff, #a855f7);">
                    SUPER ADMIN
                </h1>
            </div>

            <!-- Nav Links -->
            <div class="hidden md:flex items-center space-x-5 text-[11px] font-bold tracking-widest text-gray-400">
                <a href="{{ route('admin.mahasiswa') }}"
                   class="hover:text-[#00f3ff] transition-colors hover:drop-shadow-[0_0_6px_rgba(0,243,255,0.8)]">
                    MAHASISWA
                </a>
                <a href="{{ route('admin.dosen_mapel') }}"
                   class="hover:text-[#f97316] transition-colors hover:drop-shadow-[0_0_6px_rgba(249,115,22,0.8)]">
                    DOSEN &amp; MAPEL
                </a>
                <a href="{{ route('admin.keuangan') }}"
                   class="hover:text-[#a855f7] transition-colors hover:drop-shadow-[0_0_6px_rgba(168,85,247,0.8)]">
                    KEUANGAN
                </a>
                <a href="{{ route('admin.absensi') }}"
                   class="hover:text-[#39ff14] transition-colors hover:drop-shadow-[0_0_6px_rgba(57,255,20,0.8)]">
                    ABSENSI
                </a>
                <a href="{{ route('admin.log_aktivitas') }}"
                   class="hover:text-[#60a5fa] transition-colors hover:drop-shadow-[0_0_6px_rgba(96,165,250,0.8)]">
                    LOG
                </a>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                @csrf
                <button type="submit"
                    class="px-4 py-1.5 border border-red-500/60 text-red-400 hover:border-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all font-bold text-xs tracking-widest shadow-[0_0_10px_rgba(220,53,69,0.2)]">
                    LOGOUT
                </button>
            </form>
        </div>
    </nav>

    <!-- ===================== HERO SECTION ===================== -->
    <section class="max-w-7xl mx-auto px-6 pt-20 pb-16 w-full text-center md:text-left">

        <!-- Badge -->
        <div class="anim-wave delay-1 inline-flex items-center gap-2 mb-6">
            <span class="flex items-center gap-2 text-xs tracking-[0.25em] font-bold uppercase px-4 py-1.5 rounded-full border border-[#39ff14]/40 bg-[#39ff14]/5"
                  style="color:#39ff14;">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
                ⚡ SISTEM KONTROL AKTIF
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
            </span>
        </div>

        <!-- Heading -->
        <div class="anim-wave delay-2">
            <h2 class="text-5xl md:text-7xl font-black leading-tight mb-6">
                Selamat Datang,<br>
                <span class="hero-gradient">{{ $user->username ?? 'ROOT' }}</span>
            </h2>
            <p class="text-lg text-gray-400 max-w-xl mb-10 mx-auto md:mx-0">
                Kendali penuh sistem akademik ada di tanganmu. Monitor, kelola, dan pantau seluruh data universitas dari satu terminal.
            </p>
        </div>

        <!-- CTA Buttons -->
        <div class="anim-wave delay-3 flex flex-wrap gap-4 justify-center md:justify-start mb-16">
            <a href="{{ route('admin.mahasiswa') }}"
               class="px-8 py-3.5 font-black text-sm tracking-widest rounded-lg bg-[#00f3ff] text-[#060b14] shadow-[0_0_25px_rgba(0,243,255,0.6)] hover:shadow-[0_0_40px_rgba(0,243,255,0.9)] hover:scale-105 transition-all">
                KELOLA MAHASISWA
            </a>
            <a href="{{ route('admin.log_aktivitas') }}"
               class="px-8 py-3.5 font-black text-sm tracking-widest rounded-lg border-2 border-[#00f3ff]/40 text-[#00f3ff] hover:border-[#00f3ff] hover:shadow-[0_0_20px_rgba(0,243,255,0.4)] transition-all">
                CEK LOG AKTIVITAS
            </a>
        </div>

        <!-- ===================== STATS BAR ===================== -->
        <div class="anim-wave delay-4 relative bg-[#0b1120] border border-[#00f3ff]/15 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,243,255,0.04)]">
            <!-- Top accent line -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#00f3ff] shadow-[0_0_12px_#00f3ff] rounded-full"></div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-0 text-center">

                <!-- Stat 1: Total Mahasiswa -->
                <div class="py-2 px-4">
                    <p class="text-3xl md:text-4xl font-black" style="color:#00f3ff; text-shadow: 0 0 20px rgba(0,243,255,0.8);">
                        {{ $totalMahasiswa }}
                    </p>
                    <p class="text-[10px] tracking-[0.2em] text-gray-500 uppercase mt-2">TOTAL MAHASISWA</p>
                </div>

                <!-- Divider -->
                <div class="hidden md:block absolute" style="left:25%; top:15%; height:70%; width:1px; background: linear-gradient(to bottom, transparent, rgba(0,243,255,0.25), transparent);"></div>

                <!-- Stat 2: Total Dosen -->
                <div class="py-2 px-4 relative">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#00f3ff]/25 to-transparent md:hidden"></div>
                    <p class="text-3xl md:text-4xl font-black" style="color:#f97316; text-shadow: 0 0 20px rgba(249,115,22,0.8);">
                        {{ $totalDosen }}
                    </p>
                    <p class="text-[10px] tracking-[0.2em] text-gray-500 uppercase mt-2">TOTAL DOSEN</p>
                </div>

                <!-- Stat 3: Mata Kuliah -->
                <div class="py-2 px-4 relative mt-4 md:mt-0">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#00f3ff]/25 to-transparent"></div>
                    <p class="text-3xl md:text-4xl font-black text-white drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">
                        {{ $totalMapel }}
                    </p>
                    <p class="text-[10px] tracking-[0.2em] text-gray-500 uppercase mt-2">MATA KULIAH</p>
                </div>

                <!-- Stat 4: Hadir Hari Ini -->
                <div class="py-2 px-4 relative mt-4 md:mt-0">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#00f3ff]/25 to-transparent"></div>
                    <p class="text-3xl md:text-4xl font-black" style="color:#39ff14; text-shadow: 0 0 20px rgba(57,255,20,0.8);">
                        {{ $totalHadirHariIni }}
                    </p>
                    <p class="text-[10px] tracking-[0.2em] text-gray-500 uppercase mt-2">HADIR HARI INI</p>
                </div>

            </div>
        </div>

    </section>

    <!-- ===================== MENU KONTROL ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">

        <!-- Section Title -->
        <div class="anim-wave delay-5 mb-10">
            <h3 class="text-3xl md:text-4xl font-black text-white flex items-center gap-3 mb-2">
                <svg class="w-8 h-8 flex-shrink-0" style="color:#00f3ff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Menu <span class="ml-2" style="color:#00f3ff; text-shadow:0 0 15px rgba(0,243,255,0.8);">Kontrol</span>
            </h3>
            <p class="text-gray-400">Pilih modul administrasi yang ingin kamu akses.</p>
        </div>

        <!-- Cards Grid: 2 col mobile, 3 col md -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">

            <!-- Card 1: Data Mahasiswa (Cyan) -->
            <div class="anim-wave delay-3">
                <a href="{{ route('admin.mahasiswa') }}" class="menu-card theme-cyan h-full">
                    <div class="text-5xl text-center py-7 bg-[#0b1120]">🎓</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1" style="color:#00f3ff;">MAHASISWA</span>
                        <h4 class="card-title text-base font-black text-white mb-2">Data Mahasiswa</h4>
                        <p class="text-gray-500 text-xs mb-4 flex-1 leading-relaxed">
                            Kelola data pendaftaran, NIM, fakultas, dan akun mahasiswa.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">CRUD Data</span>
                            <span class="card-link-btn px-4 py-1.5 rounded-lg border border-[#00f3ff]/50 text-[#00f3ff] text-xs font-black transition-all">
                                AKSES →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2: Dosen & Mapel (Orange) -->
            <div class="anim-wave delay-4">
                <a href="{{ route('admin.dosen_mapel') }}" class="menu-card theme-orange h-full">
                    <div class="text-5xl text-center py-7 bg-[#0b1120]">👨‍🏫</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1" style="color:#f97316;">PENGAJAR</span>
                        <h4 class="card-title text-base font-black text-white mb-2">Dosen &amp; Mapel</h4>
                        <p class="text-gray-500 text-xs mb-4 flex-1 leading-relaxed">
                            Manajemen jadwal SKS, plotting dosen, dan alokasi mata kuliah.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Jadwal & SKS</span>
                            <span class="card-link-btn px-4 py-1.5 rounded-lg border border-[#f97316]/50 text-[#f97316] text-xs font-black transition-all">
                                AKSES →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3: Keuangan (Purple) -->
            <div class="anim-wave delay-5">
                <a href="{{ route('admin.keuangan') }}" class="menu-card theme-purple h-full">
                    <div class="text-5xl text-center py-7 bg-[#0b1120]">💳</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1" style="color:#c084fc;">PEMBAYARAN</span>
                        <h4 class="card-title text-base font-black text-white mb-2">Keuangan</h4>
                        <p class="text-gray-500 text-xs mb-4 flex-1 leading-relaxed">
                            Verifikasi status tagihan, lunas, dan tunggakan mahasiswa.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Tagihan & Lunas</span>
                            <span class="card-link-btn px-4 py-1.5 rounded-lg border border-[#a855f7]/50 text-[#c084fc] text-xs font-black transition-all">
                                AKSES →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 4: Rekap Absensi (Green) -->
            <div class="anim-wave delay-6">
                <a href="{{ route('admin.absensi') }}" class="menu-card theme-green h-full">
                    <div class="text-5xl text-center py-7 bg-[#0b1120]">📋</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1" style="color:#39ff14;">KEHADIRAN</span>
                        <h4 class="card-title text-base font-black text-white mb-2">Rekap Absensi</h4>
                        <p class="text-gray-500 text-xs mb-4 flex-1 leading-relaxed">
                            Pantau log clock-in &amp; clock-out seluruh mahasiswa aktif.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Log Harian</span>
                            <span class="card-link-btn px-4 py-1.5 rounded-lg border border-[#39ff14]/50 text-[#39ff14] text-xs font-black transition-all">
                                AKSES →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 5: Log Aktivitas (Blue) -->
            <div class="anim-wave delay-7">
                <a href="{{ route('admin.log_aktivitas') }}" class="menu-card theme-blue h-full">
                    <div class="text-5xl text-center py-7 bg-[#0b1120]">🖥️</div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1" style="color:#93c5fd;">AUDIT TRAIL</span>
                        <h4 class="card-title text-base font-black text-white mb-2">Log Aktivitas</h4>
                        <p class="text-gray-500 text-xs mb-4 flex-1 leading-relaxed">
                            Pantau seluruh riwayat aksi admin di dalam sistem.
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Riwayat Aksi</span>
                            <span class="card-link-btn px-4 py-1.5 rounded-lg border border-[#60a5fa]/50 text-[#93c5fd] text-xs font-black transition-all">
                                AKSES →
                            </span>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-8 text-center text-gray-600 text-sm mt-auto">
        <p>© {{ date('Y') }} <span style="color:#00f3ff; text-shadow:0 0 10px rgba(0,243,255,0.6);" class="font-bold">Super Admin Terminal</span></p>
    </footer>

</body>
</html>
