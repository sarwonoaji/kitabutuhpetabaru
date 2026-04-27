<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = BukuTamu::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keperluan', 'like', "%$keyword%");
            });
        }

        $bukutamu = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.buku_tamu.index', compact('bukutamu'));
    }

    public function create()
    {
        return view('admin.buku_tamu.create');
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

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        return view('admin.buku_tamu.edit', compact('bukutamu'));
    }

    public function update(Request $request, $id)
    {
        $bukutamu = BukuTamu::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'instansi' => 'required',
            'keperluan' => 'required',
            'hp_telp' => 'required',
        ]);

        $data['tanggal'] = now()->format('Y-m-d');

        $bukutamu->update($data);

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);

        $bukutamu->delete();

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil dihapus');
    }
}