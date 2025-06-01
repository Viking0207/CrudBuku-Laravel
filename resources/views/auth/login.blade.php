<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-blue-100 to-purple-200 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl animate__animated animate__fadeInDown">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            <i class="fa-solid fa-right-to-bracket mr-2 text-indigo-600"></i>Login
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="nama" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition duration-300">
                <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i>Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun?
            <a href="/register" class="text-indigo-600 hover:underline">Daftar di sini</a>
        </p>
    </div>

</body>

</html>
