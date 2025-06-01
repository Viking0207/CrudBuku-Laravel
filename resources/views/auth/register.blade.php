<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="bg-gradient-to-br from-green-100 to-teal-200 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl animate__animated animate__fadeInDown">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            <i class="fa-solid fa-user-plus mr-2 text-green-600"></i>Register
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="nama" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 px-4 py-2 rounded-xl border focus:ring-2 focus:ring-green-400 focus:outline-none">
            </div>

            <button type="submit"
                class="w-full bg-green-600 text-white py-3 rounded-xl hover:bg-green-700 transition duration-300">
                <i class="fa-solid fa-user-plus mr-2"></i>Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-green-600 hover:underline">Login di sini</a>
        </p>
    </div>

</body>

</html>
