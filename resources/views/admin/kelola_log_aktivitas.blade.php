<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - Super Admin Terminal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-grid {
            background-image:
                linear-gradient(rgba(59, 130, 246, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59, 130, 246, 0.08) 1px, transparent 1px);
            background-size: 30px 30px;
        }

        @keyframes waveUpCyberpunk {
            0% { opacity: 0; transform: translateY(80px); animation-timing-function: ease-out; }
            45% { opacity: 1; transform: translateY(-12px); animation-timing-function: ease-in-out; }
            70% { transform: translateY(5px); animation-timing-function: ease-in-out; }
            85% { transform: translateY(-2px); animation-timing-function: ease-in-out; }
            100% { opacity: 1; transform: translateY(0); }
        }

        .anim-wave {
            opacity: 0;
            animation: waveUpCyberpunk 1.5s forwards;
            height: 100%;
        }

        .delay-1 { animation-delay: 0.10s; }
        .delay-2 { animation-delay: 0.25s; }

        .stat-card {
            background-color: #111827;
            position: relative;
            z-index: 10;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .theme-blue:hover {
            border-color: #60a5fa;
            box-shadow: 0 15px 35px -5px rgba(59, 130, 246, 0.5), 0 0 25px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid overflow-x-hidden">

    <!-- NAVBAR NEON (sama persis kayak dashboard) -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-blue-500 shadow-[0_0_20px_rgba(59,130,246,0.6)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(59,130,246,1)]"></div>
                <h1 class="text-2xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 drop-shadow-[0_0_10px_rgba(59,130,246,0.8)]">
                    SUPER ADMIN TERMINAL
                </h1>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-300 font-bold hover:text-blue-100 transition-all">&larr; Kembali ke Dashboard</a>
                <span class="text-blue-300 font-bold hidden md:block">ID: {{ $user->username ?? 'ROOT' }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-1.5 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded transition-all shadow-[0_0_10px_rgba(239,68,68,0.3)] hover:shadow-[0_0_20px_rgba(239,68,68,0.8)]">
                        LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA -->
    <div class="max-w-7xl mx-auto p-6 mt-8">

        <div class="mb-10 text-center md:text-left anim-wave delay-1">
            <h2 class="text-4xl font-black text-white drop-shadow-[0_0_8px_rgba(255,255,255,0.5)]">Log Aktivitas</h2>
            <p class="text-blue-400 mt-2 text-lg">Riwayat aksi seluruh admin di sistem.</p>
        </div>

        <div class="anim-wave delay-2">
            <div class="stat-card theme-blue overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="text-xs uppercase text-blue-400 border-b border-gray-700">
                        <tr>
                            <th class="py-3 pr-4">Waktu</th>
                            <th class="py-3 pr-4">User</th>
                            <th class="py-3 pr-4">Aksi</th>
                            <th class="py-3 pr-4">Detail</th>
                            <th class="py-3 pr-4">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataLog as $log)
                            <tr class="border-b border-gray-800 hover:bg-blue-500/5">
                                <td class="py-3 pr-4 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td class="py-3 pr-4">{{ $log->user->username ?? 'System' }}</td>
                                <td class="py-3 pr-4">{{ $log->aksi }}</td>
                                <td class="py-3 pr-4 text-xs text-gray-500 max-w-xs truncate">
                                    {{ $log->detail ? json_encode($log->detail) : '-' }}
                                </td>
                                <td class="py-3 pr-4">{{ $log->ip_address }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-6 text-center text-gray-500">Belum ada aktivitas tercatat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">{{ $dataLog->links() }}</div>
    </div>

</body>
</html>