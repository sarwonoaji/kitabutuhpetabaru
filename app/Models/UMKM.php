<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    public $timestamps = false;

    protected $table = 'peta_umkm';

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'harga',
        'latitude',
        'longitude',
    ];
}