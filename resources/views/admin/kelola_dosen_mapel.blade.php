<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Dosen & Mata Kuliah</title>

    {{-- Google Fonts: Plus Jakarta Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        cyan: { DEFAULT: '#00f3ff' },
                        orange: { DEFAULT: '#f97316' },
                    },
                    keyframes: {
                        waveUp: {
                            '0%'   : { transform: 'translateY(40px)', opacity: '0' },
                            '100%' : { transform: 'translateY(0)',    opacity: '1' },
                        },
                        scaleIn: {
                            '0%'   : { transform: 'scale(0.85)', opacity: '0' },
                            '100%' : { transform: 'scale(1)',    opacity: '1' },
                        },
                    },
                    animation: {
                        'wave-up'    : 'waveUp 0.6s ease forwards',
                        'scale-in'   : 'scaleIn 0.25s ease forwards',
                    },
                },
            },
        }
    </script>

    <style>
        /* ── Base ─────────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #060b14;
            color: #e2e8f0;
            min-height: 100vh;

            /* cyber-grid overlay */
            background-image:
                linear-gradient(rgba(0,243,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,243,255,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* ── Custom scrollbar ─────────────────────────────── */
        ::-webkit-scrollbar          { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track    { background: #060b14; }
        ::-webkit-scrollbar-thumb    { background: #00f3ff55; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #00f3ffaa; }

        /* ── Wave-up delay helpers ────────────────────────── */
        .delay-1 { animation-delay: 0.10s; }
        .delay-2 { animation-delay: 0.20s; }
        .delay-3 { animation-delay: 0.30s; }
        .delay-4 { animation-delay: 0.40s; }
        .delay-5 { animation-delay: 0.50s; }
        .delay-6 { animation-delay: 0.60s; }
        .delay-7 { animation-delay: 0.70s; }
        .delay-8 { animation-delay: 0.80s; }

        /* Start invisible then animate in */
        .wave-item { opacity: 0; animation: waveUp 0.6s ease forwards; }

        @keyframes waveUp {
            0%   { transform: translateY(40px); opacity: 0; }
            100% { transform: translateY(0);    opacity: 1; }
        }
        @keyframes scaleIn {
            0%   { transform: scale(0.85); opacity: 0; }
            100% { transform: scale(1);    opacity: 1; }
        }

        /* ── Modal ────────────────────────────────────────── */
        .modal-overlay {
            display: none;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active {
            display: flex;
        }
        .modal-box {
            animation: scaleIn 0.25s ease forwards;
        }

        /* ── Table row hover ──────────────────────────────── */
        .tbl-row { transition: background 0.18s; }
        .tbl-row:hover { background: rgba(0,243,255,0.04); }
        .tbl-row-orange:hover { background: rgba(249,115,22,0.04); }

        /* ── Glow helpers ─────────────────────────────────── */
        .cyan-glow  { box-shadow: 0 0 18px rgba(0,243,255,0.25); }
        .orange-glow { box-shadow: 0 0 18px rgba(249,115,22,0.25); }

        /* ── Input focus glow (used via class) ────────────── */
        .input-cyber {
            background: #111827;
            border: 1px solid rgba(0,243,255,0.15);
            border-radius: 0.75rem;
            padding: 0.625rem 1rem;
            color: #fff;
            width: 100%;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .input-cyber:focus {
            border-color: #00f3ff;
            box-shadow: 0 0 12px rgba(0,243,255,0.3);
        }
        .input-cyber option { background: #111827; }

        /* ── Select arrow tint ────────────────────────────── */
        select.input-cyber {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2300f3ff' viewBox='0 0 20 20'%3E%3Cpath d='M5.25 7.5L10 12.25 14.75 7.5H5.25z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
        }
    </style>
</head>
<body>

{{-- ═══════════════════════════════════════════════════════
     NAVBAR
═══════════════════════════════════════════════════════ --}}
<nav class="sticky top-0 z-50 bg-[#060b14]/90 backdrop-blur-md border-b border-[#00f3ff]/30">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Title --}}
        <h1 class="text-xl font-extrabold tracking-tight bg-gradient-to-r from-[#00f3ff] to-purple-400 bg-clip-text text-transparent select-none">
            ⚡ KELOLA DOSEN &amp; MAPEL
        </h1>

        {{-- Nav links --}}
        <div class="flex items-center gap-6 text-sm font-semibold">
            <a href="{{ route('admin.dashboard') }}"
               class="text-[#00f3ff]/80 hover:text-[#00f3ff] transition-colors duration-200 flex items-center gap-1">
                ← KEMBALI
            </a>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit"
                        class="text-red-400 hover:text-red-300 transition-colors duration-200">
                    LOGOUT
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- ═══════════════════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════════════════ --}}
<main class="max-w-7xl mx-auto px-6 py-10 space-y-12">

    {{-- ── ALERT: success ──────────────────────────────── --}}
    @if(session('success'))
        <div class="wave-item delay-1 flex items-start gap-3 bg-[#00f3ff]/5 border border-[#00f3ff]/40 rounded-xl px-5 py-4 text-sm text-[#00f3ff]">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- ── ALERT: errors ───────────────────────────────── --}}
    @if($errors->any())
        <div class="wave-item delay-1 bg-red-500/5 border border-red-500/40 rounded-xl px-5 py-4 text-sm text-red-400 space-y-1">
            <div class="flex items-center gap-2 font-semibold mb-2">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Terdapat beberapa kesalahan:
            </div>
            <ul class="list-disc list-inside space-y-1 pl-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════════
         SECTION: DOSEN
    ══════════════════════════════════════════════════ --}}
    <section class="wave-item delay-2">

        {{-- Section header --}}
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-bold text-white tracking-wide">
                    <span class="text-[#00f3ff]">◈</span> DATA DOSEN
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manajemen data dosen pengampu mata kuliah</p>
            </div>
            <button onclick="openModal('modal-dosen')"
                    class="flex items-center gap-2 bg-[#00f3ff]/10 hover:bg-[#00f3ff]/20 border border-[#00f3ff]/40 hover:border-[#00f3ff]/70 text-[#00f3ff] text-xs font-bold px-4 py-2.5 rounded-xl transition-all duration-200 cyan-glow hover:shadow-[0_0_24px_rgba(0,243,255,0.35)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                + TAMBAH DOSEN
            </button>
        </div>

        {{-- Tabel Dosen --}}
        <div class="bg-[#0b1120] border border-[#00f3ff]/15 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#00f3ff]/10">
                            <th class="text-left text-[#00f3ff]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4 w-36">
                                ID Dosen
                            </th>
                            <th class="text-left text-[#00f3ff]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4">
                                Nama Lengkap
                            </th>
                            <th class="text-center text-[#00f3ff]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4 w-32">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#00f3ff]/5">
                        @foreach($dataDosen as $dosen)
                            <tr class="tbl-row">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-[#00f3ff]/80 bg-[#00f3ff]/5 border border-[#00f3ff]/15 rounded-lg px-2.5 py-1 text-xs">
                                        DSN-{{ $dosen->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-200 font-medium">
                                    {{ $dosen->nama_dosen }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="openEditDosenModal({{ $dosen->id }}, '{{ $dosen->nama_dosen }}')"
                                            class="text-xs font-bold text-[#00f3ff] bg-[#00f3ff]/10 hover:bg-[#00f3ff]/20 border border-[#00f3ff]/30 hover:border-[#00f3ff]/60 px-3 py-1.5 rounded-lg transition-all duration-200">
                                        ✎ EDIT
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if($dataDosen->isEmpty())
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-slate-600 text-sm">
                                    Belum ada data dosen. Tambahkan dosen terlebih dahulu.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         SECTION: MAPEL
    ══════════════════════════════════════════════════ --}}
    <section class="wave-item delay-4">

        {{-- Section header --}}
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-bold text-white tracking-wide">
                    <span class="text-[#f97316]">◈</span> DATA MATA KULIAH
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Manajemen mata kuliah dan penugasan dosen pengampu</p>
            </div>
            <button onclick="openModal('modal-mapel')"
                    class="flex items-center gap-2 bg-[#f97316]/10 hover:bg-[#f97316]/20 border border-[#f97316]/40 hover:border-[#f97316]/70 text-[#f97316] text-xs font-bold px-4 py-2.5 rounded-xl transition-all duration-200 orange-glow hover:shadow-[0_0_24px_rgba(249,115,22,0.35)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                + TAMBAH MAPEL
            </button>
        </div>

        {{-- Tabel Mapel --}}
        <div class="bg-[#0b1120] border border-[#f97316]/15 rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#f97316]/10">
                            <th class="text-left text-[#f97316]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4">
                                Nama Mata Kuliah
                            </th>
                            <th class="text-left text-[#f97316]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4">
                                Dosen Pengampu
                            </th>
                            <th class="text-center text-[#f97316]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4 w-40">
                                SKS / Waktu
                            </th>
                            <th class="text-center text-[#f97316]/70 font-semibold text-xs uppercase tracking-widest px-6 py-4 w-32">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f97316]/5">
                        @foreach($dataMapel as $mapel)
                            <tr class="tbl-row tbl-row-orange">
                                <td class="px-6 py-4 text-slate-200 font-medium">
                                    {{ $mapel->nama_mapel }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($mapel->dosen)
                                        <span class="text-slate-300">{{ $mapel->dosen->nama_dosen }}</span>
                                    @else
                                        <span class="text-red-400 italic text-xs">Belum Di-plot</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex flex-col items-center gap-1">
                                        <span class="font-mono text-[#f97316]/80 bg-[#f97316]/5 border border-[#f97316]/15 rounded-lg px-2 py-0.5 text-xs">
                                            {{ $mapel->sks }} SKS
                                        </span>
                                        <span class="text-slate-500 text-xs capitalize">{{ $mapel->waktu ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="openPlotModal({{ $mapel->id }}, '{{ $mapel->nama_mapel }}')"
                                            class="text-xs font-bold text-[#f97316] bg-[#f97316]/10 hover:bg-[#f97316]/20 border border-[#f97316]/30 hover:border-[#f97316]/60 px-3 py-1.5 rounded-lg transition-all duration-200">
                                        ⇌ PLOT
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        @if($dataMapel->isEmpty())
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-600 text-sm">
                                    Belum ada data mata kuliah. Tambahkan mata kuliah terlebih dahulu.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>


{{-- ═══════════════════════════════════════════════════════
     MODAL 1: TAMBAH DOSEN
═══════════════════════════════════════════════════════ --}}
<div id="modal-dosen"
     class="modal-overlay fixed inset-0 z-[100] bg-black/70 backdrop-blur-sm">
    <div class="modal-box bg-[#0b1120] border border-[#00f3ff]/30 rounded-2xl w-full max-w-md mx-4 p-7 shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-white tracking-wide flex items-center gap-2">
                <span class="text-[#00f3ff]">+</span> TAMBAH DOSEN BARU
            </h3>
            <button onclick="closeModal('modal-dosen')"
                    class="text-slate-500 hover:text-white transition-colors w-7 h-7 flex items-center justify-center rounded-lg hover:bg-white/5">
                ✕
            </button>
        </div>

        {{-- Form --}}
        <form method="POST" action="/admin/dosen/store">
            @csrf
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Nama Lengkap Dosen
                    </label>
                    <input type="text"
                           name="nama_dosen"
                           class="input-cyber"
                           placeholder="Contoh: Dr. Budi Santoso, M.Kom"
                           required
                           autocomplete="off">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button"
                            onclick="closeModal('modal-dosen')"
                            class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-400 hover:text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-[#00f3ff]/10 hover:bg-[#00f3ff]/20 border border-[#00f3ff]/40 hover:border-[#00f3ff]/70 text-[#00f3ff] text-sm font-bold py-2.5 rounded-xl transition-all duration-200">
                        SIMPAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════
     MODAL 2: EDIT DOSEN
═══════════════════════════════════════════════════════ --}}
<div id="modal-edit-dosen"
     class="modal-overlay fixed inset-0 z-[100] bg-black/70 backdrop-blur-sm">
    <div class="modal-box bg-[#0b1120] border border-[#00f3ff]/30 rounded-2xl w-full max-w-md mx-4 p-7 shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-white tracking-wide flex items-center gap-2">
                <span class="text-[#00f3ff]">✎</span> EDIT DATA DOSEN
            </h3>
            <button onclick="closeModal('modal-edit-dosen')"
                    class="text-slate-500 hover:text-white transition-colors w-7 h-7 flex items-center justify-center rounded-lg hover:bg-white/5">
                ✕
            </button>
        </div>

        {{-- Form (action set dynamically by JS) --}}
        <form id="form-edit-dosen" method="POST" action="">
            @csrf
            @method('PUT')
            <div class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Nama Lengkap Dosen
                    </label>
                    <input type="text"
                           id="input-edit-nama-dosen"
                           name="nama_dosen"
                           class="input-cyber"
                           placeholder="Nama lengkap dosen"
                           required
                           autocomplete="off">
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button"
                            onclick="closeModal('modal-edit-dosen')"
                            class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-400 hover:text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-[#00f3ff]/10 hover:bg-[#00f3ff]/20 border border-[#00f3ff]/40 hover:border-[#00f3ff]/70 text-[#00f3ff] text-sm font-bold py-2.5 rounded-xl transition-all duration-200">
                        UPDATE
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════
     MODAL 3: TAMBAH MAPEL
═══════════════════════════════════════════════════════ --}}
<div id="modal-mapel"
     class="modal-overlay fixed inset-0 z-[100] bg-black/70 backdrop-blur-sm">
    <div class="modal-box bg-[#0b1120] border border-[#00f3ff]/30 rounded-2xl w-full max-w-md mx-4 p-7 shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-white tracking-wide flex items-center gap-2">
                <span class="text-[#f97316]">+</span> TAMBAH MATA KULIAH
            </h3>
            <button onclick="closeModal('modal-mapel')"
                    class="text-slate-500 hover:text-white transition-colors w-7 h-7 flex items-center justify-center rounded-lg hover:bg-white/5">
                ✕
            </button>
        </div>

        {{-- Form --}}
        <form method="POST" action="/admin/mapel/store">
            @csrf
            <div class="space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Nama Mata Kuliah
                    </label>
                    <input type="text"
                           name="nama_mapel"
                           class="input-cyber"
                           placeholder="Contoh: Pemrograman Web"
                           required
                           autocomplete="off">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Jumlah SKS
                    </label>
                    <input type="number"
                           name="sks"
                           class="input-cyber"
                           placeholder="Contoh: 3"
                           min="1"
                           max="6"
                           required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Waktu Kuliah
                    </label>
                    <select name="waktu" class="input-cyber" required>
                        <option value="" disabled selected>-- Pilih Waktu --</option>
                        <option value="pagi">Pagi</option>
                        <option value="siang">Siang</option>
                        <option value="malam">Malam</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button"
                            onclick="closeModal('modal-mapel')"
                            class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-400 hover:text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-[#f97316]/10 hover:bg-[#f97316]/20 border border-[#f97316]/40 hover:border-[#f97316]/70 text-[#f97316] text-sm font-bold py-2.5 rounded-xl transition-all duration-200">
                        SIMPAN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════
     MODAL 4: PLOT DOSEN KE MAPEL
═══════════════════════════════════════════════════════ --}}
<div id="modal-plot"
     class="modal-overlay fixed inset-0 z-[100] bg-black/70 backdrop-blur-sm">
    <div class="modal-box bg-[#0b1120] border border-[#00f3ff]/30 rounded-2xl w-full max-w-md mx-4 p-7 shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-white tracking-wide flex items-center gap-2">
                <span class="text-[#f97316]">⇌</span> PLOT DOSEN PENGAMPU
            </h3>
            <button onclick="closeModal('modal-plot')"
                    class="text-slate-500 hover:text-white transition-colors w-7 h-7 flex items-center justify-center rounded-lg hover:bg-white/5">
                ✕
            </button>
        </div>

        {{-- Info mata kuliah yang dipilih --}}
        <div class="mb-5 bg-[#f97316]/5 border border-[#f97316]/20 rounded-xl px-4 py-3">
            <p class="text-xs text-slate-500 uppercase tracking-widest mb-1">Mata Kuliah</p>
            <p class="text-sm font-semibold text-[#f97316]" id="plot-mapel-name">—</p>
        </div>

        {{-- Form (action set dynamically by JS) --}}
        <form id="form-plot" method="POST" action="">
            @csrf
            <div class="space-y-5">

                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-widest mb-2">
                        Pilih Dosen Pengampu
                    </label>
                    <select name="dosen_id" class="input-cyber" required>
                        <option value="" disabled selected>-- Pilih Dosen --</option>
                        @foreach($dataDosen as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button"
                            onclick="closeModal('modal-plot')"
                            class="flex-1 bg-white/5 hover:bg-white/10 border border-white/10 text-slate-400 hover:text-white text-sm font-semibold py-2.5 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-[#f97316]/10 hover:bg-[#f97316]/20 border border-[#f97316]/40 hover:border-[#f97316]/70 text-[#f97316] text-sm font-bold py-2.5 rounded-xl transition-all duration-200">
                        KONFIRMASI PLOT
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- ═══════════════════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════════════════ --}}
<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
    }

    function openEditDosenModal(dosenId, dosenName) {
        document.getElementById('input-edit-nama-dosen').value = dosenName;
        document.getElementById('form-edit-dosen').action = '/admin/dosen/' + dosenId + '/update';
        openModal('modal-edit-dosen');
    }

    function openPlotModal(mapelId, mapelName) {
        document.getElementById('plot-mapel-name').innerText = mapelName;
        document.getElementById('form-plot').action = '/admin/mapel/' + mapelId + '/plot';
        openModal('modal-plot');
    }

    // Close modal when clicking the overlay (outside the modal-box)
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('active');
            }
        });
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.modal-overlay.active').forEach(function(modal) {
                modal.classList.remove('active');
            });
        }
    });
</script>

</body>
</html>
