<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas Admin — Super Admin Terminal</title>
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
        @keyframes scan-line {
            0%   { top: 0; opacity: 0.6; }
            100% { top: 100%; opacity: 0; }
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

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 5px 12px;
            border: 1px solid rgba(0,243,255,0.2);
            border-radius: 999px;
            background: rgba(0,243,255,0.05);
            font-size: 0.72rem;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.08em;
        }
        .user-chip span { color: var(--cyan); }

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
            max-width: 1440px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 4rem;
        }

        /* Page header */
        .page-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 5px 14px;
            border: 1px solid rgba(0,243,255,0.3);
            border-radius: 999px;
            background: rgba(0,243,255,0.06);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: var(--cyan);
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
        .page-title span { color: var(--cyan); }

        .page-desc {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 1.5rem;
        }

        /* Stats mini */
        .stats-mini {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-mini-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            background: var(--bg2);
            border: 1px solid rgba(0,243,255,0.15);
            border-radius: 10px;
            transition: border-color 0.2s;
        }
        .stat-mini-card:hover { border-color: rgba(0,243,255,0.35); }
        .stat-mini-icon {
            font-size: 1.2rem;
        }
        .stat-mini-info {}
        .stat-mini-label {
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            color: #475569;
            text-transform: uppercase;
        }
        .stat-mini-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--cyan);
            line-height: 1;
        }

        /* Live indicator */
        .live-indicator {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--green);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }
        .live-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 6px var(--green);
            animation: pulse-dot 1.2s ease-in-out infinite;
        }

        /* Table container */
        .table-wrap {
            background: var(--bg2);
            border: 1px solid rgba(0,243,255,0.15);
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            animation: glow-border 3s ease-in-out infinite;
        }

        .table-scan {
            position: absolute;
            left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(0,243,255,0.4), transparent);
            animation: scan-line 4s linear infinite;
            pointer-events: none;
            z-index: 2;
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

        td {
            padding: 12px 18px;
            font-size: 0.82rem;
            vertical-align: middle;
        }

        .td-time {
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            color: #64748b;
            white-space: nowrap;
        }
        .td-user {
            font-weight: 700;
            color: var(--cyan);
            white-space: nowrap;
        }
        .td-aksi {
            font-weight: 600;
            color: #e2e8f0;
        }
        .td-detail {
            font-family: 'Courier New', monospace;
            font-size: 0.72rem;
            color: #475569;
            max-width: 260px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .td-ip {
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            color: #475569;
            white-space: nowrap;
        }

        /* Action badge chip */
        .aksi-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 2px 9px;
            border-radius: 5px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            background: rgba(0,243,255,0.07);
            border: 1px solid rgba(0,243,255,0.18);
            color: var(--cyan);
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

        /* Pagination */
        .pagination-wrap {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }
        .pagination-wrap nav { width: 100%; display: flex; justify-content: center; }

        /* Override Laravel default pagination styling */
        .pagination-wrap .pagination {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            flex-wrap: wrap;
            justify-content: center;
        }
        .pagination-wrap .pagination li a,
        .pagination-wrap .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 10px;
            border-radius: 7px;
            border: 1px solid rgba(0,243,255,0.2);
            background: var(--bg2);
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            text-decoration: none;
            transition: all 0.18s;
        }
        .pagination-wrap .pagination li a:hover {
            border-color: var(--cyan);
            color: var(--cyan);
            background: rgba(0,243,255,0.08);
        }
        .pagination-wrap .pagination li span.active,
        .pagination-wrap .pagination li.active span,
        .pagination-wrap .pagination li.active a {
            border-color: var(--cyan);
            color: var(--cyan);
            background: rgba(0,243,255,0.12);
            box-shadow: 0 0 10px rgba(0,243,255,0.2);
        }
        .pagination-wrap .pagination li span[aria-disabled="true"],
        .pagination-wrap .pagination li.disabled span,
        .pagination-wrap .pagination li.disabled a {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .navbar { padding: 0 1rem; }
            .main-wrap { padding: 1.5rem 1rem 3rem; }
            .navbar-right .user-chip { display: none; }
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
    <div class="navbar-right">
        <div class="user-chip">
            ⬡ <span>{{ $user->username ?? 'ROOT' }}</span>
        </div>
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
    </div>
</nav>

{{-- ============================================================ MAIN --}}
<main class="main-wrap">

    {{-- Page header --}}
    <div class="wave-1">
        <div class="page-badge">🔍 Audit Trail</div>
        <h1 class="page-title">Log Aktivitas <span>Admin</span></h1>
        <p class="page-desc">Rekam jejak seluruh aktivitas administrator sistem secara kronologis dan terperinci.</p>
    </div>

    {{-- Stats mini --}}
    <div class="stats-mini wave-2">
        <div class="stat-mini-card">
            <div class="stat-mini-icon">🗂️</div>
            <div class="stat-mini-info">
                <div class="stat-mini-label">Total Log</div>
                <div class="stat-mini-value">{{ $dataLog->total() }}</div>
            </div>
        </div>
        <div class="live-indicator">
            <div class="live-dot"></div>
            Live Audit Trail
        </div>
    </div>

    {{-- Table --}}
    <div class="table-wrap wave-3">
        <div class="table-scan"></div>
        <div class="table-scroll">
            <table id="log-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Detail</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataLog as $i => $log)
                        <tr>
                            <td class="td-time">
                                {{ ($dataLog->currentPage() - 1) * $dataLog->perPage() + $i + 1 }}
                            </td>
                            <td class="td-time">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="td-user">
                                {{ $log->user->username ?? 'System' }}
                            </td>
                            <td class="td-aksi">
                                <span class="aksi-chip">{{ $log->aksi }}</span>
                            </td>
                            <td class="td-detail" title="{{ json_encode($log->detail) ?? '-' }}">
                                {{ json_encode($log->detail) ?? '-' }}
                            </td>
                            <td class="td-ip">{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-emoji">🔕</div>
                                    <div class="empty-title">Belum ada log aktivitas</div>
                                    <div class="empty-sub">Setiap aktivitas admin akan tercatat otomatis di sini.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-8 flex justify-center [&_.pagination]:flex [&_.pagination]:gap-2">
        {{ $dataLog->links() }}
    </div>

</main>

</body>
</html>
