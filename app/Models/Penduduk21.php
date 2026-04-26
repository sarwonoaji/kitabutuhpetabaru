<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk21 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk21';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}