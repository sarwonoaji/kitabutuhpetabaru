<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TernakTani extends Model
{
    protected $table = 'ternak_tani';

    protected $fillable = [
        'nama',
        'deskripsi',
        'jumlah',
        'harga',
        'foto',
        'latitude',
        'longitude',
        'jenis'
    ];
}