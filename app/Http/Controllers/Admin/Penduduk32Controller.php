<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk32;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk32Controller extends Controller
{
    private const FOLDER = 'img/penduduk32';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk32::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk32 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk32.index', compact('penduduk32'));
    }

    public function create()
    {
        return view('admin.penduduk32.create');
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

        Penduduk32::create($data);

        return redirect()->route('penduduk32.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk32 = Penduduk32::findOrFail($id);
        return view('admin.penduduk32.edit', compact('penduduk32'));
    }

    public function update(Request $request, $id)
    {
        $penduduk32 = Penduduk32::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk32->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk32->update($data);

        return redirect()->route('penduduk32.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk32 = Penduduk32::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk32->foto);

        $penduduk32->delete();

        return redirect()->route('penduduk32.index')->with('success', 'Data berhasil dihapus');
    }
}