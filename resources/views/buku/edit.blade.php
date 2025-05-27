<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-papbZU1Lc+KXdTQK++TGqQhNjdQcSAt8mglpyC1bY5JkFp9ip6O+8hCbQ7j3TfJyZ14RY1J8U1pi1LxU8ew0Kg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="p-6 bg-gray-100 font-sans">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Buku</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/buku/{{ $buku->id }}" method="POST" class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="judul_buku">
                    <i class="fa-solid fa-book mr-2 text-blue-500"></i> Judul Buku
                </label>
                <input type="text" id="judul_buku" name="judul_buku" placeholder="Judul Buku"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required value="{{ old('judul_buku', $buku->judul_buku) }}" />
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="author">
                    <i class="fa-solid fa-user-pen mr-2 text-green-500"></i> Author
                </label>
                <input type="text" id="author" name="author" placeholder="Author"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400"
                    required value="{{ old('author', $buku->author) }}" />
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="tahun">
                    <i class="fa-solid fa-calendar mr-2 text-yellow-500"></i> Tahun
                </label>
                <input type="number" id="tahun" name="tahun" placeholder="Tahun"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    required value="{{ old('tahun', $buku->tahun) }}" />
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="stok_buku">
                    <i class="fa-solid fa-layer-group mr-2 text-purple-500"></i> Stok Buku
                </label>
                <input type="number" id="stok_buku" name="stok_buku" placeholder="Stok Buku"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-purple-400"
                    value="{{ old('stok_buku', $buku->stok_buku) }}" />
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="kategori">
                    <i class="fa-solid fa-tags mr-2 text-pink-500"></i> Kategori
                </label>
                <select id="kategori" name="kategori"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-400">
                    @foreach (['Fiksi', 'Nonfiksi', 'Komik', 'Pelajaran', 'Lainnya'] as $kategori)
                        <option value="{{ $kategori }}"
                            {{ old('kategori', $buku->kategori) == $kategori ? 'selected' : '' }}>
                            {{ $kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700" for="harga">
                    <i class="fa-solid fa-money-bill-wave mr-2 text-indigo-500"></i> Harga
                </label>
                <input type="text" id="harga" placeholder="Harga"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    oninput="formatRupiah(this)"
                    value="{{ old('harga', 'Rp' . number_format($buku->harga, 0, ',', '.')) }}" />
                <input type="hidden" id="harga_hidden" name="harga_hidden"
                    value="{{ old('harga_hidden', $buku->harga) }}" />
            </div>
        </div>

        <div class="flex items-center gap-4 mt-8 justify-end">
            <a href="/buku"
                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100 hover:border-gray-600 transition duration-200 font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded shadow transition duration-200 font-semibold">
                Perbarui
            </button>
        </div>

    </form>

    <script>
        function formatRupiah(input) {
            let angka = input.value.replace(/[^\d]/g, '');
            if (!angka) angka = '0';
            let rupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
            }).format(angka);
            input.value = rupiah;
            document.getElementById('harga_hidden').value = parseFloat(angka);
        }

        document.addEventListener('DOMContentLoaded', function() {
            let inputHarga = document.getElementById('harga');
            if (inputHarga.value) {
                formatRupiah(inputHarga);
            }
        });
    </script>
</body>

</html>
