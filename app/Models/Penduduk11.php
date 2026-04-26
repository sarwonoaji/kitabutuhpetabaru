<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk11 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk11';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
        'jumlahanggota'
    ];
}