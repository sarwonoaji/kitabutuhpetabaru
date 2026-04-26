<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    public $timestamps = false;

    protected $table = 'aset_desa';

    protected $fillable = [
        'nama',
        'kegunaan',
        'luas',
        'no_sertifikat',
        'foto',
        'latitude',
        'longitude'
    ];
}