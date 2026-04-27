<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk61;
use Illuminate\Http\Request;
use App\Services\ImageService;

class Penduduk61Controller extends Controller
{
    private const FOLDER = 'img/penduduk61';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Penduduk61::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $penduduk61 = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.penduduk61.index', compact('penduduk61'));
    }

    public function create()
    {
        return view('admin.penduduk61.create');
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

        Penduduk61::create($data);

        return redirect()->route('penduduk61.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penduduk61 = Penduduk61::findOrFail($id);
        return view('admin.penduduk61.edit', compact('penduduk61'));
    }

    public function update(Request $request, $id)
    {
        $penduduk61 = Penduduk61::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $penduduk61->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $penduduk61->update($data);

        return redirect()->route('penduduk61.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $penduduk61 = Penduduk61::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $penduduk61->foto);

        $penduduk61->delete();

        return redirect()->route('penduduk61.index')->with('success', 'Data berhasil dihapus');
    }
}