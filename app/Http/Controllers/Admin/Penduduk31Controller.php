<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk31;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk31Controller extends Controller
{
    private const FOLDER = 'img/penduduk31';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk31::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk31 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk31.index', compact('penduduk31'));
    }

    public function create()
    {
        return view('admin.penduduk31.create');
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

        Penduduk31::create($data);

        return redirect()->route('penduduk31.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk31 = Penduduk31::findOrFail($id);
        return view('admin.penduduk31.edit', compact('penduduk31'));
    }

    public function update(Request $request, $id)
    {
        $penduduk31 = Penduduk31::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {

            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk31->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk31->update($data);

        return redirect()->route('penduduk31.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk31 = Penduduk31::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk31->foto);

        $penduduk31->delete();

        return redirect()->route('penduduk31.index')->with('success', 'Data berhasil dihapus');
    }
}