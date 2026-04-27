<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk42;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk42Controller extends Controller
{
    private const FOLDER = 'img/penduduk42';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk42::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk42 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk42.index', compact('penduduk42'));
    }

    public function create()
    {
        return view('admin.penduduk42.create');
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
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        Penduduk42::create($data);

        return redirect()->route('penduduk42.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk42 = Penduduk42::findOrFail($id);
        return view('admin.penduduk42.edit', compact('penduduk42'));
    }

    public function update(Request $request, $id)
    {
        $penduduk42 = Penduduk42::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk42->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk42->update($data);

        return redirect()->route('penduduk42.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk42 = Penduduk42::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk42->foto);

        $penduduk42->delete();

        return redirect()->route('penduduk42.index')->with('success', 'Data berhasil dihapus');
    }
}