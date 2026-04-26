<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk41 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk41';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}