<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industri;

class IndustriController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $industri = Industri::where('nama', 'like', "%$keyword%")
                ->orWhere('deskripsi', 'like', "%$keyword%")
                ->get();
        } else {
            $industri = Industri::all();
        }

        return view('industri.index', compact('industri'));
    }
}