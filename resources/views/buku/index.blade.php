<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Font Awesome CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="p-8 bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8">

        <!-- Judul dan Tombol Back -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-extrabold text-blue-900 flex items-center gap-3">
                <i class="fa-solid fa-book-open"></i> Tambah Buku
            </h1>
            <a href="/"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-700 text-white px-5 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 font-semibold text-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>


        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa-solid fa-exclamation-circle mr-1 text-red-600"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/buku" method="POST"
            class="mb-10 grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50 p-6 rounded-lg shadow-inner">
            @csrf
            <input type="text" name="judul_buku" placeholder="Judul Buku"
                class="border border-blue-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                required value="{{ old('judul_buku') }}" />
            <input type="text" name="author" placeholder="Author"
                class="border border-blue-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                required value="{{ old('author') }}" />
            <input type="number" name="tahun" placeholder="Tahun" min="1900" max="{{ date('Y') }}"
                class="border border-blue-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                required value="{{ old('tahun') }}" />
            <input type="number" name="stok_buku" placeholder="Stok Buku" min="0"
                class="border border-blue-300 rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                value="{{ old('stok_buku') }}" />
            <select name="kategori"
                class="border border-blue-300 rounded px-4 py-2 bg-white focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="Fiksi" {{ old('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                <option value="Nonfiksi" {{ old('kategori') == 'Nonfiksi' ? 'selected' : '' }}>Nonfiksi</option>
                <option value="Komik" {{ old('kategori') == 'Komik' ? 'selected' : '' }}>Komik</option>
                <option value="Pelajaran" {{ old('kategori') == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                <option value="Lainnya" {{ old('kategori', 'Lainnya') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                </option>
            </select>
            <div class="relative">
                <input type="text" id="harga" placeholder="Harga (Rp)"
                    class="border border-blue-300 rounded px-4 py-2 w-full pr-10 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    oninput="formatRupiah(this)" value="{{ old('harga') }}" />
                <i
                    class="fa-solid fa-money-bill-wave absolute right-3 top-1/2 -translate-y-1/2 text-blue-500 pointer-events-none"></i>
                <input type="hidden" id="harga_hidden" name="harga_hidden" value="{{ old('harga_hidden') }}" />
            </div>

            <button type="submit"
                class="md:col-span-2 bg-blue-600 hover:bg-blue-700 transition text-white font-semibold rounded px-6 py-3 flex justify-center items-center gap-2 shadow-md">
                <i class="fa-solid fa-floppy-disk"></i> Simpan
            </button>
        </form>

        <h2 class="text-2xl font-bold mb-4 text-blue-900 flex items-center gap-3">
            <i class="fa-solid fa-list"></i> Daftar Buku
        </h2>

        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white rounded border border-blue-200">
                <thead class="bg-blue-100 text-blue-900 font-semibold">
                    <tr>
                        <th class="py-3 px-4 text-left">Judul</th>
                        <th class="py-3 px-4 text-left">Author</th>
                        <th class="py-3 px-4 text-left">Tahun</th>
                        <th class="py-3 px-4 text-left">Stok Buku</th>
                        <th class="py-3 px-4 text-left">Kategori</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                        <th class="py-3 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr class="border-t hover:bg-blue-50 transition">
                            <td class="py-2 px-4">{{ $buku->judul_buku }}</td>
                            <td class="py-2 px-4">{{ $buku->author }}</td>
                            <td class="py-2 px-4">{{ $buku->tahun }}</td>
                            <td class="py-2 px-4">{{ $buku->stok_buku }}</td>
                            <td class="py-2 px-4">{{ $buku->kategori }}</td>
                            <td class="py-2 px-4">Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 flex space-x-2">
                                <a href="/buku/{{ $buku->id }}/edit" title="Edit Buku"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded flex items-center gap-2 transition">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="/buku/{{ $buku->id }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 transition text-white px-3 py-1 rounded flex items-center gap-2">
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
        function formatRupiah(input) {
            let angka = input.value.replace(/[^\d]/g, '');
            if (!angka) angka = '0';
            let rupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(angka);
            input.value = rupiah;
            document.getElementById('harga_hidden').value = parseFloat(angka);
        }

        // Auto-format kalau ada value lama
        document.addEventListener("DOMContentLoaded", function() {
            let inputHarga = document.getElementById('harga');
            if (inputHarga.value) {
                formatRupiah(inputHarga);
            }
        });
    </script>
</body>

</html>
