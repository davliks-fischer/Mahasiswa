<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Dosen & Mapel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cyber-grid {
            background-image: linear-gradient(rgba(34, 211, 238, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(34, 211, 238, 0.05) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        /* Efek Transisi Modal */
        .modal-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            transform: scale(0.9);
            transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .modal-overlay.active .modal-box {
            transform: scale(1);
        }
    </style>
</head>
<body class="bg-gray-950 text-white font-sans antialiased min-h-screen cyber-grid">

    <!-- NAVBAR -->
    <nav class="bg-gray-950/80 backdrop-blur-md border-b border-cyan-500 shadow-[0_0_20px_rgba(34,211,238,0.4)] p-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-3 h-3 bg-cyan-500 rounded-full animate-pulse shadow-[0_0_10px_rgba(34,211,238,1)]"></div>
                <h1 class="text-xl font-black tracking-widest text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-400">
                    MODUL DOSEN & MAPEL
                </h1>
            </div>
            <a href="/admin/dashboard" class="px-4 py-2 bg-gray-900 border border-cyan-500 text-cyan-400 hover:bg-cyan-500 hover:text-gray-900 rounded transition-all shadow-[0_0_10px_rgba(34,211,238,0.3)] font-bold">
                &larr; KEMBALI
            </a>
        </div>
    </nav>

    <!-- KONTEN -->
    <div class="max-w-7xl mx-auto p-6 mt-8 space-y-12">
        
        <!-- ============================================== -->
        <!-- ZONA NOTIFIKASI (RADAR SUKSES & ERROR) -->
        <!-- ============================================== -->
        @if(session('success'))
            <div class="p-4 bg-cyan-900/50 border border-cyan-500 text-cyan-300 rounded-lg shadow-[0_0_15px_rgba(34,211,238,0.3)]">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-red-900/50 border border-red-500 text-red-300 rounded-lg shadow-[0_0_15px_rgba(239,68,68,0.3)]">
                ⚠️ <span class="font-bold">Akses Ditolak:</span>
                <ul class="list-disc pl-5 mt-2 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- ============================================== -->

        <!-- SECTION DOSEN -->
        <div>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-black text-cyan-300 drop-shadow-[0_0_8px_rgba(34,211,238,0.5)]">Data Master Dosen</h2>
                <button onclick="openModal('modal-dosen')" class="px-4 py-2 bg-cyan-600 hover:bg-cyan-500 text-white font-bold rounded shadow-[0_0_15px_rgba(34,211,238,0.5)] transition-all">
                    + TAMBAH DOSEN
                </button>
            </div>
            
            <div class="bg-gray-900 border border-cyan-600/30 rounded-xl overflow-hidden shadow-[0_0_20px_rgba(34,211,238,0.1)]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-950 border-b border-cyan-800 text-cyan-500 text-sm uppercase">
                        <tr>
                            <th class="p-4">ID Dosen</th>
                            <th class="p-4">Nama Lengkap</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataDosen as $dosen)
                        <tr class="border-b border-gray-800 hover:bg-cyan-900/20">
                            <td class="p-4 font-mono text-gray-400">DSN-{{ $dosen->id }}</td>
                            <td class="p-4 text-gray-200 font-bold">{{ $dosen->nama_dosen }}</td>
                            <td class="p-4 flex justify-center space-x-2">
                                <!-- TOMBOL EDIT DOSEN -->
                                <button onclick="openEditDosenModal({{ $dosen->id }}, '{{ $dosen->nama_dosen }}')" class="text-xs px-3 py-1 bg-gray-800 border border-cyan-500/50 text-cyan-400 hover:bg-cyan-500 hover:text-gray-900 rounded transition-colors shadow-[0_0_10px_rgba(34,211,238,0.2)] font-bold">
                                    EDIT
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SECTION MAPEL -->
        <div>
            <div class="flex justify-between items-end mb-6">
                <h2 class="text-2xl font-black text-blue-300 drop-shadow-[0_0_8px_rgba(59,130,246,0.5)]">Alokasi Mata Kuliah</h2>
                <button onclick="openModal('modal-mapel')" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded shadow-[0_0_15px_rgba(59,130,246,0.5)] transition-all">
                    + TAMBAH MAPEL
                </button>
            </div>
            
            <div class="bg-gray-900 border border-blue-600/30 rounded-xl overflow-hidden shadow-[0_0_20px_rgba(59,130,246,0.1)]">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-950 border-b border-blue-800 text-blue-400 text-sm uppercase">
                        <tr>
                            <th class="p-4">Nama Mapel</th>
                            <th class="p-4">Dosen Pengampu</th>
                            <th class="p-4">SKS / Waktu</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataMapel as $mapel)
                        <tr class="border-b border-gray-800 hover:bg-blue-900/20">
                            <td class="p-4 text-gray-200 font-bold">{{ $mapel->nama_mapel }}</td>
                            
                            <td class="p-4">
                                @if($mapel->dosen_id)
                                    <span class="text-cyan-300">{{ $mapel->dosen->nama_dosen }}</span>
                                @else
                                    <span class="text-red-400 italic text-sm">Belum Di-plot</span>
                                @endif
                            </td>
                            
                            <td class="p-4 text-gray-400">{{ $mapel->sks }} SKS | <span class="uppercase text-xs border border-gray-600 px-2 rounded">{{ $mapel->waktu }}</span></td>
                            <td class="p-4 flex justify-center space-x-2">
                                <button onclick="openPlotModal({{ $mapel->id }}, '{{ $mapel->nama_mapel }}')" class="text-xs px-3 py-1 bg-gray-800 border border-yellow-500/50 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 rounded font-bold shadow-[0_0_10px_rgba(234,179,8,0.2)] transition-all">
                                    PLOT
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- ============================================== -->
    <!-- ZONA MODAL (POP-UP) -->
    <!-- ============================================== -->

    <!-- 1. Modal Tambah Dosen -->
    <div id="modal-dosen" class="modal-overlay fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/80 backdrop-blur-sm">
        <div class="modal-box bg-gray-900 border border-cyan-500/50 rounded-xl p-6 w-full max-w-md shadow-[0_0_40px_rgba(34,211,238,0.2)]">
            <h3 class="text-2xl font-bold text-cyan-400 mb-4">Tambah Dosen Baru</h3>
            <form action="/admin/dosen/store" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Nama Lengkap (Beserta Gelar)</label>
                    <input type="text" name="nama_dosen" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-500" placeholder="Contoh: Dr. Budi Santoso, M.Kom">
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('modal-dosen')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded font-bold hover:bg-cyan-500 shadow-[0_0_10px_rgba(34,211,238,0.4)]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Modal EDIT Dosen (BARU) -->
    <div id="modal-edit-dosen" class="modal-overlay fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/80 backdrop-blur-sm">
        <div class="modal-box bg-gray-900 border border-cyan-500/50 rounded-xl p-6 w-full max-w-md shadow-[0_0_40px_rgba(34,211,238,0.2)]">
            <h3 class="text-2xl font-bold text-cyan-400 mb-4">Edit Data Dosen</h3>
            <form id="form-edit-dosen" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Ubah Nama Dosen</label>
                    <!-- ID Input ini bakal diisi otomatis via Javascript -->
                    <input type="text" id="input-edit-nama-dosen" name="nama_dosen" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-cyan-500">
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('modal-edit-dosen')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded font-bold hover:bg-cyan-500 shadow-[0_0_10px_rgba(34,211,238,0.4)]">Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Modal Tambah Mapel -->
    <div id="modal-mapel" class="modal-overlay fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/80 backdrop-blur-sm">
        <div class="modal-box bg-gray-900 border border-blue-500/50 rounded-xl p-6 w-full max-w-md shadow-[0_0_40px_rgba(59,130,246,0.2)]">
            <h3 class="text-2xl font-bold text-blue-400 mb-4">Tambah Mata Kuliah</h3>
            <form action="/admin/mapel/store" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Nama Mata Kuliah</label>
                    <input type="text" name="nama_mapel" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500" placeholder="Contoh: Pemrograman Web">
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">SKS</label>
                        <input type="number" name="sks" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500" placeholder="Ex: 3">
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Waktu / Sesi</label>
                        <select name="waktu" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-blue-500">
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="malam">Malam</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('modal-mapel')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded font-bold hover:bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.4)]">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. Modal Plotting Dosen -->
    <div id="modal-plot" class="modal-overlay fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/80 backdrop-blur-sm">
        <div class="modal-box bg-gray-900 border border-yellow-500/50 rounded-xl p-6 w-full max-w-md shadow-[0_0_40px_rgba(234,179,8,0.2)]">
            <h3 class="text-xl font-bold text-yellow-400 mb-1">Plotting Dosen Pengampu</h3>
            <p class="text-gray-400 text-sm mb-4">Mata Kuliah: <span id="plot-mapel-name" class="font-bold text-white"></span></p>
            
            <form id="form-plot" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-400 text-sm mb-2">Pilih Dosen</label>
                    <select name="dosen_id" required class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-yellow-500 cursor-pointer">
                        <option value="">-- Silakan Pilih Dosen --</option>
                        @foreach($dataDosen as $dsn)
                            <option value="{{ $dsn->id }}">{{ $dsn->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeModal('modal-plot')" class="px-4 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-gray-900 rounded font-black hover:bg-yellow-500 shadow-[0_0_10px_rgba(234,179,8,0.4)]">Tugaskan!</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        // Script dinamis buat Modal Edit Dosen
        function openEditDosenModal(dosenId, dosenName) {
            document.getElementById('input-edit-nama-dosen').value = dosenName;
            document.getElementById('form-edit-dosen').action = '/admin/dosen/' + dosenId + '/update';
            openModal('modal-edit-dosen');
        }

        // Script dinamis buat Modal Plotting
        function openPlotModal(mapelId, mapelName) {
            document.getElementById('plot-mapel-name').innerText = mapelName;
            document.getElementById('form-plot').action = '/admin/mapel/' + mapelId + '/plot';
            openModal('modal-plot');
        }
    </script>
</body>
</html>