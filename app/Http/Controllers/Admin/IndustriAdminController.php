<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriAdminController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = Industri::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('deskripsi', 'like', "%$keyword%");
            });
        }

        $industri = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.industri.index', compact('industri'));
    }

    public function create()
    {
        return view('admin.industri.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        // upload foto
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('industri_', true) . '.' . $file->extension();
            $destination = public_path('img/industri');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        Industri::create($data);

        return redirect()->route('industri.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $industri = Industri::findOrFail($id);
        return view('admin.industri.edit', compact('industri'));
    }

    public function update(Request $request, $id)
    {
        $industri = Industri::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = uniqid('industri_', true) . '.' . $file->extension();
            $destination = public_path('img/industri');

            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $data['foto'] = $filename;
        }

        $industri->update($data);

        return redirect()->route('industri.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Industri::findOrFail($id)->delete();
        return redirect()->route('industri.index')->with('success', 'Data berhasil dihapus');
    }
}