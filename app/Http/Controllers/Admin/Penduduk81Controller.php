<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk81;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk81Controller extends Controller
{
    private const FOLDER = 'img/penduduk81';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk81::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk81 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk81.index', compact('penduduk81'));
    }

    public function create()
    {
        return view('admin.penduduk81.create');
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

        Penduduk81::create($data);

        return redirect()->route('penduduk81.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk81 = Penduduk81::findOrFail($id);
        return view('admin.penduduk81.edit', compact('penduduk81'));
    }

    public function update(Request $request, $id)
    {
        $penduduk81 = Penduduk81::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk81->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk81->update($data);

        return redirect()->route('penduduk81.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk81 = Penduduk81::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk81->foto);

        $penduduk81->delete();

        return redirect()->route('penduduk81.index')->with('success', 'Data berhasil dihapus');
    }
}