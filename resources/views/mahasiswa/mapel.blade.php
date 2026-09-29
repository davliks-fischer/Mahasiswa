<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Mapel — Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

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

        @keyframes waveUpCyberpunk {
            0%   { opacity: 0; transform: translateY(80px); animation-timing-function: ease-out; }
            45%  { opacity: 1; transform: translateY(-12px); animation-timing-function: ease-in-out; }
            70%  { transform: translateY(5px);  animation-timing-function: ease-in-out; }
            85%  { transform: translateY(-2px); animation-timing-function: ease-in-out; }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-wave { opacity: 0; animation: waveUpCyberpunk 1.5s forwards; }
        .delay-1 { animation-delay: 0.10s; }
        .delay-2 { animation-delay: 0.25s; }
        .delay-3 { animation-delay: 0.40s; }
        .delay-4 { animation-delay: 0.55s; }
        .delay-5 { animation-delay: 0.70s; }
        .delay-6 { animation-delay: 0.85s; }
        .delay-7 { animation-delay: 1.00s; }
        .delay-8 { animation-delay: 1.15s; }
        .delay-9 { animation-delay: 1.30s; }

        /* Product Card Style */
        .mapel-card {
            background-color: #111827;
            border: 2px solid rgba(168, 85, 247, 0.08);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            z-index: 10;
            overflow: hidden;
        }
        .mapel-card:hover {
            transform: translateY(-12px);
            border-color: #a855f7;
            box-shadow: 0 0 30px rgba(168, 85, 247, 0.45), inset 0 0 20px rgba(168, 85, 247, 0.07);
            z-index: 20;
        }
        .mapel-card:hover .card-title   { color: #c084fc; text-shadow: 0 0 15px rgba(168, 85, 247, 0.7); }
        .mapel-card:hover .sks-tag      { color: #39ff14; text-shadow: 0 0 12px rgba(57, 255, 20, 0.7); }
        .mapel-card:hover .detail-btn   { background: #a855f7; color: #fff; box-shadow: 0 0 20px rgba(168, 85, 247, 0.6); }
        .card-title, .sks-tag, .detail-btn { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }

        /* Category Badge */
        .badge-active {
            background: rgba(168, 85, 247, 0.15);
            border-color: #a855f7;
            color: #c084fc;
            box-shadow: 0 0 12px rgba(168, 85, 247, 0.35);
        }

        .cyan-text  { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.8); }
        .green-text { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }
        .purple-text { color: #c084fc; text-shadow: 0 0 15px rgba(168, 85, 247, 0.8); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0b1120; }
        ::-webkit-scrollbar-thumb { background: rgba(168, 85, 247, 0.4); border-radius: 3px; }

        @keyframes pulse-slow {
            0%, 100% { opacity: 0.6; }
            50%       { opacity: 1; }
        }
        .pulse-slow { animation: pulse-slow 2.5s ease-in-out infinite; }
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
                <a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-[#00f3ff] transition-colors">DASHBOARD</a>
                <a href="{{ route('mahasiswa.absensi') }}" class="hover:text-[#00f3ff] transition-colors">ABSENSI</a>
                <a href="{{ route('mahasiswa.keuangan') }}" class="hover:text-[#39ff14] transition-colors">KEUANGAN</a>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-4 py-1.5 border border-red-500/60 text-red-400 hover:border-red-400 hover:text-white hover:bg-red-500/20 rounded-lg transition-all font-bold text-sm">
                    LOGOUT
                </button>
            </form>
        </div>
    </nav>

    <!-- ===================== HEADER ===================== -->
    <section class="max-w-7xl mx-auto px-6 pt-14 pb-10 w-full">
        <div class="anim-wave delay-1 mb-2">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#a855f7] transition-colors mb-6">
                ← KEMBALI KE DASHBOARD
            </a>
        </div>
        <div class="anim-wave delay-2">
            <span class="text-xs tracking-[0.3em] font-bold text-[#39ff14] uppercase flex items-center gap-2 mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
                SEMESTER AKTIF
            </span>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-3">
                Jadwal <span style="color:#a855f7; text-shadow:0 0 20px rgba(168,85,247,0.5);">Mata Kuliah</span>
            </h2>
            <p class="text-gray-400 text-lg">Daftar matkul aktif semester ini beserta jadwal dan dosen pengajar.</p>
        </div>
    </section>

    <!-- ===================== STATS BAR ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-8 w-full">
        <div class="anim-wave delay-3 relative bg-[#0b1120] border border-[#a855f7]/15 rounded-2xl p-6 shadow-[0_0_30px_rgba(168,85,247,0.04)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#a855f7] shadow-[0_0_12px_#a855f7]"></div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-3xl font-black purple-text">{{ count($dataMapel) }}</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">TOTAL MATKUL</p>
                </div>
                <div class="relative">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#a855f7]/30 to-transparent"></div>
                    <p class="text-3xl font-black text-white drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]">
                        {{ array_sum(array_column($dataMapel, 'sks')) }}
                    </p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">TOTAL SKS</p>
                    <div class="absolute right-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#a855f7]/30 to-transparent"></div>
                </div>
                <div>
                    <p class="text-3xl font-black green-text">⚡ AKTIF</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">STATUS SEMESTER</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== FILTER & GRID ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">

        <!-- Filter Hari -->
        <div class="anim-wave delay-3 flex flex-wrap gap-3 mb-10" id="hari-filters">
            <button onclick="filterHari('semua')" data-hari="semua"
                class="hari-btn badge-active px-4 py-1.5 rounded-full border text-xs font-bold tracking-widest uppercase transition-all">
                SEMUA HARI
            </button>
            @php
                $hariList = array_unique(array_column($dataMapel, 'waktu'));
            @endphp
            @foreach($hariList as $hari)
                <button onclick="filterHari('{{ strtolower($hari) }}')" data-hari="{{ strtolower($hari) }}"
                    class="hari-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-[#a855f7] hover:text-[#c084fc] transition-all">
                    📅 {{ strtoupper($hari) }}
                </button>
            @endforeach
        </div>

        <!-- Product Grid Mapel -->
        <div id="mapel-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($dataMapel as $index => $mapel)
            <div class="anim-wave delay-{{ ($index % 9) + 1 }} mapel-item" data-hari="{{ strtolower($mapel['waktu'] ?? '') }}">
                <div class="mapel-card h-full flex flex-col">
                    <!-- Icon Area (top) -->
                    <div class="text-5xl text-center py-6 bg-[#0b1120] rounded-t-[calc(1rem-2px)]">📖</div>

                    <div class="p-5 flex flex-col flex-1">
                        <!-- Category label -->
                        <span class="text-[10px] tracking-[0.2em] text-[#c084fc] font-bold uppercase mb-1">
                            {{ strtoupper($mapel['waktu'] ?? 'UMUM') }} · {{ $mapel['sks'] ?? 0 }} SKS
                        </span>

                        <!-- Nama Mapel -->
                        <h4 class="card-title text-base font-black text-white mb-2 leading-tight">
                            {{ $mapel['nama_mapel'] ?? 'Mata Kuliah' }}
                        </h4>

                        <!-- Detail -->
                        <div class="space-y-1.5 text-sm text-gray-500 mb-4 flex-1">
                            <p class="flex items-center gap-2">
                                <span class="text-base">👨‍🏫</span>
                                <span class="text-gray-400">{{ $mapel['dosen']['nama_dosen'] ?? 'Belum ada dosen' }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span class="text-base">⏰</span>
                                <span class="text-gray-400">
                                    {{ $mapel['jam_mulai'] ?? '--:--' }} – {{ $mapel['jam_selesai'] ?? '--:--' }}
                                </span>
                            </p>
                            @if(isset($mapel['fakultas']['nama_fakultas']))
                            <p class="flex items-center gap-2">
                                <span class="text-base">🏛️</span>
                                <span class="text-gray-400">{{ $mapel['fakultas']['nama_fakultas'] }}</span>
                            </p>
                            @endif
                        </div>

                        <!-- SKS Badge + Action -->
                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-700/50">
                            <span class="sks-tag text-xl font-black text-[#39ff14]">
                                {{ $mapel['sks'] ?? 0 }} SKS
                            </span>
                            <a href="{{ route('mahasiswa.absensi') }}"
                               class="detail-btn px-3 py-1.5 rounded-lg border border-[#a855f7]/50 text-[#c084fc] text-xs font-bold transition-all">
                                ABSEN →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-4 flex flex-col items-center justify-center py-20 text-center">
                <div class="text-6xl pulse-slow mb-4">📚</div>
                <p class="text-gray-500 font-bold">Tidak ada data mata kuliah</p>
                <p class="text-gray-600 text-sm mt-1">Gagal koneksi ke API atau data belum tersedia.</p>
            </div>
            @endforelse

        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-6 text-center text-gray-600 text-sm">
        <p>© {{ date('Y') }} <span style="color:#00f3ff; text-shadow:0 0 10px rgba(0,243,255,0.5);" class="font-bold">Portal Mahasiswa</span> — Jadwal Perkuliahan Aktif.</p>
    </footer>

    <script>
        function filterHari(hari) {
            // Update badge
            document.querySelectorAll('.hari-btn').forEach(btn => {
                btn.classList.remove('badge-active');
                btn.classList.add('border-gray-700', 'text-gray-400');
            });
            const activeBtn = document.querySelector(`[data-hari="${hari}"]`);
            activeBtn.classList.add('badge-active');
            activeBtn.classList.remove('border-gray-700', 'text-gray-400');

            // Filter cards
            document.querySelectorAll('.mapel-item').forEach(el => {
                el.style.display = (hari === 'semua' || el.dataset.hari === hari) ? '' : 'none';
            });
        }
    </script>

</body>
</html>
