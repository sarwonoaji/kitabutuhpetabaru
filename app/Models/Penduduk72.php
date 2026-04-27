<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk72 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk72';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}