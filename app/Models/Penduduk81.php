<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk81 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk81';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}