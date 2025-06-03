<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Daftar Pembeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="p-6 bg-gradient-to-r from-indigo-100 via-purple-100 to-pink-100 min-h-screen">
    <div class="max-w-5xl mx-auto">

        <!-- Heading & Tombol Back -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-800 flex items-center space-x-3">
                <i class="fa-solid fa-cart-shopping text-indigo-600"></i>
                <span>Form Pembelian Buku</span>
            </h1>

            <a href="/dashboard"
                class="inline-flex items-center gap-2 bg-white border border-gray-300 hover:bg-gray-100 text-gray-800 px-4 py-2 rounded-lg shadow-sm transition duration-200 text-sm font-semibold">
                <i class="fa-solid fa-arrow-left text-base"></i> Kembali
            </a>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div
                class="mb-4 p-4 rounded-lg bg-green-100 border border-green-400 text-green-800 flex items-center space-x-3 shadow">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-400 text-red-800 shadow">
                <ul class="list-disc pl-6 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM PEMBELI --}}
        <form action="/pembeli" method="POST" class="mb-10 bg-white p-8 rounded-xl shadow-lg border border-indigo-300">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="relative">
                    <label for="nama" class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-user"></i> Nama Pembeli
                    </label>
                    <select id="user_id" name="user_id"
                        class="w-full border border-indigo-300 rounded-md p-3 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="relative">
                    <label for="buku_id" class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-book"></i> Pilih Buku
                    </label>
                    <select id="buku_id" name="buku_id"
                        class="w-full border border-indigo-300 rounded-md p-3 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required onchange="updateBukuData()">
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($bukus as $buku)
                            <option value="{{ $buku->id }}" data-stok="{{ $buku->stok_buku }}"
                                data-harga="{{ $buku->harga }}">
                                {{ $buku->judul_buku }} (Stok: {{ $buku->stok_buku }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="relative">
                    <label for="jumlah" class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-hashtag"></i> Jumlah
                    </label>
                    <input type="number" id="jumlah" name="jumlah" min="1" placeholder="Jumlah"
                        class="w-full border border-indigo-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        oninput="hitungTotal()" required>
                </div>

                <div class="relative">
                    <label class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-boxes-stacked"></i> Stok Tersedia
                    </label>
                    <input type="text" id="stok_tersedia" placeholder="Stok tersedia"
                        class="w-full border border-indigo-200 rounded-md p-3 bg-indigo-50 text-indigo-700 cursor-not-allowed"
                        readonly>
                </div>

                <div class="relative">
                    <label class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-tag"></i> Harga Satuan
                    </label>
                    <input type="text" id="harga_satuan" placeholder="Harga satuan"
                        class="w-full border border-indigo-200 rounded-md p-3 bg-indigo-50 text-indigo-700 cursor-not-allowed"
                        readonly>
                </div>

                <div class="relative">
                    <label for="total_harga" class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-wallet"></i> Total Harga
                    </label>
                    <input type="text" id="total_harga" name="total_harga" placeholder="Total harga"
                        class="w-full border border-indigo-200 rounded-md p-3 bg-indigo-50 text-indigo-700 cursor-not-allowed"
                        readonly>
                </div>

                <div class="relative md:col-span-2">
                    <label for="tanggal_pembelian"
                        class="block mb-1 font-semibold text-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-calendar-days"></i> Tanggal Pembelian
                    </label>
                    <input type="date" id="tanggal_pembelian" name="tanggal_pembelian"
                        class="w-full border border-indigo-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        value="{{ old('tanggal_pembelian', now()->format('Y-m-d')) }}"
                        min="{{ now()->format('Y-m-d') }}" onkeydown="return false" required>
                </div>
            </div>

            <button
                class="mt-6 w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-3">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
        </form>

        {{-- DAFTAR PEMBELI --}}
        <h2 class="text-2xl font-semibold mb-4 text-indigo-800 flex items-center gap-2">
            <i class="fa-solid fa-list"></i> Daftar Pembeli
        </h2>

        <div class="overflow-x-auto rounded-lg shadow-lg border border-indigo-300 bg-white">
            <table class="min-w-full text-left table-auto border-collapse">
                <thead class="bg-indigo-100 text-indigo-900 font-semibold">
                    <tr>
                        <th class="py-3 px-5 border-b border-indigo-300">Nama</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Judul Buku</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Kategori</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Stok Diambil</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Harga</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Tanggal Beli</th>
                        <th class="py-3 px-5 border-b border-indigo-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelis as $pembeli)
                        <tr class="border-b border-indigo-200 hover:bg-indigo-50 transition">
                            <td class="py-3 px-5">{{ $pembeli->nama }}</td>
                            <td class="py-3 px-5">{{ $pembeli->judul_buku }}</td>
                            <td class="py-3 px-5">{{ $pembeli->kategori }}</td>
                            <td class="py-3 px-5">{{ $pembeli->stok_buku }}</td>
                            <td class="py-3 px-5">Rp{{ number_format($pembeli->harga, 0, ',', '.') }}</td>
                            <td class="py-3 px-5">
                                {{ \Carbon\Carbon::parse($pembeli->tanggal_pembelian)->format('d M Y') }}</td>
                            <td class="py-3 px-5 flex space-x-3">
                                <a href="/pembeli/{{ $pembeli->id }}/edit"
                                    class="bg-yellow-400 hover:bg-yellow-500 transition text-white px-3 py-1 rounded flex items-center gap-2">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="/pembeli/{{ $pembeli->id }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 hover:bg-red-600 transition text-white px-3 py-1 rounded flex items-center gap-2"
                                        type="submit">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let hargaBuku = 0;
        let stokBuku = 0;

        function updateBukuData() {
            const select = document.getElementById('buku_id');
            const selectedOption = select.options[select.selectedIndex];

            hargaBuku = parseInt(selectedOption.getAttribute('data-harga')) || 0;
            stokBuku = parseInt(selectedOption.getAttribute('data-stok')) || 0;

            document.getElementById('stok_tersedia').value = stokBuku;
            document.getElementById('harga_satuan').value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(hargaBuku);

            hitungTotal();
        }

        function hitungTotal() {
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;

            if (jumlah > stokBuku) {
                alert('Jumlah melebihi stok tersedia!');
                document.getElementById('jumlah').value = stokBuku;
                return;
            }

            const total = jumlah * hargaBuku;

            document.getElementById('total_harga').value = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(total);
        }
    </script>
</body>

</html>
