<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Keuangan — Mahasiswa</title>
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

        /* Keuangan Card */
        .keuangan-card {
            background-color: #111827;
            border: 2px solid rgba(57, 255, 20, 0.08);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            z-index: 10;
            overflow: hidden;
        }
        .keuangan-card.lunas:hover {
            transform: translateY(-8px);
            border-color: #39ff14;
            box-shadow: 0 0 25px rgba(57, 255, 20, 0.35), inset 0 0 15px rgba(57, 255, 20, 0.05);
            z-index: 20;
        }
        .keuangan-card.belum:hover {
            transform: translateY(-8px);
            border-color: #ef4444;
            box-shadow: 0 0 25px rgba(239, 68, 68, 0.35), inset 0 0 15px rgba(239, 68, 68, 0.05);
            z-index: 20;
        }
        .keuangan-card.lunas:hover .nominal-text { color: #39ff14; text-shadow: 0 0 12px rgba(57, 255, 20, 0.7); }
        .keuangan-card.belum:hover .nominal-text { color: #f87171; text-shadow: 0 0 12px rgba(239, 68, 68, 0.7); }
        .nominal-text { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }

        /* Category Badge */
        .badge-active-green {
            background: rgba(57, 255, 20, 0.15);
            border-color: #39ff14;
            color: #39ff14;
            box-shadow: 0 0 12px rgba(57, 255, 20, 0.35);
        }
        .badge-active-red {
            background: rgba(239, 68, 68, 0.15);
            border-color: #ef4444;
            color: #f87171;
            box-shadow: 0 0 12px rgba(239, 68, 68, 0.35);
        }
        .badge-active-all {
            background: rgba(0, 243, 255, 0.15);
            border-color: #00f3ff;
            color: #00f3ff;
            box-shadow: 0 0 12px rgba(0, 243, 255, 0.35);
        }

        .cyan-text  { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.8); }
        .green-text { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0b1120; }
        ::-webkit-scrollbar-thumb { background: rgba(57, 255, 20, 0.4); border-radius: 3px; }

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
                <a href="{{ route('mahasiswa.mapel') }}" class="hover:text-[#a855f7] transition-colors">MAPEL</a>
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
               class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#39ff14] transition-colors mb-6">
                ← KEMBALI KE DASHBOARD
            </a>
        </div>
        <div class="anim-wave delay-2">
            <span class="text-xs tracking-[0.3em] font-bold text-[#39ff14] uppercase flex items-center gap-2 mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
                TAGIHAN & PEMBAYARAN
            </span>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-3">
                Info <span style="color:#39ff14; text-shadow:0 0 20px rgba(57,255,20,0.5);">Keuangan</span>
            </h2>
            <p class="text-gray-400 text-lg">Pantau status tagihan, riwayat lunas, dan tunggakan kuliah.</p>
        </div>
    </section>

    <!-- ===================== RINGKASAN KEUANGAN ===================== -->
    @php
        $totalLunas  = collect($dataKeuangan)->where('status', 'lunas')->sum('jumlah');
        $totalBelum  = collect($dataKeuangan)->where('status', '!=', 'lunas')->sum('jumlah');
        $totalAll    = collect($dataKeuangan)->sum('jumlah');
        $countLunas  = collect($dataKeuangan)->where('status', 'lunas')->count();
        $countBelum  = collect($dataKeuangan)->where('status', '!=', 'lunas')->count();
    @endphp
    <section class="max-w-7xl mx-auto px-6 pb-8 w-full">
        <div class="anim-wave delay-3 relative bg-[#0b1120] border border-[#39ff14]/15 rounded-2xl p-6 shadow-[0_0_30px_rgba(57,255,20,0.04)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#39ff14] shadow-[0_0_12px_#39ff14]"></div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-2xl font-black green-text">Rp {{ number_format($totalLunas, 0, ',', '.') }}</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">TOTAL LUNAS ({{ $countLunas }}x)</p>
                </div>
                <div class="relative">
                    <div class="absolute left-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#39ff14]/30 to-transparent"></div>
                    <p class="text-2xl font-black text-red-400" style="text-shadow: 0 0 12px rgba(239,68,68,0.6);">
                        Rp {{ number_format($totalBelum, 0, ',', '.') }}
                    </p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">TOTAL BELUM LUNAS ({{ $countBelum }}x)</p>
                    <div class="absolute right-0 top-0 h-full w-[1px] bg-gradient-to-b from-transparent via-[#39ff14]/30 to-transparent"></div>
                </div>
                <div>
                    <p class="text-2xl font-black cyan-text">Rp {{ number_format($totalAll, 0, ',', '.') }}</p>
                    <p class="text-[10px] tracking-[0.25em] text-gray-500 uppercase mt-1">TOTAL TAGIHAN</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== FILTER & GRID ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">

        <!-- Filter Badge -->
        <div class="anim-wave delay-3 flex flex-wrap gap-3 mb-10" id="status-filters">
            <button onclick="filterStatus('semua')" data-status="semua"
                class="filter-btn badge-active-all px-4 py-1.5 rounded-full border text-xs font-bold tracking-widest uppercase transition-all">
                SEMUA
            </button>
            <button onclick="filterStatus('lunas')" data-status="lunas"
                class="filter-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-[#39ff14] hover:text-[#39ff14] transition-all">
                ✅ LUNAS
            </button>
            <button onclick="filterStatus('belum')" data-status="belum"
                class="filter-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-red-500 hover:text-red-400 transition-all">
                ❌ BELUM LUNAS
            </button>
        </div>

        <!-- Grid Cards Keuangan -->
        <div id="keuangan-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">

            @forelse($dataKeuangan as $index => $uang)
            @php $statusKey = $uang['status'] == 'lunas' ? 'lunas' : 'belum'; @endphp
            <div class="anim-wave delay-{{ ($index % 9) + 1 }} keuangan-item" data-status="{{ $statusKey }}">
                <div class="keuangan-card {{ $statusKey }} h-full flex flex-col">

                    <!-- Icon Area -->
                    <div class="text-5xl text-center py-6 bg-[#0b1120] rounded-t-[calc(1rem-2px)]">
                        @if($uang['status'] == 'lunas') 💳 @else 🧾 @endif
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <!-- Status Label -->
                        <span class="text-[10px] tracking-[0.2em] font-bold uppercase mb-1
                            @if($uang['status'] == 'lunas') text-[#39ff14] @else text-red-400 @endif">
                            {{ $uang['status'] == 'lunas' ? '✅ LUNAS' : '❌ BELUM LUNAS' }}
                        </span>

                        <!-- Tanggal -->
                        <h4 class="text-base font-black text-white mb-2">
                            Tagihan {{ $uang['tanggal'] ?? '-' }}
                        </h4>

                        <!-- Keterangan jika ada -->
                        @if(isset($uang['keterangan']))
                        <p class="text-gray-500 text-sm mb-3 flex-1">{{ $uang['keterangan'] }}</p>
                        @else
                        <p class="text-gray-600 text-sm mb-3 flex-1">Pembayaran SPP / UKT semester.</p>
                        @endif

                        <!-- Nominal + Badge -->
                        <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-700/50">
                            <span class="nominal-text text-lg font-black
                                @if($uang['status'] == 'lunas') text-[#39ff14] @else text-red-400 @endif">
                                Rp {{ number_format($uang['jumlah'], 0, ',', '.') }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold border
                                @if($uang['status'] == 'lunas')
                                    bg-[#39ff14]/10 text-[#39ff14] border-[#39ff14]/40
                                @else
                                    bg-red-500/10 text-red-400 border-red-500/40
                                @endif">
                                {{ strtoupper($uang['status'] ?? 'PENDING') }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            @empty
            <div class="col-span-4 flex flex-col items-center justify-center py-20 text-center">
                <div class="text-6xl pulse-slow mb-4">💳</div>
                <p class="text-gray-500 font-bold">Tidak ada data keuangan</p>
                <p class="text-gray-600 text-sm mt-1">Gagal koneksi ke API atau data belum tersedia.</p>
            </div>
            @endforelse

        </div>
    </section>

    <!-- ===================== INFO BOX ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="anim-wave delay-6 relative bg-[#0b1120] border border-[#39ff14]/20 rounded-2xl p-10 text-center shadow-[0_0_40px_rgba(57,255,20,0.04)]">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/4 h-[2px] bg-[#39ff14] shadow-[0_0_12px_#39ff14]"></div>
            <p class="text-4xl mb-4">🏦</p>
            <h3 class="text-2xl font-black text-white mb-3">
                Info <span style="color:#39ff14; text-shadow: 0 0 15px rgba(57,255,20,0.7);">Pembayaran</span>
            </h3>
            <p class="text-gray-400 max-w-2xl mx-auto mb-6 leading-relaxed">
                Segera lunasi tagihan yang belum dibayar. Hubungi bagian keuangan kampus untuk konfirmasi pembayaran atau keberatan tagihan.
            </p>
            <div class="flex flex-wrap justify-center gap-4 text-[10px] tracking-[0.2em] font-bold text-gray-500 uppercase">
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#00f3ff] shadow-[0_0_6px_#00f3ff]"></span> DATA REALTIME</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_6px_#39ff14]"></span> REKAP OTOMATIS</span>
                <span class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-[#a855f7] shadow-[0_0_6px_#a855f7]"></span> SECURE PORTAL</span>
            </div>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-6 text-center text-gray-600 text-sm">
        <p>© {{ date('Y') }} <span style="color:#00f3ff; text-shadow:0 0 10px rgba(0,243,255,0.5);" class="font-bold">Portal Mahasiswa</span> — Sistem Informasi Keuangan.</p>
    </footer>

    <script>
        function filterStatus(status) {
            // Update badge styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('badge-active-all', 'badge-active-green', 'badge-active-red');
                btn.classList.add('border-gray-700', 'text-gray-400');
            });
            const activeBtn = document.querySelector(`[data-status="${status}"]`);
            activeBtn.classList.remove('border-gray-700', 'text-gray-400');
            if (status === 'lunas')  activeBtn.classList.add('badge-active-green');
            else if (status === 'belum') activeBtn.classList.add('badge-active-red');
            else activeBtn.classList.add('badge-active-all');

            // Filter cards
            document.querySelectorAll('.keuangan-item').forEach(el => {
                el.style.display = (status === 'semua' || el.dataset.status === status) ? '' : 'none';
            });
        }
    </script>

</body>
</html>
