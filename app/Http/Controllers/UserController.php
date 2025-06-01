<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelUser;

class UserController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login manual tanpa Auth
    public function login(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $user = ModelUser::where('nama', $request->nama)
            ->where('password', $request->password) // langsung bandingkan teks
            ->first();

        if ($user) {
            // Simpan session
            session([
                'user_id' => $user->id,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_status' => $user->status,
                'user' => $user
            ]);

            // Redirect sesuai status
            if ($user->status === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }

        return back()->withErrors(['nama' => 'Nama atau password salah.']);
    }

    // Dashboard untuk user biasa
    public function userDashboard()
    {
        $user = session('user');

        // Pastikan sudah login dan status user
        if (!$user || $user->status !== 'user') {
            return redirect('/login')->with('error', 'Anda harus login sebagai user untuk mengakses halaman ini.');
        }

        return view('dashboard'); // sesuaikan dengan view dashboard user
    }

    // Dashboard untuk admin
    public function adminDashboard()
    {
        $user = session('user');

        // Pastikan sudah login dan status admin
        if (!$user || $user->status !== 'admin') {
            return redirect('/login')->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }

        return view('admin.dashboard'); // sesuaikan dengan view dashboard admin
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register manual tanpa Auth
    public function register(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:tb_user,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = ModelUser::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password, // simpan apa adanya
            'status' => 'user', // default role user
        ]);

        // Langsung redirect ke login setelah register
        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Logout manual
    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'user_nama', 'user_email', 'user_status', 'user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('/');
    }



      // List semua user
    public function index()
    {
        $users = ModelUser::all();
        return view('admin.userdata.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.userdata.create');
    }

    // Simpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_user,email',
            'password' => 'required|min:6',
            'status' => 'required|in:user,admin',
        ]);

        ModelUser::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,  // kalau mau hashing nanti bisa ubah
            'status' => $request->status,
        ]);

        return redirect()->route('admin.userdata.index')->with('success', 'User berhasil ditambah');
    }

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = ModelUser::findOrFail($id);
        return view('admin.userdata.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, $id)
    {
        $user = ModelUser::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:tb_user,email,' . $user->id,
            'password' => 'nullable|min:6',
            'status' => 'required|in:user,admin',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.userdata.index')->with('success', 'User berhasil diupdate');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = ModelUser::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.userdata.index')->with('success', 'User berhasil dihapus');
    }
}
