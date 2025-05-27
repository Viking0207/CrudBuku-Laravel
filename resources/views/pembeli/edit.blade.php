<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Pembeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Edit Data Pembeli</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pembeli/{{ $pembeli->id }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="nama" placeholder="Nama Pembeli" class="border p-2"
                value="{{ old('nama', $pembeli->nama) }}" required>

            <select name="buku_id" class="border p-2" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}" {{ old('buku_id', $pembeli->buku_id) == $buku->id ? 'selected' : '' }}>
                        {{ $buku->judul_buku }} (Stok: {{ $buku->stok_jual }})
                    </option>
                @endforeach
            </select>

            <input type="date" name="tanggal_pembelian" class="border p-2"
                value="{{ old('tanggal_pembelian', $pembeli->tanggal_pembelian ? date('Y-m-d', strtotime($pembeli->tanggal_pembelian)) : '') }}" required>
        </div>

        <div class="flex justify-between mt-6">
            <a href="/pembeli" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        </div>
    </form>
</body>

</html>
