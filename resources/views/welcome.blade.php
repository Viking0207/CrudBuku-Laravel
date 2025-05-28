<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perpus Utama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

</head>

<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-200 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white max-w-3xl w-full p-10 rounded-2xl shadow-2xl text-center space-y-8">
        <h1 class="text-4xl font-extrabold text-gray-800 flex justify-center items-center gap-3">
            <i class="fa-solid fa-building-columns text-indigo-600"></i> Welcome To Perpus
        </h1>
        <p class="text-lg text-gray-600">Silakan pilih salah satu menu di bawah ini untuk melanjutkan.</p>

        <div class="grid md:grid-cols-2 gap-6 mt-6">
            <a href="/buku"
                class="group bg-blue-600 hover:bg-blue-700 text-white py-4 px-6 rounded-xl shadow-lg text-xl font-semibold flex items-center justify-center gap-3 transition-transform duration-300 hover:-translate-y-1">
                <i class="fa-solid fa-book group-hover:animate-pulse"></i>
                Daftar Buku
            </a>
            <a href="/pembeli"
                class="group bg-green-600 hover:bg-green-700 text-white py-4 px-6 rounded-xl shadow-lg text-xl font-semibold flex items-center justify-center gap-3 transition-transform duration-300 hover:-translate-y-1">
                <i class="fa-solid fa-user-group group-hover:animate-pulse"></i>
                Daftar Pembeli
            </a>
        </div>
    </div>

</body>

</html>
