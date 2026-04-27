<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk22;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk22Controller extends Controller
{
    private const FOLDER = 'img/penduduk22';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk22::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk22 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk22.index', compact('penduduk22'));
    }

    public function create()
    {
        return view('admin.penduduk22.create');
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

        Penduduk22::create($data);

        return redirect()->route('penduduk22.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk22 = Penduduk22::findOrFail($id);
        return view('admin.penduduk22.edit', compact('penduduk22'));
    }

    public function update(Request $request, $id)
    {
        $penduduk22 = Penduduk22::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk22->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk22->update($data);

        return redirect()->route('penduduk22.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk22 = Penduduk22::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk22->foto);

        $penduduk22->delete();

        return redirect()->route('penduduk22.index')->with('success', 'Data berhasil dihapus');
    }
}