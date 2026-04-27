<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk52 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk52';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}