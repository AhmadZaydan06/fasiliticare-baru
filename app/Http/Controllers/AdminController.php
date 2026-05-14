<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Halaman Utama Admin (Home)
     * Menampilkan statistik ringkas dan 3 aduan terbaru
     */
    public function home()
    {
        // 1. Ambil data statistik untuk dikirim ke view home
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
    /**
     * Halaman Tabel Dashboard
     * Dilengkapi Search, Filter, dan Statistik lengkap
     */
   public function index(Request $request)
{
    // Menggunakan join secara eksplisit seringkali lebih stabil untuk pencarian kompleks
    $query = Aduan::query()
        ->select('aduan.*')
        ->join('anggota', 'aduan.id_anggota', '=', 'anggota.id_anggota')
        ->join('kategori', 'aduan.id_kategori', '=', 'kategori.id_kategori')
        ->with(['anggota', 'kategori', 'status']);

    // 1. Filter Status
    if ($request->filled('status')) {
        $query->where('aduan.id_status', $request->status);
    }

    // 2. Search (Menggunakan pencarian langsung ke tabel yang sudah di-join)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('aduan.deskripsi_masalah', 'like', "%$search%")
              ->orWhere('anggota.nama_lengkap', 'like', "%$search%")
              ->orWhere('anggota.nomor_kamar', 'like', "%$search%")
              ->orWhere('kategori.nama_kategori', 'like', "%$search%");
        });
    }

    // Eksekusi Query
    $semuaAduan = $query->latest('aduan.waktu_aduan')->get();

    // Statistik (Dihitung terpisah agar tidak terpengaruh join/filter pencarian)
    $totalAduan = Aduan::count();
    $menunggu   = Aduan::where('id_status', 1)->count();
    $diproses   = Aduan::where('id_status', 2)->count();
    $selesai    = Aduan::where('id_status', 3)->count();
    $dibatalkan = Aduan::where('id_status', 4)->count();

    return view('admin.dashboard', compact(
        'semuaAduan', 'totalAduan', 'menunggu', 'diproses', 'selesai', 'dibatalkan'
    ));
}

    /**
     * Update Status via AJAX 
     * Agar status langsung tersimpan saat admin mengubah dropdown
     */
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

    /**
     * Menghapus aduan
     * Menghapus data permanen di DB saat ikon tong sampah diklik
     */
    public function destroy($id)
    {
        $aduan = Aduan::findOrFail($id);
        $aduan->delete();

        return back()->with('success', 'Aduan berhasil dihapus secara permanen.');
    }
}