<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function home()
{
    $anggota = Auth::user()->anggota;

    if (!$anggota) {
        return redirect()->back()->with('error', 'Profil anggota tidak ditemukan.');
    }

    $idAnggota = $anggota->id_anggota;

    $data = [
        'totalAduan' => Aduan::where('id_anggota', $idAnggota)->count(),
        'diproses'   => Aduan::where('id_anggota', $idAnggota)->where('id_status', 2)->count(),
        'selesai'    => Aduan::where('id_anggota', $idAnggota)->where('id_status', 3)->count(),
        'aduanTerbaru' => Aduan::where('id_anggota', $idAnggota)
                            ->with(['kategori', 'status']) 
                            ->latest('waktu_aduan')
                            ->take(3)
                            ->get()
    ];

    return view('user.home', $data);
}

    public function create()
    {
    $kategori = Kategori::all();
    
    return view('user.aduan_create', compact('kategori'));
}

    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'deskripsi_masalah' => 'required',
        'lampiran_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
    ]);

    $idAnggota = Auth::user()->anggota->id_anggota;
    $namaFoto = null;

    if ($request->hasFile('lampiran_foto')) {
        $file = $request->file('lampiran_foto');
        $namaFoto = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('storage/aduan'), $namaFoto);
    }

    Aduan::create([
        'id_anggota' => $idAnggota,
        'id_kategori' => $request->id_kategori,
        'id_status' => 1, // Default: Menunggu
        'deskripsi_masalah' => $request->deskripsi_masalah,
        'lampiran_foto' => $namaFoto,
        'waktu_aduan' => now(),
    ]);

    return redirect()->route('user.home')->with('success', 'Aduan berhasil dikirim!');
}

    
    public function aduanList()
{
    $anggota = Auth::user()->anggota;

    $aduan = Aduan::where('id_anggota', $anggota->id_anggota)
                ->with(['kategori', 'status'])
                ->latest('waktu_aduan')
                ->paginate(10);

    return view('user.aduan_list', compact('aduan'));
}
    public function faq()
{
    return view('user.faq'); 
}

   
   public function show($id)
    {
        
        $aduan = Aduan::with(['status', 'kategori', 'anggota.user'])->findOrFail($id);
        
       
        return view('user.detail_aduan', compact('aduan'));
    }
}