<?php

namespace App\Models;

// Gunakan Authenticatable, bukan Model biasa agar bisa login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 1. Sesuaikan dengan nama tabel di database Anda
    protected $table = 'users';

    // 2. Sesuaikan primary key-nya
    protected $primaryKey = 'id_user';

    // 3. Matikan timestamps karena tabel Anda tidak punya created_at/updated_at
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi (mass assignable).
     * Sesuaikan dengan kolom di tabel users Anda
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (misal: saat convert ke JSON).
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relasi ke tabel Anggota (One-to-One)
     */
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id_user', 'id_user');
    }
}