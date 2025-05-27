<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Tambah Buku</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/buku" method="POST" class="mb-8 bg-white p-6 rounded shadow">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="judul_buku" placeholder="Judul Buku" class="border p-2" required
                value="{{ old('judul_buku') }}">
            <input type="text" name="author" placeholder="Author" class="border p-2" required
                value="{{ old('author') }}">
            <input type="number" name="tahun" placeholder="Tahun" class="border p-2" required
                value="{{ old('tahun') }}">
            <input type="number" name="stok_buku" placeholder="Stok Buku" class="border p-2"
                value="{{ old('stok_buku') }}">
            <input type="number" name="stok_jual" placeholder="Stok Jual" class="border p-2"
                value="{{ old('stok_jual') }}">
            <select name="kategori" class="border p-2">
                <option value="Fiksi" {{ old('kategori') == 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                <option value="Nonfiksi" {{ old('kategori') == 'Nonfiksi' ? 'selected' : '' }}>Nonfiksi</option>
                <option value="Komik" {{ old('kategori') == 'Komik' ? 'selected' : '' }}>Komik</option>
                <option value="Pelajaran" {{ old('kategori') == 'Pelajaran' ? 'selected' : '' }}>Pelajaran</option>
                <option value="Lainnya" {{ old('kategori', 'Lainnya') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            <input type="text" id="harga" placeholder="Harga" class="border p-2" oninput="formatRupiah(this)"
                value="{{ old('harga') }}">
            <input type="hidden" id="harga_hidden" name="harga_hidden" value="{{ old('harga_hidden') }}">
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>

    <h2 class="text-xl font-semibold mb-2">Daftar Buku</h2>

    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="py-2 px-3">Judul</th>
                <th class="py-2 px-3">Author</th>
                <th class="py-2 px-3">Tahun</th>
                <th class="py-2 px-3">Stok Buku</th>
                <th class="py-2 px-3">Stok Jual</th>
                <th class="py-2 px-3">Kategori</th>
                <th class="py-2 px-3">Harga</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $buku)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $buku->judul_buku }}</td>
                    <td class="py-2 px-3">{{ $buku->author }}</td>
                    <td class="py-2 px-3">{{ $buku->tahun }}</td>
                    <td class="py-2 px-3">{{ $buku->stok_buku }}</td>
                    <td class="py-2 px-3">{{ $buku->stok_jual }}</td>
                    <td class="py-2 px-3">{{ $buku->kategori }}</td>
                    <td class="py-2 px-3">Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td class="py-2 px-3 flex space-x-2">
                        <a href="/buku/{{ $buku->id }}/edit"
                            class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                        <form action="/buku/{{ $buku->id }}" method="POST"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded" type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
        document.addEventListener("DOMContentLoaded", function () {
            let inputHarga = document.getElementById('harga');
            if (inputHarga.value) {
                formatRupiah(inputHarga);
            }
        });
    </script>
</body>

</html>
