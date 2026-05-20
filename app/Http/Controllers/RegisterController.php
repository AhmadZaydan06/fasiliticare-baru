<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|unique:users,username|max:255',
            'nomor_kamar'  => 'required|string|max:10',
            'password'     => 'required|string|min:3',
        ]);

        try {
            DB::transaction(function () use ($request) {
                
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password), 
                    'role'     => 'user', 
                ]);

                Anggota::create([
                    'id_user'      => $user->id_user,
                    'nama_lengkap' => $request->nama_lengkap,
                    'nomor_kamar'  => $request->nomor_kamar,
                ]);
            });

            return redirect()->route('admin.anggota')->with('success', 'Akun berhasil dibuat! Silakan login.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}