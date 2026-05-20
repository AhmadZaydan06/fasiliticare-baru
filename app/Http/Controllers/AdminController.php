<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function home()
    {
        $data = [
            'totalAduan' => Aduan::count(),
            'menunggu'   => Aduan::where('id_status', 1)->count(),
            'diproses'   => Aduan::where('id_status', 2)->count(),
            'selesai'    => Aduan::where('id_status', 3)->count(),
            // Ambil 3 aduan terbaru untuk ditampilkan di list
            'aduanTerbaru' => Aduan::with(['anggota', 'kategori', 'status'])
                                ->latest('waktu_aduan')
                                ->take(3)
                                ->get()
        ];

        return view('admin.home', $data);
    }
   public function index(Request $request)
{
    if (!Auth::check() || Auth::user()->role !== 'admin') {
    return redirect()->route('user.home')->with('error', 'Anda tidak memiliki hak akses!');
}
    $query = Aduan::query()
        ->select('aduan.*')
        ->join('anggota', 'aduan.id_anggota', '=', 'anggota.id_anggota')
        ->join('kategori', 'aduan.id_kategori', '=', 'kategori.id_kategori')
        ->with(['anggota', 'kategori', 'status']);

    if ($request->filled('status')) {
        $query->where('aduan.id_status', $request->status);
    }

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('aduan.deskripsi_masalah', 'like', "%$search%")
              ->orWhere('anggota.nama_lengkap', 'like', "%$search%")
              ->orWhere('anggota.nomor_kamar', 'like', "%$search%")
              ->orWhere('kategori.nama_kategori', 'like', "%$search%");
        });
    }

    $semuaAduan = $query->latest('aduan.waktu_aduan')->get();

    $totalAduan = Aduan::count();
    $menunggu   = Aduan::where('id_status', 1)->count();
    $diproses   = Aduan::where('id_status', 2)->count();
    $selesai    = Aduan::where('id_status', 3)->count();
    $dibatalkan = Aduan::where('id_status', 4)->count();

    return view('admin.dashboard', compact(
        'semuaAduan', 'totalAduan', 'menunggu', 'diproses', 'selesai', 'dibatalkan'
    ));
}

    public function updateStatus(Request $request, $id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->id_status = $request->id_status;
        $aduan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status aduan berhasil diperbarui.'
        ]);
    }

    public function destroy($id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->delete();

        return back()->with('success', 'Aduan berhasil dihapus secara permanen.');
    }
    // Tambahkan method ini di dalam AdminController.php
public function anggota()
{
    $anggota = \App\Models\Anggota::with('user')->get(); 

    return view('admin.anggota', compact('anggota'));
}
public function show($id)
    {
        $aduan = Aduan::with(['status', 'kategori', 'anggota'])->findOrFail($id);
        
        return view('admin.detail_aduan', compact('aduan'));
    }
    public function destroyAnggota($id)
{
    $anggota = Anggota::findOrFail($id);
    
    $id_user = $anggota->id_user;

    $anggota->delete();

    if ($id_user) {
        User::where('id_user', $id_user)->delete();
    }

    return redirect()->route('admin.anggota')->with('success', 'Data anggota berhasil dihapus.');
}
}