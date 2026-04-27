<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk21;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk21Controller extends Controller
{
    private const FOLDER = 'img/penduduk21';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk21::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk21 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk21.index', compact('penduduk21'));
    }

    public function create()
    {
        return view('admin.penduduk21.create');
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

        Penduduk21::create($data);

        return redirect()->route('penduduk21.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk21 = Penduduk21::findOrFail($id);
        return view('admin.penduduk21.edit', compact('penduduk21'));
    }

    public function update(Request $request, $id)
    {
        $penduduk21 = Penduduk21::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

       if ($request->file('foto')) {

            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk21->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }


        $penduduk21->update($data);

        return redirect()->route('penduduk21.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk21 = Penduduk21::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk21->foto);

        $penduduk21->delete();

        return redirect()->route('penduduk21.index')->with('success', 'Data berhasil dihapus');
    }
}