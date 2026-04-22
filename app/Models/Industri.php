<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'peta_industri';

    protected $fillable = [
        'nama',
        'deskripsi',
        'jumlah',
        'foto',
        'latitude',
        'longitude'
    ];
}