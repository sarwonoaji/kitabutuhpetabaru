<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $aset = Aset::where('nama', 'like', "%$keyword%")
                ->orWhere('kegunaan', 'like', "%$keyword%")
                ->get();
        } else {
            $aset = Aset::all();
        }

        return view('aset.index', compact('aset'));
    }
}