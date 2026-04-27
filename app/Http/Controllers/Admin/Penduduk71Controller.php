<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk71;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk71Controller extends Controller
{
    private const FOLDER = 'img/penduduk71';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk71::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk71 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk71.index', compact('penduduk71'));
    }

    public function create()
    {
        return view('admin.penduduk71.create');
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

        Penduduk71::create($data);

        return redirect()->route('penduduk71.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk71 = Penduduk71::findOrFail($id);
        return view('admin.penduduk71.edit', compact('penduduk71'));
    }

    public function update(Request $request, $id)
    {
        $penduduk71 = Penduduk71::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk71->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk71->update($data);

        return redirect()->route('penduduk71.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk71 = Penduduk71::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk71->foto);

        $penduduk71->delete();

        return redirect()->route('penduduk71.index')->with('success', 'Data berhasil dihapus');
    }
}