<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masukan;
use Illuminate\Http\Request;
use App\Services\ImageService;

class MasukanController extends Controller
{
    private const FOLDER = 'img/masukan';
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Masukan::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keterangan', 'like', "%$keyword%");
            });
        }

        $masukan = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.masukan.index', compact('masukan'));
    }

    public function create()
    {
        return view('admin.masukan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($request->file('foto')) {
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        Masukan::create($data);

        return redirect()->route('masukan.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $masukan = Masukan::findOrFail($id);
        return view('admin.masukan.edit', compact('masukan'));
    }

    public function update(Request $request, $id)
    {
        $masukan = Masukan::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

     if ($request->file('foto')) {

            // hapus foto lama
            ImageService::delete(self::FOLDER, $masukan->foto);

            // upload baru
            $data['foto'] = ImageService::compress(
                $request->file('foto'),
                self::FOLDER
            );
        }

        $masukan->update($data);

        return redirect()->route('masukan.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $masukan = Masukan::findOrFail($id);

        // hapus foto lama
        ImageService::delete(self::FOLDER, $masukan->foto);

        $masukan->delete();

        return redirect()->route('masukan.index')->with('success', 'Data berhasil dihapus');
    }
}