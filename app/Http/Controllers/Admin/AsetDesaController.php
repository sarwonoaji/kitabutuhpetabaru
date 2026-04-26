<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;

class AsetDesaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Aset::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('kegunaan', 'like', "%$keyword%");
            });
        }

        $asetdesa = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.aset.index', compact('asetdesa'));
    }

    public function create()
    {
        return view('admin.aset.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kegunaan' => 'required',
            'luas' => 'required',
            'no_sertifikat' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('aset_', true) . '.' . $file->extension();
            $destination = public_path('img/aset');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        Aset::create($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('admin.aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'kegunaan' => 'required',
            'luas' => 'required',
            'no_sertifikat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('aset_', true) . '.' . $file->extension();
            $destination = public_path('img/aset');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        $aset->update($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Aset::findOrFail($id)->delete();
        return redirect()->route('aset.index')->with('success', 'Data berhasil dihapus');
    }
}