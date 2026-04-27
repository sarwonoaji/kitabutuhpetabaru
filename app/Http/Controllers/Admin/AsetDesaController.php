<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;
use App\Services\ImageService;

class AsetDesaController extends Controller
{
    private const FOLDER = 'img/aset';

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Aset::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('kegunaan', 'like', "%$keyword%");
            });
        }

        $asetdesa = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.aset.index', compact('asetdesa'));
    }

    public function create()
    {
        return view('admin.aset.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'kegunaan' => 'required',
            'luas' => 'required',
            'no_sertifikat' => 'required',
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

        Aset::create($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        return view('admin.aset.edit', compact('aset'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'kegunaan' => 'required',
            'luas' => 'required',
            'no_sertifikat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {

            // hapus foto lama
            ImageService::delete(self::FOLDER, $aset->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $aset->update($data);

        return redirect()->route('aset.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);

        // hapus file
        ImageService::delete(self::FOLDER, $aset->foto);

        $aset->delete();

        return redirect()->route('aset.index')
            ->with('success', 'Data berhasil dihapus');
    }
}