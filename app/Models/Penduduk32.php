<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk32 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk32';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}