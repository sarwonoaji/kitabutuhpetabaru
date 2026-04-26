<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk11;
use Illuminate\Http\Request;

class Penduduk11Controller extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk11::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk11 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk11.index', compact('penduduk11'));
    }

    public function create()
    {
        return view('admin.penduduk11.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'jumlahanggota' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('penduduk11_', true) . '.' . $file->extension();
            $destination = public_path('img/penduduk11');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        Penduduk11::create($data);

        return redirect()->route('penduduk11.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk11 = Penduduk11::findOrFail($id);
        return view('admin.penduduk11.edit', compact('penduduk11'));
    }

    public function update(Request $request, $id)
    {
        $penduduk11 = Penduduk11::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'jumlahanggota' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('penduduk11_', true) . '.' . $file->extension();
            $destination = public_path('img/penduduk11');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        $penduduk11->update($data);

        return redirect()->route('penduduk11.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Penduduk11::findOrFail($id)->delete();
        return redirect()->route('penduduk11.index')->with('success', 'Data berhasil dihapus');
    }
}