<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk62 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk62';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}