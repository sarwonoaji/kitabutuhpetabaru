<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk42 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk42';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}