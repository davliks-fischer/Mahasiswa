<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Keuangan — Super Admin Terminal</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cyan: #00f3ff;
            --green: #39ff14;
            --orange: #f97316;
            --bg: #060b14;
            --bg2: #0b1120;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            background-image:
                linear-gradient(rgba(0,243,255,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,243,255,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            min-height: 100vh;
            color: #e2e8f0;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--cyan); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #00c8d4; }

        /* Animations */
        @keyframes waveUp {
            0%   { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.4; transform: scale(0.7); }
        }
        @keyframes glow-border {
            0%, 100% { box-shadow: 0 0 8px rgba(0,243,255,0.3); }
            50%       { box-shadow: 0 0 20px rgba(0,243,255,0.6); }
        }

        .wave-1 { animation: waveUp 0.6s ease both; }
        .wave-2 { animation: waveUp 0.6s ease 0.1s both; }
        .wave-3 { animation: waveUp 0.6s ease 0.2s both; }
        .wave-4 { animation: waveUp 0.6s ease 0.3s both; }
        .wave-5 { animation: waveUp 0.6s ease 0.4s both; }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(6,11,20,0.90);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,243,255,0.30);
            box-shadow: 0 0 20px rgba(0,243,255,0.15);
            padding: 0 2rem;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--cyan);
            box-shadow: 0 0 8px var(--cyan);
            animation: pulse-dot 1.8s ease-in-out infinite;
        }
        .brand-text {
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            background: linear-gradient(90deg, var(--cyan), #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-outline-cyan {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border: 1px solid rgba(0,243,255,0.5);
            border-radius: 8px;
            color: var(--cyan);
            font-family: inherit;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-decoration: none;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-outline-cyan:hover {
            background: rgba(0,243,255,0.1);
            box-shadow: 0 0 12px rgba(0,243,255,0.3);
            border-color: var(--cyan);
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border: 1px solid rgba(249,115,22,0.5);
            border-radius: 8px;
            color: var(--orange);
            font-family: inherit;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background: rgba(249,115,22,0.1);
            box-shadow: 0 0 12px rgba(249,115,22,0.3);
            border-color: var(--orange);
        }

        /* Main */
        .main-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* Page header */
        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px;
            border: 1px solid rgba(249,115,22,0.35);
            border-radius: 999px;
            background: rgba(249,115,22,0.07);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: var(--orange);
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 0.4rem;
        }
        .page-title span { color: var(--orange); }

        .page-desc {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 2rem;
        }

        /* Stats bar */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg2);
            border: 1px solid rgba(0,243,255,0.12);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover {
            border-color: rgba(0,243,255,0.3);
            box-shadow: 0 0 20px rgba(0,243,255,0.08);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--cyan), transparent);
            opacity: 0.5;
        }
        .stat-card.orange::before {
            background: linear-gradient(90deg, transparent, var(--orange), transparent);
        }
        .stat-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            color: #475569;
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }
        .stat-value {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1;
            word-break: break-all;
        }
        .stat-value.cyan   { color: var(--cyan); }
        .stat-value.green  { color: var(--green); }
        .stat-value.red    { color: #f87171; }
        .stat-value.orange { color: var(--orange); }

        /* Filter badges */
        .filter-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
            flex-wrap: wrap;
        }
        .filter-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            color: #475569;
            text-transform: uppercase;
            margin-right: 0.25rem;
        }
        .filter-btn {
            padding: 5px 14px;
            border-radius: 999px;
            border: 1px solid rgba(0,243,255,0.25);
            background: transparent;
            color: #64748b;
            font-family: inherit;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.18s;
        }
        .filter-btn:hover,
        .filter-btn.active {
            border-color: var(--cyan);
            color: var(--cyan);
            background: rgba(0,243,255,0.08);
            box-shadow: 0 0 10px rgba(0,243,255,0.2);
        }

        /* Table container */
        .table-wrap {
            background: var(--bg2);
            border: 1px solid rgba(0,243,255,0.15);
            border-radius: 16px;
            overflow: hidden;
            animation: glow-border 3s ease-in-out infinite;
        }

        .table-scroll { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--bg);
            border-bottom: 1px solid rgba(0,243,255,0.20);
        }
        thead th {
            padding: 14px 18px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--cyan);
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: background 0.15s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(0,243,255,0.05); }
        tbody tr.hidden-row { display: none; }

        td {
            padding: 14px 18px;
            font-size: 0.82rem;
            vertical-align: middle;
        }

        .td-mono {
            font-family: 'Courier New', monospace;
            font-size: 0.78rem;
            color: #94a3b8;
        }
        .td-name {
            font-weight: 700;
            color: #fff;
        }
        .td-amount {
            font-family: 'Courier New', monospace;
            font-size: 0.82rem;
            font-weight: 700;
            color: #e2e8f0;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.67rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }
        .badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
        }
        .badge-green {
            background: rgba(57,255,20,0.1);
            border: 1px solid rgba(57,255,20,0.35);
            color: var(--green);
        }
        .badge-green::before { background: var(--green); }
        .badge-red {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.35);
            color: #f87171;
        }
        .badge-red::before { background: #f87171; }

        /* Verifikasi button */
        .btn-verifikasi {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border: 1px solid rgba(0,243,255,0.4);
            border-radius: 7px;
            color: var(--cyan);
            font-family: inherit;
            font-size: 0.71rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: transparent;
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
        }
        .btn-verifikasi:hover {
            background: rgba(0,243,255,0.1);
            box-shadow: 0 0 10px rgba(0,243,255,0.25);
            border-color: var(--cyan);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }
        .empty-emoji { font-size: 3rem; margin-bottom: 1rem; }
        .empty-title {
            font-size: 1rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 0.35rem;
        }
        .empty-sub { font-size: 0.8rem; color: #334155; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .navbar { padding: 0 1rem; }
            .main-wrap { padding: 1.5rem 1rem 3rem; }
        }
    </style>
</head>
<body>

{{-- ============================================================ NAVBAR --}}
<nav class="navbar">
    <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
        <div class="brand-dot"></div>
        <span class="brand-text">Super Admin Terminal</span>
    </a>
    <div class="navbar-actions">
        <a href="{{ route('admin.dashboard') }}" class="btn-outline-cyan">
            ← Kembali
        </a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn-logout">
                ⏻ Logout
            </button>
        </form>
    </div>
</nav>

{{-- ============================================================ MAIN --}}
<main class="main-wrap">

    {{-- Page header --}}
    <div class="wave-1">
        <div class="page-badge">💳 Sistem Keuangan</div>
        <h1 class="page-title">Verifikasi <span>Tagihan</span></h1>
        <p class="page-desc">Pantau dan verifikasi seluruh tagihan pembayaran mahasiswa di satu tempat.</p>
    </div>

    {{-- Stats bar --}}
    @php
        $totalLunas = $dataKeuangan->where('status', 'lunas')->sum('jumlah');
        $totalBelum = $dataKeuangan->where('status', 'belum')->sum('jumlah');
    @endphp

    <div class="stats-grid wave-2">
        <div class="stat-card orange">
            <div class="stat-label">Total Tagihan</div>
            <div class="stat-value orange">{{ $dataKeuangan->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Lunas</div>
            <div class="stat-value green" style="font-size:1.15rem;">
                Rp {{ number_format($totalLunas, 0, ',', '.') }}
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Total Belum Lunas</div>
            <div class="stat-value red" style="font-size:1.15rem;">
                Rp {{ number_format($totalBelum, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Filter badges --}}
    <div class="filter-row wave-3">
        <span class="filter-label">Filter:</span>
        <button class="filter-btn active" onclick="filterTable('all', this)">Semua</button>
        <button class="filter-btn" onclick="filterTable('lunas', this)">Lunas</button>
        <button class="filter-btn" onclick="filterTable('belum', this)">Belum Lunas</button>
    </div>

    {{-- Table --}}
    <div class="table-wrap wave-4">
        <div class="table-scroll">
            <table id="keuangan-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataKeuangan as $i => $uang)
                        @php
                            $statusNorm = strtolower($uang->status ?? '');
                            $isLunas    = $statusNorm === 'lunas';
                        @endphp
                        <tr data-status="{{ $statusNorm }}">
                            <td class="td-mono">{{ $i + 1 }}</td>
                            <td class="td-mono">
                                {{ \Carbon\Carbon::parse($uang->tanggal ?? $uang->created_at)->format('d M Y') }}
                            </td>
                            <td class="td-name">{{ $uang->mahasiswa->nama ?? '-' }}</td>
                            <td class="td-amount">
                                Rp {{ number_format($uang->jumlah, 0, ',', '.') }}
                            </td>
                            <td>
                                @if ($isLunas)
                                    <span class="badge badge-green">Lunas</span>
                                @else
                                    <span class="badge badge-red">Belum</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn-verifikasi" type="button"
                                    onclick="handleVerifikasi({{ $uang->id ?? 0 }})">
                                    ✓ Verifikasi
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-emoji">💸</div>
                                    <div class="empty-title">Belum ada data tagihan</div>
                                    <div class="empty-sub">Data keuangan mahasiswa akan tampil di sini setelah diinput.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</main>

<script>
    function filterTable(filter, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const rows = document.querySelectorAll('#keuangan-table tbody tr[data-status]');
        rows.forEach(row => {
            if (filter === 'all') {
                row.classList.remove('hidden-row');
            } else {
                const status = row.getAttribute('data-status') || '';
                row.classList.toggle('hidden-row', status !== filter);
            }
        });
    }

    function handleVerifikasi(id) {
        // Placeholder — implementasi sesuai kebutuhan
        console.log('Verifikasi tagihan ID:', id);
    }
</script>

</body>
</html>
