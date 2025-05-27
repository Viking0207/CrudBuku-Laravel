<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perpus Utama</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-purple-200 min-h-screen flex items-center justify-center">

    <div class="bg-white max-w-3xl w-full p-10 rounded-2xl shadow-2xl text-center space-y-8">
        <h1 class="text-4xl font-bold text-gray-800">📊 Welcome To Perpus</h1>
        <p class="text-lg text-gray-600">Silakan pilih salah satu menu di bawah ini untuk melanjutkan.</p>

        <div class="grid md:grid-cols-2 gap-6 mt-6">
            <a href="/buku"
                class="block bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-lg shadow text-xl transition transform hover:scale-105">
                📚 Daftar Buku
            </a>
            <a href="/pembeli"
                class="block bg-green-600 hover:bg-green-700 text-white py-4 rounded-lg shadow text-xl transition transform hover:scale-105">
                🧍 Daftar Pembeli
            </a>
        </div>

        {{-- <footer class="text-sm text-gray-400 mt-8">
            &copy; {{ date('Y') }} Sistem Manajemen Buku. All rights reserved.
        </footer> --}}
    </div>

</body>

</html>
