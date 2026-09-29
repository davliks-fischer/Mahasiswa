<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mahasiswa — Super Admin Terminal</title>
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
           3. NEON TEXT HELPERS
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
           4. TABLE ROW ANIMATION
        ============================ */
        tbody tr {
            transition: background-color 0.2s ease;
        }

        /* ============================
           5. SCROLLBAR CUSTOM CYAN
        ============================ */
        ::-webkit-scrollbar       { width: 6px; height: 6px; }
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
                   class="text-[#00f3ff] drop-shadow-[0_0_6px_rgba(0,243,255,0.8)]">
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

            <!-- Right: Back + Logout -->
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-1.5 border border-[#00f3ff]/40 text-[#00f3ff] hover:bg-[#00f3ff]/10 hover:border-[#00f3ff] rounded-lg transition-all font-bold text-xs tracking-widest">
                    ← KEMBALI
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-1.5 border border-red-500/60 text-red-400 hover:border-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all font-bold text-xs tracking-widest shadow-[0_0_10px_rgba(220,53,69,0.2)]">
                        LOGOUT
                    </button>
                </form>
            </div>

        </div>
    </nav>

    <!-- ===================== HEADER SECTION ===================== -->
    <section class="max-w-7xl mx-auto px-6 pt-14 pb-8 w-full">

        <!-- Badge -->
        <div class="anim-wave delay-1 mb-5">
            <span class="inline-flex items-center gap-2 text-[10px] tracking-[0.3em] font-bold uppercase px-4 py-1.5 rounded-full border border-[#00f3ff]/30 bg-[#00f3ff]/5"
                  style="color:#00f3ff;">
                <span class="w-1.5 h-1.5 rounded-full bg-[#00f3ff] shadow-[0_0_8px_#00f3ff] animate-pulse"></span>
                MANAJEMEN DATA
            </span>
        </div>

        <!-- Heading & Desc -->
        <div class="anim-wave delay-2 md:flex md:items-end md:justify-between gap-6">
            <div>
                <h2 class="text-4xl md:text-5xl font-black leading-tight mb-3">
                    Data Master <span class="hero-gradient">Mahasiswa</span>
                </h2>
                <p class="text-gray-400 text-base max-w-xl">
                    Sistem manajemen dan CRUD pendaftaran mahasiswa — monitor NIM, fakultas, dan akun user mahasiswa.
                </p>
            </div>

            <!-- Tombol Tambah Data (placeholder) -->
            <div class="mt-6 md:mt-0 flex-shrink-0">
                <button disabled
                    class="px-6 py-2.5 font-black text-sm tracking-widest rounded-lg bg-[#00f3ff]/10 border border-[#00f3ff]/30 text-[#00f3ff]/50 cursor-not-allowed"
                    title="Fitur belum tersedia">
                    + TAMBAH DATA
                </button>
            </div>
        </div>

        <!-- Stats Mini Box -->
        <div class="anim-wave delay-3 mt-8 flex flex-wrap gap-4">
            <div class="flex items-center gap-3 bg-[#0b1120] border border-[#00f3ff]/15 rounded-xl px-5 py-3">
                <div class="w-2 h-2 rounded-full bg-[#00f3ff] shadow-[0_0_8px_#00f3ff] animate-pulse"></div>
                <span class="text-sm font-black" style="color:#00f3ff; text-shadow: 0 0 10px rgba(0,243,255,0.7);">
                    {{ $dataMahasiswa->count() }}
                </span>
                <span class="text-xs text-gray-400 font-bold tracking-widest uppercase">Mahasiswa Terdaftar</span>
            </div>
            <div class="flex items-center gap-3 bg-[#0b1120] border border-[#39ff14]/15 rounded-xl px-5 py-3">
                <div class="w-2 h-2 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></div>
                <span class="text-sm font-black" style="color:#39ff14; text-shadow: 0 0 10px rgba(57,255,20,0.7);">
                    {{ $dataMahasiswa->count() }}
                </span>
                <span class="text-xs text-gray-400 font-bold tracking-widest uppercase">Status Aktif</span>
            </div>
        </div>

    </section>

    <!-- ===================== TABEL DATA ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="anim-wave delay-4">

            <!-- Container Tabel -->
            <div class="bg-[#0b1120] border border-[#00f3ff]/15 rounded-2xl overflow-hidden shadow-[0_0_30px_rgba(0,243,255,0.04)] relative">

                <!-- Top accent line -->
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-[#00f3ff] to-transparent shadow-[0_0_12px_#00f3ff] opacity-60"></div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">

                        <!-- THEAD -->
                        <thead>
                            <tr class="bg-[#060b14] border-b border-[#00f3ff]/20">
                                <th class="px-6 py-4 text-[10px] tracking-[0.2em] uppercase font-black" style="color:#00f3ff;">NIM</th>
                                <th class="px-6 py-4 text-[10px] tracking-[0.2em] uppercase font-black" style="color:#00f3ff;">Nama Mahasiswa</th>
                                <th class="px-6 py-4 text-[10px] tracking-[0.2em] uppercase font-black" style="color:#00f3ff;">Fakultas</th>
                                <th class="px-6 py-4 text-[10px] tracking-[0.2em] uppercase font-black" style="color:#00f3ff;">Username Akun</th>
                                <th class="px-6 py-4 text-[10px] tracking-[0.2em] uppercase font-black text-center" style="color:#00f3ff;">Aksi</th>
                            </tr>
                        </thead>

                        <!-- TBODY -->
                        <tbody>
                            @forelse($dataMahasiswa as $mhs)
                            <tr class="border-b border-[#00f3ff]/08 hover:bg-[#00f3ff]/5 transition-colors">

                                <!-- NIM -->
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm font-bold" style="color:#00f3ff; text-shadow: 0 0 8px rgba(0,243,255,0.5);">
                                        {{ $mhs->nim }}
                                    </span>
                                </td>

                                <!-- Nama -->
                                <td class="px-6 py-4">
                                    <span class="text-white font-bold text-sm">{{ $mhs->nama }}</span>
                                </td>

                                <!-- Fakultas -->
                                <td class="px-6 py-4">
                                    <span class="text-gray-400 text-sm">
                                        {{ $mhs->fakultas->nama_fakultas ?? '—' }}
                                    </span>
                                </td>

                                <!-- Username badge -->
                                <td class="px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-lg bg-[#1a2235] border border-gray-700/60 text-gray-300 text-xs font-mono">
                                        {{ $mhs->user->username ?? 'no account' }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            disabled
                                            class="px-3 py-1.5 bg-[#1a2235] border border-yellow-500/40 text-yellow-400 hover:bg-yellow-500/10 rounded-lg transition-colors text-xs font-bold tracking-wider shadow-[0_0_8px_rgba(234,179,8,0.15)] cursor-not-allowed"
                                            title="Edit (belum tersedia)">
                                            EDIT
                                        </button>
                                        <button
                                            disabled
                                            class="px-3 py-1.5 bg-[#1a2235] border border-red-500/40 text-red-400 hover:bg-red-500/10 rounded-lg transition-colors text-xs font-bold tracking-wider shadow-[0_0_8px_rgba(239,68,68,0.15)] cursor-not-allowed"
                                            title="Hapus (belum tersedia)">
                                            HAPUS
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <span class="text-5xl">👥</span>
                                        <p class="text-gray-500 font-mono text-sm tracking-widest">
                                            DATA_MAHASISWA : 0 ROWS RETURNED
                                        </p>
                                        <p class="text-gray-600 text-xs">Belum ada data mahasiswa yang terdaftar.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Bottom info bar -->
                <div class="px-6 py-3 border-t border-[#00f3ff]/10 flex items-center justify-between bg-[#060b14]/50">
                    <span class="text-[10px] text-gray-600 font-mono tracking-wider uppercase">
                        TOTAL RECORDS: {{ $dataMahasiswa->count() }}
                    </span>
                    <span class="text-[10px] text-gray-600 font-mono tracking-wider uppercase flex items-center gap-1.5">
                        <span class="w-1 h-1 rounded-full bg-[#00f3ff] shadow-[0_0_4px_#00f3ff]"></span>
                        LIVE DATABASE
                    </span>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-8 text-center text-gray-600 text-sm mt-auto">
        <p>© {{ date('Y') }} <span style="color:#00f3ff; text-shadow:0 0 10px rgba(0,243,255,0.6);" class="font-bold">Super Admin Terminal</span></p>
    </footer>

</body>
</html>
