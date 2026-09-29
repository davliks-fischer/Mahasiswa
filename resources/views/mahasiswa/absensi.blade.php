<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Absensi — Mahasiswa</title>
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

        /* Product Card (Absensi History Card) */
        .absen-card {
            background-color: #111827;
            border: 2px solid rgba(0, 243, 255, 0.08);
            border-radius: 1rem;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            position: relative;
            overflow: hidden;
        }
        .absen-card:hover {
            transform: translateY(-6px);
            border-color: #00f3ff;
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.35), inset 0 0 15px rgba(0, 243, 255, 0.05);
        }
        .absen-card:hover .card-mapel { color: #00f3ff; text-shadow: 0 0 12px rgba(0, 243, 255, 0.6); }
        .card-mapel { transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1); }

        /* Form Input style SnackZone */
        .neon-input {
            background: #111827;
            border: 2px solid rgba(0, 243, 255, 0.15);
            border-radius: 0.75rem;
            color: #e2e8f0;
            transition: all 0.3s;
        }
        .neon-input:focus {
            outline: none;
            border-color: #00f3ff;
            box-shadow: 0 0 12px rgba(0, 243, 255, 0.3);
        }
        .neon-select option { background: #111827; }

        /* Category Badge */
        .badge-active {
            background: rgba(0, 243, 255, 0.15);
            border-color: #00f3ff;
            color: #00f3ff;
            box-shadow: 0 0 12px rgba(0, 243, 255, 0.35);
        }

        .cyan-text  { color: #00f3ff; text-shadow: 0 0 15px rgba(0, 243, 255, 0.8); }
        .green-text { color: #39ff14; text-shadow: 0 0 15px rgba(57, 255, 20, 0.8); }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0b1120; }
        ::-webkit-scrollbar-thumb { background: rgba(0, 243, 255, 0.4); border-radius: 3px; }

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
                <a href="{{ route('mahasiswa.mapel') }}" class="hover:text-[#a855f7] transition-colors">MAPEL</a>
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
               class="inline-flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-[#00f3ff] transition-colors mb-6">
                ← KEMBALI KE DASHBOARD
            </a>
        </div>
        <div class="anim-wave delay-2">
            <span class="text-xs tracking-[0.3em] font-bold text-[#39ff14] uppercase flex items-center gap-2 mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#39ff14] shadow-[0_0_8px_#39ff14] animate-pulse"></span>
                INPUT KEHADIRAN HARI INI
            </span>
            <h2 class="text-4xl md:text-5xl font-black text-white mb-3">
                Portal <span style="color:#00f3ff; text-shadow:0 0 20px rgba(0,243,255,0.5);">Absensi</span>
            </h2>
            <p class="text-gray-400 text-lg">Clock-in saat masuk, clock-out saat selesai. Simpel dan terekam.</p>
        </div>
    </section>

    <!-- ===================== ALERT SESSION ===================== -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 mb-6">
            <div class="anim-wave delay-1 p-4 bg-[#0b1120] border border-[#39ff14]/50 text-[#39ff14] rounded-xl shadow-[0_0_20px_rgba(57,255,20,0.2)] flex items-center gap-3">
                <span class="text-xl">✅</span>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6 mb-6">
            <div class="anim-wave delay-1 p-4 bg-[#0b1120] border border-red-500/50 text-red-400 rounded-xl shadow-[0_0_20px_rgba(239,68,68,0.2)] flex items-center gap-3">
                <span class="text-xl">⚠️</span>
                <span class="font-bold">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- ===================== MAIN CONTENT ===================== -->
    <section class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- ===== FORM CLOCK IN/OUT ===== -->
            <div class="lg:col-span-1">
                <div class="anim-wave delay-3 relative bg-[#0b1120] border border-[#00f3ff]/20 rounded-2xl p-6 shadow-[0_0_30px_rgba(0,243,255,0.05)] sticky top-24">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-[2px] bg-[#00f3ff] shadow-[0_0_12px_#00f3ff]"></div>
                    
                    <div class="text-center mb-6">
                        <div class="text-5xl mb-3">🕐</div>
                        <h3 class="text-xl font-black text-white">Input Kehadiran</h3>
                        <p class="text-gray-500 text-sm mt-1">Pilih matkul, lalu submit</p>
                    </div>

                    <form action="{{ route('mahasiswa.absensi.clockin') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold tracking-[0.15em] uppercase text-gray-400 mb-2">Mata Kuliah</label>
                            <select name="mapel_id" required
                                class="neon-input w-full px-4 py-3 text-sm cursor-pointer">
                                <option value="">-- Pilih Matkul --</option>
                                @foreach($listMapel as $mapel)
                                    <option value="{{ $mapel['id'] }}">{{ $mapel['nama_mapel'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="bg-[#111827] border border-[#00f3ff]/10 rounded-xl p-4 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Waktu Sekarang</p>
                            <p class="text-2xl font-black cyan-text" id="clock-now">--:--:--</p>
                            <p class="text-xs text-gray-600 mt-1" id="date-now">Loading...</p>
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 font-black rounded-xl bg-[#00f3ff] text-[#060b14] shadow-[0_0_25px_rgba(0,243,255,0.5)] hover:shadow-[0_0_40px_rgba(0,243,255,0.8)] hover:scale-[1.02] transition-all text-sm flex items-center justify-center gap-2">
                            🚀 SUBMIT CLOCK-IN / OUT
                        </button>
                    </form>

                    <!-- Info logic -->
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="w-2 h-2 rounded-full bg-[#00f3ff] shadow-[0_0_6px_#00f3ff] flex-shrink-0"></span>
                            Pertama kali submit = Clock-In
                        </div>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="w-2 h-2 rounded-full bg-[#39ff14] shadow-[0_0_6px_#39ff14] flex-shrink-0"></span>
                            Submit lagi = Clock-Out otomatis
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== HISTORY ABSENSI ===== -->
            <div class="lg:col-span-2">
                <!-- Filter Badge -->
                <div class="anim-wave delay-3 flex flex-wrap gap-3 mb-8" id="status-filters">
                    <button onclick="filterStatus('semua')" data-status="semua"
                        class="status-btn badge-active px-4 py-1.5 rounded-full border text-xs font-bold tracking-widest uppercase transition-all">
                        SEMUA
                    </button>
                    <button onclick="filterStatus('hadir')" data-status="hadir"
                        class="status-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-[#00f3ff] hover:text-[#00f3ff] transition-all">
                        ✅ HADIR
                    </button>
                    <button onclick="filterStatus('belum')" data-status="belum"
                        class="status-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-yellow-500 hover:text-yellow-400 transition-all">
                        🕐 BELUM CLOCK-OUT
                    </button>
                    <button onclick="filterStatus('absen')" data-status="absen"
                        class="status-btn px-4 py-1.5 rounded-full border border-gray-700 text-gray-400 text-xs font-bold tracking-widest uppercase hover:border-red-500 hover:text-red-400 transition-all">
                        ❌ ABSEN
                    </button>
                </div>

                <!-- Grid Cards Absensi -->
                <div id="absensi-grid" class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    @forelse($dataAbsensi as $index => $absen)
                    <div class="anim-wave delay-{{ ($index % 8) + 1 }} absen-item"
                         data-status="{{ $absen['clock_out'] ? 'hadir' : ($absen['status'] == 'absen' ? 'absen' : 'belum') }}">
                        <div class="absen-card p-5">
                            <!-- Header Card -->
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="text-3xl">
                                        @if($absen['clock_out'])
                                            ✅
                                        @elseif($absen['status'] == 'absen')
                                            ❌
                                        @else
                                            🕐
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-[10px] tracking-[0.2em] font-bold uppercase
                                            @if($absen['clock_out']) text-[#00f3ff]
                                            @elseif($absen['status'] == 'absen') text-red-400
                                            @else text-yellow-400 @endif">
                                            @if($absen['clock_out']) SELESAI
                                            @elseif($absen['status'] == 'absen') ABSEN
                                            @else BELUM CLOCK-OUT @endif
                                        </p>
                                        <p class="text-gray-500 text-xs">{{ $absen['tanggal'] }}</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 rounded-lg text-xs font-bold
                                    @if($absen['clock_out']) bg-[#00f3ff]/10 text-[#00f3ff] border border-[#00f3ff]/30
                                    @elseif($absen['status'] == 'absen') bg-red-500/10 text-red-400 border border-red-500/30
                                    @else bg-yellow-500/10 text-yellow-400 border border-yellow-500/30 @endif">
                                    {{ strtoupper($absen['status'] ?? 'hadir') }}
                                </span>
                            </div>

                            <!-- Nama Mapel -->
                            <h4 class="card-mapel text-base font-black text-white mb-3 leading-tight">
                                {{ $absen['mapel']['nama_mapel'] ?? 'Mata Kuliah' }}
                            </h4>

                            <!-- Clock In / Out info -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-700/50">
                                <div class="text-center">
                                    <p class="text-[10px] text-gray-500 uppercase tracking-wider mb-0.5">Clock-In</p>
                                    <p class="text-sm font-black text-white">{{ $absen['clock_in'] ?? '--:--' }}</p>
                                </div>
                                <div class="text-gray-600 font-black">→</div>
                                <div class="text-center">
                                    <p class="text-[10px] text-gray-500 uppercase tracking-wider mb-0.5">Clock-Out</p>
                                    <p class="text-sm font-black @if($absen['clock_out']) green-text @else text-gray-600 @endif">
                                        {{ $absen['clock_out'] ?? 'Belum' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 flex flex-col items-center justify-center py-20 text-center">
                        <div class="text-6xl pulse-slow mb-4">📋</div>
                        <p class="text-gray-500 font-bold">Belum ada riwayat absensi</p>
                        <p class="text-gray-600 text-sm mt-1">Gunakan form di samping untuk mulai absen!</p>
                    </div>
                    @endforelse

                </div>
            </div>

        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <footer class="border-t border-[#00f3ff]/20 py-6 text-center text-gray-600 text-sm">
        <p>© {{ date('Y') }} <span style="color:#00f3ff; text-shadow:0 0 10px rgba(0,243,255,0.5);" class="font-bold">Portal Mahasiswa</span> — Sistem Absensi Akademik.</p>
    </footer>

    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2,'0');
            const m = String(now.getMinutes()).padStart(2,'0');
            const s = String(now.getSeconds()).padStart(2,'0');
            document.getElementById('clock-now').textContent = `${h}:${m}:${s}`;
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            document.getElementById('date-now').textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Filter Status
        function filterStatus(status) {
            // Update button active state
            document.querySelectorAll('.status-btn').forEach(btn => {
                btn.classList.remove('badge-active');
                btn.classList.add('border-gray-700', 'text-gray-400');
            });
            const activeBtn = document.querySelector(`[data-status="${status}"]`);
            activeBtn.classList.add('badge-active');
            activeBtn.classList.remove('border-gray-700', 'text-gray-400');

            // Filter cards
            document.querySelectorAll('.absen-item').forEach(el => {
                el.style.display = (status === 'semua' || el.dataset.status === status) ? '' : 'none';
            });
        }
    </script>

</body>
</html>
