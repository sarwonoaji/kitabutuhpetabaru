<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk12;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk12Controller extends Controller
{
    private const FOLDER = 'img/penduduk12';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk12::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk12 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk12.index', compact('penduduk12'));
    }

    public function create()
    {
        return view('admin.penduduk12.create');
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

        if ($request->file('foto')) {
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        Penduduk12::create($data);

        return redirect()->route('penduduk12.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk12 = Penduduk12::findOrFail($id);
        return view('admin.penduduk12.edit', compact('penduduk12'));
    }

    public function update(Request $request, $id)
    {
        $penduduk12 = Penduduk12::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

     if ($request->file('foto')) {

            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk12->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk12->update($data);

        return redirect()->route('penduduk12.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk12 = Penduduk12::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk12->foto);

        $penduduk12->delete();

        return redirect()->route('penduduk12.index')->with('success', 'Data berhasil dihapus');
    }
}