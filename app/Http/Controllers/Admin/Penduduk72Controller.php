<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk72;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk72Controller extends Controller
{
    private const FOLDER = 'img/penduduk72';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk72::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk72 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk72.index', compact('penduduk72'));
    }

    public function create()
    {
        return view('admin.penduduk72.create');
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

        Penduduk72::create($data);

        return redirect()->route('penduduk72.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk72 = Penduduk72::findOrFail($id);
        return view('admin.penduduk72.edit', compact('penduduk72'));
    }

    public function update(Request $request, $id)
    {
        $penduduk72 = Penduduk72::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk72->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk72->update($data);

        return redirect()->route('penduduk72.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk72 = Penduduk72::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk72->foto);

        $penduduk72->delete();

        return redirect()->route('penduduk72.index')->with('success', 'Data berhasil dihapus');
    }
}