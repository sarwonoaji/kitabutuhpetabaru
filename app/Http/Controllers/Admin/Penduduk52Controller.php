<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk52;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk52Controller extends Controller
{
    private const FOLDER = 'img/penduduk52';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk52::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk52 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk52.index', compact('penduduk52'));
    }

    public function create()
    {
        return view('admin.penduduk52.create');
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

        Penduduk52::create($data);

        return redirect()->route('penduduk52.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk52 = Penduduk52::findOrFail($id);
        return view('admin.penduduk52.edit', compact('penduduk52'));
    }

    public function update(Request $request, $id)
    {
        $penduduk52 = Penduduk52::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk52->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk52->update($data);

        return redirect()->route('penduduk52.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk52 = Penduduk52::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk52->foto);

        $penduduk52->delete();

        return redirect()->route('penduduk52.index')->with('success', 'Data berhasil dihapus');
    }
}