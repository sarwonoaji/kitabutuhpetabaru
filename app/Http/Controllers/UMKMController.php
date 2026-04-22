<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UMKM;

class UMKMController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $umkm = UMKM::where('nama', 'like', "%$keyword%")
                ->orWhere('deskripsi', 'like', "%$keyword%")
                ->get();
        } else {
            $umkm = UMKM::all();
        }

        return view('umkm.index', compact('umkm'));
    }
}