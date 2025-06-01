<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Daftar User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 p-8 font-sans">

    <!-- Tombol Kembali di kanan atas -->
    <a href="{{ route('admin.dashboard') }}"
        class="absolute top-6 right-6 inline-flex items-center gap-2 bg-gray-300 hover:bg-gray-400 text-gray-800 px-3 py-1.5 rounded-full text-sm shadow-md transition duration-300">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>

    <h1 class="text-3xl font-extrabold mb-6 text-gray-800 flex items-center gap-3">
        <i class="fa-solid fa-users text-indigo-600"></i>
        Daftar User
    </h1>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded shadow-sm animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex justify-start">
        <a href="{{ route('admin.userdata.create') }}"
            class="group relative inline-flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg transition duration-300">
            <i class="fa-solid fa-plus text-lg"></i>
            <span
                class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 rounded bg-indigo-700 px-2 py-1 text-xs font-semibold text-white transition-all group-hover:scale-100">
                Tambah User
            </span>
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-lg bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-indigo-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-indigo-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-indigo-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-medium">{{ $user->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($user->status === 'admin')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                    <i class="fa-solid fa-shield-halved mr-1"></i> Admin
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    <i class="fa-solid fa-user mr-1"></i> User
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                            <a href="{{ route('admin.userdata.edit', $user->id) }}"
                                class="inline-flex items-center gap-2 bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm transition duration-200">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.userdata.destroy', $user->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow-sm transition duration-200">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
            animation: fade-in 0.5s ease-in-out;
        }
    </style>
</body>

</html>