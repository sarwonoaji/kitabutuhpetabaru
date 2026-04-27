<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk62;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk62Controller extends Controller
{
    private const FOLDER = 'img/penduduk62';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk62::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk62 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk62.index', compact('penduduk62'));
    }

    public function create()
    {
        return view('admin.penduduk62.create');
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

        Penduduk62::create($data);

        return redirect()->route('penduduk62.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk62 = Penduduk62::findOrFail($id);
        return view('admin.penduduk62.edit', compact('penduduk62'));
    }

    public function update(Request $request, $id)
    {
        $penduduk62 = Penduduk62::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk62->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk62->update($data);

        return redirect()->route('penduduk62.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk62 = Penduduk62::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk62->foto);

        $penduduk62->delete();

        return redirect()->route('penduduk62.index')->with('success', 'Data berhasil dihapus');
    }
}