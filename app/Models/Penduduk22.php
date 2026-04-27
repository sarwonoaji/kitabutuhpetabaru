<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk22 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk22';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}