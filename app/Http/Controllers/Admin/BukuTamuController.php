<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $query = BukuTamu::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keperluan', 'like', "%$keyword%");
            });
        }

        $bukutamu = $query->paginate(5)->appends(['keyword' => $keyword]);

        return view('admin.buku_tamu.index', compact('bukutamu'));
    }

    /**
     * Export buku tamu to CSV (Excel-compatible).
     */
    public function export(Request $request)
    {
        $keyword = $request->keyword;

        $query = BukuTamu::orderBy('id', 'desc');

        if ($keyword) {
            $query->where(function ($sub) use ($keyword) {
                $sub->where('nama', 'like', "%$keyword%")
                    ->orWhere('keperluan', 'like', "%$keyword%");
            });
        }

        $rows = $query->get();

        $filename = 'buku_tamu_'.now()->format('Ymd_His').'.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($rows) {
            $out = fopen('php://output', 'w');
            // BOM to make Excel open UTF-8 CSV correctly
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, ['Nama', 'Jenis Kelamin', 'Tanggal', 'Alamat', 'Instansi', 'Keperluan', 'No. HP/Telp']);

            foreach ($rows as $r) {
                fputcsv($out, [
                    $r->nama,
                    $r->jenis_kelamin,
                    function_exists('format_tanggal_id') ? format_tanggal_id($r->tanggal) : $r->tanggal,
                    $r->alamat,
                    $r->instansi,
                    $r->keperluan,
                    $r->hp_telp,
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        return view('admin.buku_tamu.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'instansi' => 'required',
            'keperluan' => 'required',
            'hp_telp' => 'required',
        ]);

        $data['tanggal'] = now()->format('Y-m-d');

        BukuTamu::create($data);

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);
        return view('admin.buku_tamu.edit', compact('bukutamu'));
    }

    public function update(Request $request, $id)
    {
        $bukutamu = BukuTamu::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'instansi' => 'required',
            'keperluan' => 'required',
            'hp_telp' => 'required',
        ]);

        $data['tanggal'] = now()->format('Y-m-d');

        $bukutamu->update($data);

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $bukutamu = BukuTamu::findOrFail($id);

        $bukutamu->delete();

        return redirect()->route('bukutamu.index')
            ->with('success', 'Data berhasil dihapus');
    }
}