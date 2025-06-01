<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center p-6 font-sans">

    <div class="bg-white shadow-xl rounded-lg max-w-lg w-full p-8">
        <h1 class="text-3xl font-extrabold mb-8 text-yellow-600 flex items-center gap-3">
            <i class="fa-solid fa-user-pen"></i> Edit User
        </h1>

        @if ($errors->any())
            <div
                class="mb-6 p-4 bg-red-50 border border-red-400 text-red-700 rounded-md shadow-sm animate-fade-in">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.userdata.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="block mb-2 font-semibold text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" required
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="Masukkan nama lengkap" />
            </div>

            <div>
                <label for="email" class="block mb-2 font-semibold text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="contoh@domain.com" />
            </div>

            <div>
                <label for="password" class="block mb-2 font-semibold text-gray-700">Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" id="password"
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition" placeholder="Minimal 6 karakter" />
            </div>

            <div>
                <label for="status" class="block mb-2 font-semibold text-gray-700">Status</label>
                <select name="status" id="status" required
                    class="w-full rounded-md border border-gray-300 px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition">
                    <option value="user" {{ old('status', $user->status) == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('status', $user->status) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex items-center justify-start gap-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-6 py-3 rounded-md shadow-md transition duration-300">
                    <i class="fa-solid fa-floppy-disk"></i> Update
                </button>
                <a href="{{ route('admin.userdata.index') }}"
                    class="text-yellow-600 hover:text-yellow-800 font-semibold underline">Batal</a>
            </div>
        </form>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-in-out;
        }
    </style>

</body>

</html>
