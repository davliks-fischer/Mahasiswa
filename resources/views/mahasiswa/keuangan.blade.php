<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Keuangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen p-8">

    <div class="max-w-4xl mx-auto">
        <a href="/mahasiswa/dashboard" class="text-emerald-400 hover:text-emerald-300 mb-6 inline-block">&larr; Kembali ke Dashboard</a>
        
        <h2 class="text-3xl font-bold bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent mb-6">
            Tagihan Keuangan 
        </h2>

        <div class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-[0_0_20px_rgba(16,185,129,0.15)] hover:shadow-[0_0_25px_rgba(16,185,129,0.3)] transition-all">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-900 text-gray-400 text-sm uppercase tracking-wider">
                        <th class="p-4 border-b border-gray-700">Tanggal</th>
                        <th class="p-4 border-b border-gray-700">Jumlah Tagihan</th>
                        <th class="p-4 border-b border-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataKeuangan as $uang)
                    <tr class="border-b border-gray-700/50 hover:bg-gray-700/50 transition-colors">
                        <td class="p-4 text-gray-300">{{ $uang['tanggal'] }}</td>
                        <td class="p-4 font-bold text-white">Rp {{ number_format($uang['jumlah'], 0, ',', '.') }}</td>
                        <td class="p-4">
                            @if($uang['status'] == 'lunas')
                                <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 border border-emerald-500/50 rounded-full text-xs">Lunas</span>
                            @else
                                <span class="px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/50 rounded-full text-xs">Belum Lunas</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if(empty($dataKeuangan))
                <div class="p-6 text-center text-gray-500">Tidak ada data tagihan.</div>
            @endif
        </div>
    </div>

</body>
</html>