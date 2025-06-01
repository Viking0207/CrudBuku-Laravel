@if (session('user') && session('user')->status === 'admin')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin Perpus Utama</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    </head>

    <body
        class="relative overflow-hidden bg-gradient-to-br from-blue-100 via-purple-100 to-pink-200 min-h-screen flex items-center justify-center font-sans">

        <!-- Tombol Settings kiri atas -->
        <a href="/users"
            class="fixed top-6 left-6 bg-white p-3 rounded-full shadow-md border border-gray-300 text-indigo-600 hover:bg-indigo-50 transition flex items-center justify-center w-12 h-12"
            title="Settings">
            <i class="fa-solid fa-gear fa-lg"></i>
        </a>

        <!-- Bar atas: Nama user dan tombol logout -->
        <div class="absolute top-6 right-6 flex items-center gap-3 animate__animated animate__fadeInDown">
            <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl shadow-md border border-gray-200">
                <i class="fa-solid fa-user text-indigo-500"></i>
                <span class="text-sm font-semibold text-gray-800">
                    {{ session('user')->nama ?? 'User' }}
                </span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-xl text-sm font-medium shadow-md transition duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>

        <!-- Konten utama -->
        <div
            class="bg-white max-w-3xl w-full p-10 rounded-2xl shadow-2xl text-center space-y-8 animate__animated animate__fadeInUp">
            <h1 class="text-4xl font-extrabold text-gray-800 flex justify-center items-center gap-3">
                <i class="fa-solid fa-building-columns text-indigo-600"></i> Welcome To Admin Perpus
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
@else
    {{-- Bisa redirect juga, atau tampil pesan --}}
    <script>
        alert('Anda tidak punya akses ke halaman admin!');
        window.location.href = '/';
    </script>
@endif
