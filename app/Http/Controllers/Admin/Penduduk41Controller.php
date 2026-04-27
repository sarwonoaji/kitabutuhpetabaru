<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk41;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk41Controller extends Controller
{
    private const FOLDER = 'img/penduduk41';
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
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
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

            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk41->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk41->update($data);

        return redirect()->route('penduduk41.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk41 = Penduduk41::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk41->foto);

        $penduduk41->delete();

        return redirect()->route('penduduk41.index')->with('success', 'Data berhasil dihapus');
    }
}