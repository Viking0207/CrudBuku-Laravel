<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Pembeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-6 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Form Pembelian Buku</h1>

    {{-- Notifikasi --}}
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

    {{-- FORM PEMBELI --}}
    <form action="/pembeli" method="POST" class="mb-8 bg-white p-6 rounded shadow">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="nama" placeholder="Nama Pembeli" class="border p-2" required
                value="{{ old('nama') }}">

            <select name="buku_id" id="buku_id" class="border p-2" required onchange="updateBukuData()">
                <option value="">-- Pilih Buku --</option>
                @foreach ($bukus as $buku)
                    <option value="{{ $buku->id }}" data-stok="{{ $buku->stok_buku }}"
                        data-harga="{{ $buku->harga }}">
                        {{ $buku->judul_buku }} (Stok: {{ $buku->stok_buku }})
                    </option>
                @endforeach
            </select>

            <input type="number" id="jumlah" name="jumlah" min="1" class="border p-2" placeholder="Jumlah"
                oninput="hitungTotal()" required>

            <input type="text" id="stok_tersedia" class="border p-2 bg-gray-100" placeholder="Stok tersedia"
                readonly>
            <input type="text" id="harga_satuan" class="border p-2 bg-gray-100" placeholder="Harga satuan" readonly>

            <input type="text" id="total_harga" name="total_harga" class="border p-2 bg-gray-100"
                placeholder="Total harga" readonly>

            <input type="date" name="tanggal_pembelian" class="border p-2" required
                value="{{ old('tanggal_pembelian') }}">
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>


    {{-- DAFTAR PEMBELI --}}
    <h2 class="text-xl font-semibold mb-2">Daftar Pembeli</h2>

    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-gray-200 text-left">
            <tr>
                <th class="py-2 px-3">Nama</th>
                <th class="py-2 px-3">Judul Buku</th>
                <th class="py-2 px-3">Kategori</th>
                <th class="py-2 px-3">Stok Diambil</th>
                <th class="py-2 px-3">Harga</th>
                <th class="py-2 px-3">Tanggal Beli</th>
                <th class="py-2 px-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelis as $pembeli)
                <tr class="border-t">
                    <td class="py-2 px-3">{{ $pembeli->nama }}</td>
                    <td class="py-2 px-3">{{ $pembeli->judul_buku }}</td>
                    <td class="py-2 px-3">{{ $pembeli->kategori }}</td>
                    <td class="py-2 px-3">{{ $pembeli->stok_buku }}</td>
                    <td class="py-2 px-3">Rp{{ number_format($pembeli->harga, 0, ',', '.') }}</td>
                    <td class="py-2 px-3">{{ \Carbon\Carbon::parse($pembeli->tanggal_pembelian)->format('d M Y') }}
                    </td>
                    <td class="py-2 px-3 flex space-x-2">
                        <a href="/pembeli/{{ $pembeli->id }}/edit"
                            class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
                        <form action="/pembeli/{{ $pembeli->id }}" method="POST"
                            onsubmit="return confirm('Yakin hapus data ini?')">
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

            hitungTotal(); // reset jika jumlah sebelumnya masih ada
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
