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
                <i class="fa-solid fa-book-open"></i> Kumpulan Buku
            </h1>
            <a href="/dashboard"
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

        <!-- Tabel Daftar Buku -->
        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white rounded border border-blue-200">
                <thead class="bg-blue-100 text-blue-900 font-semibold">
                    <tr>
                        <th class="py-3 px-4 text-left">Gambar</th>
                        <th class="py-3 px-4 text-left">Judul</th>
                        <th class="py-3 px-4 text-left">Author</th>
                        <th class="py-3 px-4 text-left">Tahun</th>
                        <th class="py-3 px-4 text-left">Stok Buku</th>
                        <th class="py-3 px-4 text-left">Kategori</th>
                        <th class="py-3 px-4 text-left">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bukus as $buku)
                        <tr class="border-t hover:bg-blue-50 transition">
                            <td class="py-2 px-4">
                                @if ($buku->gambar)
                                    <img src="{{ asset('gambar_buku/' . $buku->gambar) }}" alt="Gambar Buku"
                                        class="w-16 h-auto rounded shadow">
                                @else
                                    <div
                                        class="w-16 h-20 bg-gray-200 flex items-center justify-center text-gray-400 text-xs rounded">
                                        Tidak ada gambar
                                    </div>
                                @endif
                            </td>
                            <td class="py-2 px-4">{{ $buku->judul_buku }}</td>
                            <td class="py-2 px-4">{{ $buku->author }}</td>
                            <td class="py-2 px-4">{{ $buku->tahun }}</td>
                            <td class="py-2 px-4">{{ $buku->stok_buku }}</td>
                            <td class="py-2 px-4">{{ $buku->kategori }}</td>
                            <td class="py-2 px-4">Rp{{ number_format($buku->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
