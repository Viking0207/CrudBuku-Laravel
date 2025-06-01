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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = ModelUser::where('email', $request->email)
            ->where('password', $request->password) // langsung bandingkan teks
            ->first();

        if ($user) {
            session([
                'user_id' => $user->id,
                'user_nama' => $user->nama,
                'user_email' => $user->email,
                'user_status' => $user->status,
                'user' => $user
            ]);

            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
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
            'password' => $request->password, // langsung simpan apa adanya
            'status' => 'user',
        ]);

        session([
            'user_id' => $user->id,
            'user_nama' => $user->nama,
            'user_email' => $user->email,
            'user_status' => $user->status,
        ]);

        return redirect('/login');
    }


    // Logout manual
    public function logout(Request $request)
    {
        // Bersihkan session yang berhubungan dengan user
        $request->session()->forget(['user_id', 'user_nama', 'user_email', 'user_status']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();

        return redirect('/');
    }
}
