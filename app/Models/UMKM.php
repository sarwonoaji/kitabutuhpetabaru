<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    protected $table = 'peta_umkm';

    protected $fillable = [
        'nama',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
    ];
}