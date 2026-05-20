<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    
    protected $table = 'anggota';


    protected $primaryKey = 'id_anggota';

    public $timestamps = false;

   
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nomor_kamar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function aduan()
    {
        return $this->hasMany(Aduan::class, 'id_anggota', 'id_anggota');
    }
}