<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    // Nama tabel di database
    protected $table = 'anggota';

    // Primary key kustom
    protected $primaryKey = 'id_anggota';

    // Matikan timestamps karena tabel tidak punya kolom created_at/updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi melalui input form
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nomor_kamar',
    ];

    /**
     * Relasi ke tabel User (Setiap anggota punya satu akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke tabel Aduan (Satu anggota bisa punya banyak laporan)
     */
    public function aduan()
    {
        return $this->hasMany(Aduan::class, 'id_anggota', 'id_anggota');
    }
}