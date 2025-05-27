<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Edit Buku</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/buku/{{ $buku->id }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="judul_buku" placeholder="Judul Buku" class="border p-2" required
                value="{{ old('judul_buku', $buku->judul_buku) }}">
            <input type="text" name="author" placeholder="Author" class="border p-2" required
                value="{{ old('author', $buku->author) }}">
            <input type="number" name="tahun" placeholder="Tahun" class="border p-2" required
                value="{{ old('tahun', $buku->tahun) }}">
            <input type="number" name="stok_buku" placeholder="Stok Buku" class="border p-2"
                value="{{ old('stok_buku', $buku->stok_buku) }}">
            <select name="kategori" class="border p-2">
                @foreach (['Fiksi', 'Nonfiksi', 'Komik', 'Pelajaran', 'Lainnya'] as $kategori)
                    <option value="{{ $kategori }}"
                        {{ old('kategori', $buku->kategori) == $kategori ? 'selected' : '' }}>
                        {{ $kategori }}
                    </option>
                @endforeach
            </select>

            <input type="text" id="harga" placeholder="Harga" class="border p-2" oninput="formatRupiah(this)"
                value="{{ old('harga', 'Rp' . number_format($buku->harga, 0, ',', '.')) }}">
            <input type="hidden" id="harga_hidden" name="harga_hidden" value="{{ old('harga_hidden', $buku->harga) }}">
        </div>

        <div class="flex items-center gap-4 mt-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Perbarui</button>
            <a href="/buku" class="text-gray-600 hover:underline">← Kembali</a>
        </div>
    </form>

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

        document.addEventListener("DOMContentLoaded", function () {
            let inputHarga = document.getElementById('harga');
            if (inputHarga.value) {
                formatRupiah(inputHarga);
            }
        });
    </script>

</body>

</html>
