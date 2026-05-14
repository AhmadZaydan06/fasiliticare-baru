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
    /**
     * Menampilkan halaman form registrasi
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses pendaftaran user baru
     */
    public function register(Request $request)
    {
        // 1. Validasi Input sesuai kebutuhan form
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|unique:users,username|max:255',
            'nomor_kamar'  => 'required|string|max:10',
            'password'     => 'required|string|min:3',
        ]);

        try {
            // 2. Gunakan Transaction agar data tersimpan di kedua tabel atau tidak sama sekali
            DB::transaction(function () use ($request) {
                
                // Simpan ke tabel 'users' untuk data login
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password), // Menggunakan enkripsi Bcrypt
                    'role'     => 'penghuni', // Set otomatis sebagai penghuni
                ]);

                // Simpan ke tabel 'anggota' untuk profil penghuni
                // Pastikan model Anggota memiliki $fillable untuk kolom-kolom ini
                Anggota::create([
                    'id_user'      => $user->id_user, // Menghubungkan id dari tabel users
                    'nama_lengkap' => $request->nama_lengkap,
                    'nomor_kamar'  => $request->nomor_kamar,
                ]);
            });

            // 3. Redirect ke halaman login jika sukses
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');

        } catch (\Exception $e) {
            // Jika terjadi error (misal: database mati), kembalikan ke form dengan pesan error
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}