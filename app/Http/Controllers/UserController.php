<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Menampilkan Beranda User (Statistik & Aduan Terbaru)
     */
    public function home()
{
    // 1. Ambil data anggota yang terhubung dengan user yang sedang login
    // Kita butuh id_anggota karena tabel 'aduan' menggunakan kolom tersebut sebagai foreign key
    $anggota = Auth::user()->anggota;

    // Cek jika data anggota tidak ditemukan untuk menghindari error 500
    if (!$anggota) {
        return redirect()->back()->with('error', 'Profil anggota tidak ditemukan.');
    }

    $idAnggota = $anggota->id_anggota;

    $data = [
        // Hitung statistik menggunakan id_anggota
        'totalAduan' => Aduan::where('id_anggota', $idAnggota)->count(),
        'diproses'   => Aduan::where('id_anggota', $idAnggota)->where('id_status', 2)->count(),
        'selesai'    => Aduan::where('id_anggota', $idAnggota)->where('id_status', 3)->count(),
        
        // Mengambil 3 aduan terbaru milik anggota ini
        'aduanTerbaru' => Aduan::where('id_anggota', $idAnggota)
                            ->with(['kategori', 'status']) // Eager loading agar tidak error property non-object
                            ->latest('waktu_aduan')
                            ->take(3)
                            ->get()
    ];

    return view('user.home', $data);
}

    /**
     * Menampilkan Form Buat Aduan Baru
     */
    public function create()
    {
    // Mengambil semua kategori untuk pilihan di form
    $kategori = Kategori::all();
    
    // Pastikan file view adalah 'aduan_create.blade.php' di folder resources/views/user/
    return view('user.aduan_create', compact('kategori'));
}

    /**
     * Menyimpan Aduan Baru ke Database (Termasuk Upload Foto)
     */
    public function store(Request $request)
{
    // Validasi input sesuai desain (foto maksimal 5MB)
    $request->validate([
        'id_kategori' => 'required',
        'deskripsi_masalah' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $idAnggota = Auth::user()->anggota->id_anggota;
    $namaFoto = null;

    // Proses upload foto ke public folder
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $namaFoto = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('storage/aduan'), $namaFoto);
    }

    // Simpan ke database aduan menggunakan id_anggota
    Aduan::create([
        'id_anggota' => $idAnggota,
        'id_kategori' => $request->id_kategori,
        'id_status' => 1, // Default: Menunggu
        'deskripsi_masalah' => $request->deskripsi_masalah,
        'foto' => $namaFoto,
        'waktu_aduan' => now(),
    ]);

    return redirect()->route('user.home')->with('success', 'Aduan berhasil dikirim!');
}

    /**
     * Menampilkan Semua Daftar Aduan User
     */
    public function aduanList()
    {
        $userId = Auth::user()->id_user;
        $aduan = Aduan::where('id_anggota', $userId)
                    ->with(['kategori', 'status'])
                    ->latest('waktu_aduan')
                    ->paginate(10);

        return view('user.aduan_list', compact('aduan'));
    }
    public function faq()
{
    return view('user.faq'); // Pastikan file berada di resources/views/user/faq.blade.php
}
}