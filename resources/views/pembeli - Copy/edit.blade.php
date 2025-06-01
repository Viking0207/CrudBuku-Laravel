<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Data Pembeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="p-6 bg-gray-100 font-sans">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Pembeli</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pembeli/{{ $pembeli->id }}" method="POST" class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nama" class="block mb-1 font-semibold text-gray-700">
                    <i class="fa-solid fa-user text-blue-500 mr-2"></i> Nama Pembeli
                </label>
                <input type="text" name="nama" id="nama" placeholder="Nama Pembeli"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                    value="{{ old('nama', $pembeli->nama) }}" required />
            </div>

            <div>
                <label for="buku_id" class="block mb-1 font-semibold text-gray-700">
                    <i class="fa-solid fa-book text-green-500 mr-2"></i> Buku yang Dibeli
                </label>
                <select name="buku_id" id="buku_id"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-green-400"
                    required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($bukus as $buku)
                        <option value="{{ $buku->id }}"
                            {{ old('buku_id', $pembeli->buku_id) == $buku->id ? 'selected' : '' }}>
                            {{ $buku->judul_buku }} (Stok: {{ $buku->stok_tersedia }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="jumlah" class="block mb-1 font-semibold text-gray-700">
                    <i class="fa-solid fa-sort-numeric-up text-indigo-500 mr-2"></i> Jumlah
                </label>
                <input type="number" name="jumlah" id="jumlah" min="1" placeholder="Jumlah"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    value="{{ old('jumlah', $pembeli->stok_buku) }}" required />
            </div>

            <div>
                <label for="tanggal_pembelian" class="block mb-1 font-semibold text-gray-700">
                    <i class="fa-solid fa-calendar-days text-yellow-500 mr-2"></i> Tanggal Pembelian
                </label>
                <input type="date" name="tanggal_pembelian" id="tanggal_pembelian"
                    class="border border-gray-300 p-3 rounded w-full focus:outline-none focus:ring-2 focus:ring-yellow-400"
                    value="{{ old('tanggal_pembelian', date('Y-m-d', strtotime($pembeli->tanggal_pembelian))) }}"
                    min="{{ date('Y-m-d') }}" onkeydown="return false" required />
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <a href="/pembeli"
                class="inline-flex items-center gap-2 px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 hover:border-gray-500 hover:text-gray-900 transition duration-200 font-medium select-none">
                <i class="fa-solid fa-times"></i> Batal
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded shadow transition duration-200 font-semibold select-none">
                Simpan Perubahan
            </button>
        </div>

    </form>
</body>

</html>
