<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengerjaan extends Model
{
    protected $table = 'status_pengerjaan'; //
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    protected $fillable = ['nama_status'];
}