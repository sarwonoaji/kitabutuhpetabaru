<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TernakTani;

class TernakController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $ternaktani = TernakTani::where('nama', 'like', "%$keyword%")
                ->orWhere('jenis', 'like', "%$keyword%")
                ->get();
        } else {
            $ternaktani = TernakTani::all();
        }

        return view('ternak-tani.index', compact('ternaktani'));
    }
}