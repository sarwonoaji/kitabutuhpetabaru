<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk61 extends Model
{
    public $timestamps = false;

    protected $table = 'penduduk61';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
        'latitude',
        'longitude',
    ];
}