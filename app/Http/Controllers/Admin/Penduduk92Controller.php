<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk92;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk92Controller extends Controller
{
    private const FOLDER = 'img/penduduk92';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk92::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk92 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk92.index', compact('penduduk92'));
    }

    public function create()
    {
        return view('admin.penduduk92.create');
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

        Penduduk92::create($data);

        return redirect()->route('penduduk92.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk92 = Penduduk92::findOrFail($id);
        return view('admin.penduduk92.edit', compact('penduduk92'));
    }

    public function update(Request $request, $id)
    {
        $penduduk92 = Penduduk92::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk92->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk92->update($data);

        return redirect()->route('penduduk92.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk92 = Penduduk92::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk92->foto);

        $penduduk92->delete();

        return redirect()->route('penduduk92.index')->with('success', 'Data berhasil dihapus');
    }
}