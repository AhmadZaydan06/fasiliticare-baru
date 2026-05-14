<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    // Nama tabel di database
    protected $table = 'aduan';

    // Primary key kustom
    protected $primaryKey = 'id_aduan';

    // Matikan timestamps otomatis (karena kita pakai default CURRENT_TIMESTAMP di SQL)
    public $timestamps = false;

    protected $fillable = [
        'id_anggota',
        'id_kategori',
        'id_status',
        'deskripsi_masalah',
        'lampiran_foto',
        'waktu_aduan',
    ];

    /**
     * Relasi ke tabel Anggota (Siapa yang melapor?)
     */
    public function anggota() {
    return $this->belongsTo(Anggota::class, 'id_anggota');
}

public function kategori() {
    return $this->belongsTo(Kategori::class, 'id_kategori');
}

    /**
     * Relasi ke tabel StatusPengerjaan (Sudah sampai mana progresnya?)
     */
    public function status()
    {
        return $this->belongsTo(StatusPengerjaan::class, 'id_status', 'id_status');
    }
}