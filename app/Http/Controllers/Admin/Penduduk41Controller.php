<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk41;
use Illuminate\Http\Request;

class Penduduk41Controller extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk41::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk41 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk41.index', compact('penduduk41'));
    }

    public function create()
    {
        return view('admin.penduduk41.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('penduduk41_', true) . '.' . $file->extension();
            $destination = public_path('img/penduduk41');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        Penduduk41::create($data);

        return redirect()->route('penduduk41.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk41 = Penduduk41::findOrFail($id);
        return view('admin.penduduk41.edit', compact('penduduk41'));
    }

    public function update(Request $request, $id)
    {
        $penduduk41 = Penduduk41::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('penduduk41_', true) . '.' . $file->extension();
            $destination = public_path('img/penduduk41');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        $penduduk41->update($data);

        return redirect()->route('penduduk41.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Penduduk41::findOrFail($id)->delete();
        return redirect()->route('penduduk41.index')->with('success', 'Data berhasil dihapus');
    }
}