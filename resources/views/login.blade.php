<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center font-sans antialiased">

    <!-- Efek Glow di Belakang Card -->
    <div class="relative w-full max-w-md p-8">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 blur-xl opacity-30 rounded-2xl"></div>
        
        <!-- Card Login -->
        <div class="relative bg-gray-800 border border-gray-700 rounded-2xl p-8 shadow-2xl">
            <h2 class="text-3xl font-bold text-center mb-6 bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                System Login
            </h2>

            <!-- Tampilkan Pesan Error Jika Salah Login -->
            @if(session('error'))
                <div class="bg-red-500/20 border border-red-500 text-red-400 p-3 rounded-lg mb-6 text-sm text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="/login" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-400 text-sm mb-2">Username</label>
                    <input type="text" name="username" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-[0_0_0px_rgba(59,130,246,0)] focus:shadow-[0_0_15px_rgba(59,130,246,0.5)]" placeholder="Masukkan username..." required>
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Password</label>
                    <input type="password" name="password" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all shadow-[0_0_0px_rgba(168,85,247,0)] focus:shadow-[0_0_15px_rgba(168,85,247,0.5)]" placeholder="••••••••" required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-500 hover:to-purple-500 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 hover:shadow-[0_0_20px_rgba(168,85,247,0.6)] hover:-translate-y-1">
                    Login
                </button>
            </form>
        </div>
    </div>

</body>
</html>