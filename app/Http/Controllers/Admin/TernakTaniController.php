<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TernakTani;
use Illuminate\Http\Request;

class TernakTaniController extends Controller
{
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
            $file = $request->file('foto');
            $filename = uniqid('ternaktani_', true) . '.' . $file->extension();
            $destination = public_path('img/ternak-tani');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
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
            $file = $request->file('foto');
            $filename = uniqid('ternaktani_', true) . '.' . $file->extension();
            $destination = public_path('img/ternak-tani');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        $ternaktani->update($data);

        return redirect()->route('ternaktani.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        TernakTani::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}