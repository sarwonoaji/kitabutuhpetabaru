<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk82 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk82';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}