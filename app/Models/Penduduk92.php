<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk92 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk92';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}