<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Animate.css CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-100 to-indigo-200 min-h-screen flex items-center justify-center font-sans">

    <div class="text-center bg-white p-10 rounded-2xl shadow-2xl max-w-xl animate__animated animate__fadeInDown">

        {{-- Icon dan Judul --}}
        <div class="mb-6">
            <i class="fa-solid fa-door-open text-5xl text-indigo-600 animate__animated animate__bounceIn"></i>
            <h1 class="text-3xl font-bold mt-4 text-gray-800">Selamat Datang!</h1>
            <p class="text-gray-600 mt-2">Silakan masuk untuk melanjutkan, atau daftar jika belum punya akun.</p>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-6">
            <a href="/login"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow transition duration-300 animate__animated animate__fadeInUp">
                <i class="fa-solid fa-right-to-bracket mr-2"></i>Login
            </a>
            <a href="/register"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl shadow transition duration-300 animate__animated animate__fadeInUp animate__delay-1s">
                <i class="fa-solid fa-user-plus mr-2"></i>Register
            </a>
        </div>

    </div>

</body>

</html>
