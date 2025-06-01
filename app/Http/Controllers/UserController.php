<?php

namespace App\Http\Controllers;

use App\Models\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{  
    // Tampilkan semua user
    public function index()
    {
        $users = ModelUser::with('pembelis')->get();
        return view('users.index', compact('users'));
    }

    // Form tambah user baru
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:200',
            'email' => 'required|email|unique:tb_user,email',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|in:admin,user',
        ]);

        ModelUser::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
    }

    // Tampilkan detail user
    public function show($id)
    {
        $user = ModelUser::with('pembelis')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Form edit user
    public function edit($id)
    {
        $user = ModelUser::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = ModelUser::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:200',
            'email' => 'required|email|unique:tb_user,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:admin,user',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->status = $request->status;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = ModelUser::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}

