<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TernakTani;
use Illuminate\Http\Request;
use App\Services\ImageService;

class TernakTaniController extends Controller
{
    private const FOLDER = 'img/ternak-tani';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = TernakTani::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%");
            });
        }

        $ternaktani = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.ternaktani.index', compact('ternaktani'));
    }

    public function create()
    {
        return view('admin.ternaktani.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'jenis' => 'required',
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

        TernakTani::create($data);

        return redirect()->route('ternaktani.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ternaktani = TernakTani::findOrFail($id);
        return view('admin.ternaktani.edit', compact('ternaktani'));
    }

    public function update(Request $request, $id)
    {
        $ternaktani = TernakTani::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'jenis' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            // hapus foto lama
            ImageService::delete(self::FOLDER, $ternaktani->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $ternaktani->update($data);

        return redirect()->route('ternaktani.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $ternaktani = TernakTani::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $ternaktani->foto);

        $ternaktani->delete();

        return redirect()->route('ternaktani.index')->with('success', 'Data berhasil dihapus');
    }
}