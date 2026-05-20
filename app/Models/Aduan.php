<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aduan extends Model
{
    protected $table = 'aduan';

    protected $primaryKey = 'id_aduan';

    public $timestamps = false;

    protected $fillable = [
        'id_anggota',
        'id_kategori',
        'id_status',
        'deskripsi_masalah',
        'lampiran_foto',
        'waktu_aduan',
    ];

    public function anggota() {
    return $this->belongsTo(Anggota::class, 'id_anggota');
}

public function kategori() {
    return $this->belongsTo(Kategori::class, 'id_kategori');
}

    public function status()
    {
        return $this->belongsTo(StatusPengerjaan::class, 'id_status', 'id_status');
    }
}