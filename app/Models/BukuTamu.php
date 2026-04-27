<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    
    public $timestamps = false;
    protected $table = 'buku_tamu';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'alamat',
        'instansi',
        'keperluan',
        'hp_telp',
        'tanggal'
    ];

}