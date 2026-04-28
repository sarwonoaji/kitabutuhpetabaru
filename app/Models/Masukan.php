<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masukan extends Model
{
    public $timestamps = false;

    protected $table = 'masukan';

    protected $fillable = [
        'nama',
        'keterangan',
        'foto',
    ];
}