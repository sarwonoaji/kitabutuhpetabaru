<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk82;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk82Controller extends Controller
{
    private const FOLDER = 'img/penduduk82';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk82::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk82 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk82.index', compact('penduduk82'));
    }

    public function create()
    {
        return view('admin.penduduk82.create');
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

        Penduduk82::create($data);

        return redirect()->route('penduduk82.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk82 = Penduduk82::findOrFail($id);
        return view('admin.penduduk82.edit', compact('penduduk82'));
    }

    public function update(Request $request, $id)
    {
        $penduduk82 = Penduduk82::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk82->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk82->update($data);

        return redirect()->route('penduduk82.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk82 = Penduduk82::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk82->foto);

        $penduduk82->delete();

        return redirect()->route('penduduk82.index')->with('success', 'Data berhasil dihapus');
    }
}