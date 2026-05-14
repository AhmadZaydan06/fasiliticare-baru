<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 1. Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 2. Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role user untuk diarahkan ke halaman yang sesuai
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin/home');
            } 
            elseif (Auth::user()->role == 'user') {
                return redirect()->intended('user/home');
            }
            else {
                return redirect()->intended('/user/home');
            }
        }

        // Jika gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // 3. Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}