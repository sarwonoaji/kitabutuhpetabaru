<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BKTamuController extends Controller
{
    public function create()
    {
        return view('buku_tamu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'instansi' => 'required',
            'keperluan' => 'required',
            'hp_telp' => 'required',
        ]);

        $data['tanggal'] = now()->format('Y-m-d');

        BukuTamu::create($data);

        return redirect()->route('bKtamu.create')
            ->with('success', 'Data berhasil ditambahkan!');
    }

}