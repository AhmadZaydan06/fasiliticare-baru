<?php

namespace App\Models;

// Gunakan Authenticatable, bukan Model biasa agar bisa login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id_user', 'id_user');
    }
}