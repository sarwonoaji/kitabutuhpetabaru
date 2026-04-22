<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;

class GrafikTamuController extends Controller
{
    public function index()
    {
        return view('tamu.grafik', [
            'umum' => BukuTamu::where('keperluan', 'Surat Keterangan Umum')->count(),
            'usaha' => BukuTamu::where('keperluan', 'Surat Keterangan Usaha')->count(),
            'domisili' => BukuTamu::where('keperluan', 'Surat Keterangan Domisili')->count(),
            'pengantar' => BukuTamu::where('keperluan', 'Surat Pengantar')->count(),
            'lain' => BukuTamu::where('keperluan', 'Keperluan lain')->count(),
        ]);
    }
}