<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-grid {
            background-image: linear-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid">

    <!-- NAVBAR -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-indigo-500 shadow-[0_0_20px_rgba(99,102,241,0.4)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-indigo-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(99,102,241,1)]"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">
                    SISTEM KEUANGAN
                </h1>
            </div>
            <a href="/admin/dashboard" class="px-4 py-2 bg-gray-900 border border-indigo-500 text-indigo-400 hover:bg-indigo-500 hover:text-gray-900 rounded transition-all shadow-[0_0_10px_rgba(99,102,241,0.3)] font-bold">
                &larr; KEMBALI
            </a>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="max-w-7xl mx-auto p-6 mt-8">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-indigo-300 drop-shadow-[0_0_8px_rgba(99,102,241,0.5)]">Verifikasi Tagihan</h2>
                <p class="text-indigo-200/60 mt-2">Monitor status pembayaran mahasiswa secara real-time.</p>
            </div>
            <button class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold rounded shadow-[0_0_15px_rgba(99,102,241,0.6)]">
                + BUAT TAGIHAN
            </button>
        </div>

        <!-- TABEL DATA -->
        <div class="bg-gray-900 border border-indigo-600/30 rounded-xl overflow-hidden shadow-[0_0_30px_rgba(99,102,241,0.15)] relative">
            <div class="absolute top-0 left-0 w-32 h-32 bg-indigo-500 rounded-full blur-[80px] opacity-20 pointer-events-none"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-950 border-b border-indigo-800 text-indigo-400 text-sm uppercase">
                        <tr>
                            <th class="p-4">Tanggal Invoice</th>
                            <th class="p-4">Nama Mahasiswa</th>
                            <th class="p-4">Jumlah Tagihan</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataKeuangan as $uang)
                        <tr class="border-b border-gray-800 hover:bg-indigo-900/20 transition-colors">
                            <td class="p-4 text-gray-400 font-mono">{{ $uang->tanggal }}</td>
                            <td class="p-4 text-gray-200 font-bold">{{ $uang->mahasiswa->nama ?? 'Unknown' }}</td>
                            <td class="p-4 text-indigo-300 font-bold">Rp {{ number_format($uang->jumlah, 0, ',', '.') }}</td>
                            <td class="p-4">
                                @if($uang->status == 'lunas')
                                    <span class="px-3 py-1 border border-emerald-500 text-emerald-400 bg-emerald-500/10 rounded-full text-xs shadow-[0_0_10px_rgba(16,185,129,0.3)]">LUNAS</span>
                                @else
                                    <span class="px-3 py-1 border border-red-500 text-red-400 bg-red-500/10 rounded-full text-xs shadow-[0_0_10px_rgba(239,68,68,0.3)]">BELUM LUNAS</span>
                                @endif
                            </td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button class="text-xs px-3 py-1 bg-gray-800 border border-indigo-500/50 text-indigo-400 hover:bg-indigo-500 hover:text-white rounded transition-colors">VERIFIKASI</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-500 font-mono">>> BELUM ADA DATA TAGIHAN <<</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>