<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk51 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk51';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}