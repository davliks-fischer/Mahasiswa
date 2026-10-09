<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Tugas — Portal Dosen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

        /* ============================
           1. BASE — AMBER CYBERPUNK
        ============================ */
        :root {
            --amber: #f59e0b;
            --amber-glow: rgba(245, 158, 11, 0.5);
            --amber-faint: rgba(245, 158, 11, 0.07);
            --bg: #07080f;
        }

        body {
            background-color: var(--bg) !important;
            color: #e2e8f0 !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Grid diagonal — beda dari grid lurus milik admin/mahasiswa */
        .hex-grid {
            background-image:
                repeating-linear-gradient(
                    60deg,
                    rgba(245, 158, 11, 0.04) 0px,
                    rgba(245, 158, 11, 0.04) 1px,
                    transparent 1px,
                    transparent 40px
                ),
                repeating-linear-gradient(
                    -60deg,
                    rgba(245, 158, 11, 0.04) 0px,
                    rgba(245, 158, 11, 0.04) 1px,
                    transparent 1px,
                    transparent 40px
                );
        }

        /* ============================
           2. ANIMASI
        ============================ */
        @keyframes waveUp {
            0%   { opacity: 0; transform: translateY(60px); }
            50%  { opacity: 1; transform: translateY(-8px); }
            75%  { transform: translateY(3px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .anim-wave { opacity: 0; animation: waveUp 1.2s cubic-bezier(0.25, 1, 0.5, 1) forwards; }
        .delay-1 { animation-delay: 0.10s; }
        .delay-2 { animation-delay: 0.25s; }
        .delay-3 { animation-delay: 0.40s; }
        .delay-4 { animation-delay: 0.55s; }

        @keyframes scanline {
            0%   { top: -10%; }
            100% { top: 110%; }
        }
        .scanline-wrap { position: fixed; inset: 0; pointer-events: none; overflow: hidden; z-index: 0; }
        .scanline {
            position: absolute;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(transparent, rgba(245,158,11,0.06), transparent);
            animation: scanline 8s linear infinite;
        }

        /* ============================
           3. CARD
        ============================ */
        .amber-card {
            background-color: #0e1120;
            border: 1px solid rgba(245, 158, 11, 0.12);
            border-radius: 1rem;
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .amber-card:hover {
            border-color: var(--amber);
            box-shadow: 0 0 28px rgba(245, 158, 11, 0.25), inset 0 0 14px rgba(245, 158, 11, 0.04);
        }

        /* ============================
           4. TUGAS FILE CARD
        ============================ */
        .file-card {
            background: #0b0d1a;
            border: 1px solid rgba(245, 158, 11, 0.15);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .file-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: linear-gradient(to bottom, transparent, var(--amber), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .file-card:hover {
            border-color: rgba(245, 158, 11, 0.5);
            transform: translateX(4px);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
        }
        .file-card:hover::before { opacity: 1; }

        /* ============================
           5. INPUT FIELDS
        ============================ */
        .input-field {
            background: #060810 !important;
            border: 1px solid rgba(245, 158, 11, 0.2) !important;
            color: #e2e8f0 !important;
            border-radius: 0.5rem;
            transition: border-color 0.3s, box-shadow 0.3s;
            outline: none;
            width: 100%;
            padding: 0.6rem 0.85rem;
            font-size: 0.875rem;
        }
        .input-field:focus {
            border-color: var(--amber) !important;
            box-shadow: 0 0 12px rgba(245, 158, 11, 0.25);
        }
        .input-field::placeholder { color: #4b5563; }

        /* ============================
           6. DROP ZONE
        ============================ */
        #drop-zone {
            border: 2px dashed rgba(245, 158, 11, 0.3);
            border-radius: 0.75rem;
            background: rgba(245, 158, 11, 0.02);
            cursor: pointer;
            transition: all 0.3s;
        }
        #drop-zone.drag-over,
        #drop-zone:hover {
            border-color: var(--amber);
            background: rgba(245, 158, 11, 0.06);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.2);
        }

        /* ============================
           7. TOMBOL
        ============================ */
        .btn-amber {
            background: var(--amber);
            color: #07080f;
            font-weight: 800;
            padding: 0.65rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
        }
        .btn-amber:hover {
            background: #fbbf24;
            box-shadow: 0 0 22px rgba(245, 158, 11, 0.55);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: transparent;
            color: #ef4444;
            border: 1px solid rgba(239, 68, 68, 0.4);
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 0.4rem;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 600;
        }
        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            box-shadow: 0 0 10px rgba(239,68,68,0.3);
        }

        /* ============================
           8. BADGE MAPEL
        ============================ */
        .badge-mapel {
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--amber);
            font-size: 0.65rem;
            font-weight: 700;
            padding: 0.15rem 0.5rem;
            border-radius: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* ============================
           9. ALERT
        ============================ */
        .alert-success {
            background: rgba(34,197,94,0.08);
            border: 1px solid rgba(34,197,94,0.3);
            color: #86efac;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }
        .alert-error {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.3);
            color: #fca5a5;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        /* amber text glow */
        .amber-glow {
            color: var(--amber);
            text-shadow: 0 0 12px rgba(245, 158, 11, 0.7);
        }

        /* stat block separator */
        .sep-v {
            position: absolute; right: 0; top: 15%; height: 70%; width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(245,158,11,0.3), transparent);
        }

        /* File extension icon colors */
        .ext-pdf  { color: #ef4444; }
        .ext-doc  { color: #3b82f6; }
        .ext-ppt  { color: #f97316; }
        .ext-xls  { color: #22c55e; }
        .ext-zip  { color: #a855f7; }
        .ext-img  { color: #ec4899; }
        .ext-default { color: var(--amber); }
    </style>
</head>
<body class="font-sans antialiased min-h-screen hex-grid overflow-x-hidden flex flex-col">

    <!-- Scanline Effect -->
    <div class="scanline-wrap"><div class="scanline"></div></div>

    <!-- ═══════════════ NAVBAR ═══════════════ -->
    <nav class="border-b border-amber-500/30 shadow-[0_0_20px_rgba(245,158,11,0.15)] p-4 sticky top-0 z-50 bg-[#07080f]/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- LOGO + LINKS -->
            <div class="flex items-center space-x-6">
                <div class="flex items-center space-x-3">
                    <div class="w-2.5 h-2.5 rounded-full animate-pulse" style="background: #f59e0b; box-shadow: 0 0 12px #f59e0b;"></div>
                    <span class="text-lg font-black tracking-widest text-transparent bg-clip-text"
                          style="background-image: linear-gradient(to right, #f59e0b, #fcd34d);">
                        PORTAL DOSEN
                    </span>
                </div>
                <!-- Nav Links -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dosen.dashboard') }}"
                       class="px-3 py-1.5 text-sm text-gray-400 hover:text-amber-400 rounded transition-colors hover:bg-amber-500/10 font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('dosen.tugas') }}"
                       class="px-3 py-1.5 text-sm rounded font-bold transition-all"
                       style="color:#f59e0b; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.3); text-shadow: 0 0 8px rgba(245,158,11,0.6);">
                        Upload Tugas
                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-5">
                <span class="text-gray-400 text-xs hidden md:block">
                    NIDN: <span class="font-bold amber-glow">{{ $user->username ?? '–' }}</span>
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-3 py-1.5 border border-red-500/60 text-red-400 hover:bg-red-500 hover:text-white rounded transition-all text-xs font-bold tracking-wider">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ═══════════════ KONTEN ═══════════════ -->
    <div class="relative z-10 max-w-7xl mx-auto p-6 mt-8 w-full">

        <!-- ── HEADER ── -->
        <div class="anim-wave delay-1 mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <!-- Upload icon -->
                <svg class="w-8 h-8 amber-glow flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-white">
                        Upload <span class="amber-glow">Tugas</span>
                    </h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola dan distribusikan materi tugas ke mahasiswa</p>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="anim-wave delay-1 alert-success mb-6 flex items-center space-x-2">
            <svg class="w-4 h-4 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="anim-wave delay-1 alert-error mb-6 flex items-center space-x-2">
            <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="anim-wave delay-1 alert-error mb-6">
            <p class="font-bold mb-1">Ada kesalahan input:</p>
            <ul class="list-disc list-inside space-y-0.5 text-sm">
                @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!$dosen)
        <!-- WARNING: Dosen belum terhubung ke akun user -->
        <div class="anim-wave delay-2 alert-error mb-8">
            <p class="font-bold">⚠ Akun ini belum terhubung ke data dosen.</p>
            <p class="text-sm mt-1 text-red-300">Hubungi administrator untuk menghubungkan akun Anda dengan data dosen di sistem.</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            <!-- ═══════════════════════════════════════
                 KOLOM KIRI — FORM UPLOAD (2/5)
            ════════════════════════════════════════ -->
            <div class="lg:col-span-2 anim-wave delay-2">
                <div class="amber-card p-6 h-full">
                    <!-- Top accent line -->
                    <div class="w-1/2 h-px mb-6" style="background: linear-gradient(to right, #f59e0b, transparent);"></div>

                    <h3 class="text-sm font-black tracking-widest text-amber-400 uppercase mb-5 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Form Upload Baru</span>
                    </h3>

                    <form action="{{ route('dosen.tugas.upload') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                        @csrf
                        <div class="space-y-4">

                            <!-- Judul -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    Judul Tugas <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="judul" required
                                       class="input-field"
                                       placeholder="Contoh: Tugas UTS Algoritma"
                                       value="{{ old('judul') }}">
                            </div>

                            <!-- Mata Kuliah -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    Mata Kuliah
                                </label>
                                <select name="mapel_id" class="input-field">
                                    <option value="">— Semua / Tidak spesifik —</option>
                                    @foreach($dataMapel as $mapel)
                                    <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                        {{ $mapel->nama_mapel }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Deadline -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    Deadline
                                </label>
                                <input type="date" name="deadline"
                                       class="input-field"
                                       value="{{ old('deadline') }}"
                                       min="{{ date('Y-m-d') }}">
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    Deskripsi / Instruksi
                                </label>
                                <textarea name="deskripsi" rows="3"
                                          class="input-field resize-none"
                                          placeholder="Tuliskan instruksi pengerjaan tugas...">{{ old('deskripsi') }}</textarea>
                            </div>

                            <!-- Drop Zone Upload File -->
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    File <span class="text-red-400">*</span>
                                </label>

                                <div id="drop-zone" class="p-6 text-center" onclick="document.getElementById('file-input').click()">
                                    <input type="file" id="file-input" name="file" class="hidden" required
                                           accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar,.png,.jpg,.jpeg">

                                    <div id="drop-icon">
                                        <svg class="w-10 h-10 mx-auto mb-2 text-amber-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                        <p class="text-xs text-gray-500">Klik atau drag & drop file di sini</p>
                                        <p class="text-xs text-gray-600 mt-1">PDF, DOC, PPT, XLS, ZIP, gambar — maks 20 MB</p>
                                    </div>
                                    <div id="drop-preview" class="hidden">
                                        <p class="text-amber-400 font-bold text-sm" id="file-name-preview"></p>
                                        <p class="text-gray-500 text-xs mt-0.5" id="file-size-preview"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn-amber w-full flex items-center justify-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <span>UPLOAD TUGAS</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- ═══════════════════════════════════════
                 KOLOM KANAN — DAFTAR TUGAS (3/5)
            ════════════════════════════════════════ -->
            <div class="lg:col-span-3 anim-wave delay-3">

                <!-- Statistik mini -->
                <div class="amber-card p-5 mb-5 relative overflow-hidden">
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-[2px]"
                         style="background: #f59e0b; box-shadow: 0 0 12px #f59e0b;"></div>

                    <div class="grid grid-cols-3 gap-4 text-center relative">
                        <div class="relative">
                            <p class="text-3xl font-black amber-glow">{{ $listTugas->count() }}</p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1 font-bold">Total Tugas</p>
                        </div>
                        <div class="relative">
                            <div class="sep-v"></div>
                            <p class="text-3xl font-black text-white" style="text-shadow:0 0 10px rgba(255,255,255,0.2)">
                                {{ $dataMapel->count() }}
                            </p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1 font-bold">Mata Kuliah</p>
                            <div class="sep-v" style="left:unset; right:0;"></div>
                        </div>
                        <div class="relative">
                            <p class="text-3xl font-black text-amber-300">
                                {{ $listTugas->where('deadline', '>=', now()->toDateString())->count() }}
                            </p>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest mt-1 font-bold">Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- List Tugas -->
                <div class="amber-card p-0 overflow-hidden">
                    <div class="flex items-center justify-between p-5 border-b border-amber-500/10">
                        <h3 class="text-sm font-black tracking-widest text-amber-400 uppercase flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Daftar Tugas Diupload</span>
                        </h3>
                        <span class="text-xs text-gray-600 font-mono">{{ $listTugas->count() }} file</span>
                    </div>

                    @if($listTugas->isEmpty())
                    <div class="py-16 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-amber-500/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-600 font-mono text-sm">[ BELUM ADA TUGAS DIUPLOAD ]</p>
                        <p class="text-gray-700 text-xs mt-1">Gunakan form di kiri untuk upload tugas pertama</p>
                    </div>
                    @else
                    <div class="divide-y divide-amber-500/5">
                        @foreach($listTugas as $tugas)
                        @php
                            $ext = strtolower(pathinfo($tugas->file_name, PATHINFO_EXTENSION));
                            $extClass = match(true) {
                                $ext === 'pdf'              => 'ext-pdf',
                                in_array($ext, ['doc','docx']) => 'ext-doc',
                                in_array($ext, ['ppt','pptx']) => 'ext-ppt',
                                in_array($ext, ['xls','xlsx']) => 'ext-xls',
                                in_array($ext, ['zip','rar']) => 'ext-zip',
                                in_array($ext, ['jpg','jpeg','png']) => 'ext-img',
                                default => 'ext-default',
                            };
                            $isExpired  = $tugas->deadline && $tugas->deadline->isPast();
                            $isDeadlineNear = $tugas->deadline && !$isExpired && $tugas->deadline->diffInDays(now()) <= 3;
                        @endphp

                        <div class="file-card mx-4 my-3 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <!-- File Icon + Info -->
                                <div class="flex items-start space-x-3 min-w-0 flex-1">
                                    <!-- Extension Badge -->
                                    <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-lg bg-gray-900 border border-gray-800">
                                        <span class="text-xs font-black {{ $extClass }} uppercase">{{ $ext }}</span>
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <p class="text-white font-bold text-sm truncate leading-tight">{{ $tugas->judul }}</p>

                                        <!-- Meta row -->
                                        <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                                            @if($tugas->mapel)
                                            <span class="badge-mapel">{{ $tugas->mapel->nama_mapel }}</span>
                                            @endif

                                            @if($tugas->deadline)
                                                @if($isExpired)
                                                <span class="text-xs px-2 py-0.5 rounded bg-red-900/30 border border-red-500/30 text-red-400 font-bold">
                                                    Expired {{ $tugas->deadline->format('d M Y') }}
                                                </span>
                                                @elseif($isDeadlineNear)
                                                <span class="text-xs px-2 py-0.5 rounded bg-amber-900/30 border border-amber-500/40 text-amber-300 font-bold animate-pulse">
                                                    ⚡ {{ $tugas->deadline->format('d M Y') }}
                                                </span>
                                                @else
                                                <span class="text-xs text-gray-500">
                                                    Deadline: {{ $tugas->deadline->format('d M Y') }}
                                                </span>
                                                @endif
                                            @endif
                                        </div>

                                        @if($tugas->deskripsi)
                                        <p class="text-gray-600 text-xs mt-1.5 line-clamp-1">{{ $tugas->deskripsi }}</p>
                                        @endif

                                        <!-- File meta -->
                                        <div class="flex items-center space-x-3 mt-2 text-xs text-gray-600">
                                            <span class="font-mono">{{ $tugas->file_name }}</span>
                                            <span>•</span>
                                            <span>{{ $tugas->formatted_file_size }}</span>
                                            <span>•</span>
                                            <span>{{ $tugas->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Aksi -->
                                <div class="flex items-center space-x-2 flex-shrink-0">
                                    <a href="{{ asset('storage/' . $tugas->file_path) }}"
                                       target="_blank"
                                       class="text-xs px-2.5 py-1 rounded border border-amber-500/30 text-amber-400 hover:bg-amber-500/10 transition-all font-bold">
                                        ↓ Lihat
                                    </a>

                                    <form action="{{ route('dosen.tugas.hapus', $tugas->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus tugas ini? File juga akan dihapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>
        </div>

    </div><!-- END KONTEN -->

    <!-- ═══════════════ FOOTER ═══════════════ -->
    <footer class="mt-auto border-t border-amber-500/10 py-4 text-center z-10 relative">
        <p class="text-xs text-gray-700 font-mono tracking-widest">
            PORTAL DOSEN &mdash; SISTEM AKADEMIK &copy; {{ date('Y') }}
        </p>
    </footer>

    <script>
        // ─── File Input Preview ───────────────────────────────────────────────
        const fileInput  = document.getElementById('file-input');
        const dropZone   = document.getElementById('drop-zone');
        const dropIcon   = document.getElementById('drop-icon');
        const dropPreview = document.getElementById('drop-preview');
        const fileNameP  = document.getElementById('file-name-preview');
        const fileSizeP  = document.getElementById('file-size-preview');

        function formatBytes(bytes) {
            if (bytes < 1024)       return bytes + ' B';
            if (bytes < 1048576)    return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        }

        function showFilePreview(file) {
            fileNameP.textContent = file.name;
            fileSizeP.textContent = formatBytes(file.size);
            dropIcon.classList.add('hidden');
            dropPreview.classList.remove('hidden');
        }

        fileInput.addEventListener('change', () => {
            if (fileInput.files[0]) showFilePreview(fileInput.files[0]);
        });

        // Drag & Drop
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('drag-over');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const file = e.dataTransfer.files[0];
            if (file) {
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
                showFilePreview(file);
            }
        });

        // ─── Auto-dismiss alerts ──────────────────────────────────────────────
        setTimeout(() => {
            document.querySelectorAll('.alert-success, .alert-error').forEach(el => {
                el.style.transition = 'opacity 0.6s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 700);
            });
        }, 4000);
    </script>
</body>
</html>
