<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;

class AsetDesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::query();

        // 🔍 Search
        if ($request->keyword) {
            $query->where('nama', 'like', '%' . $request->keyword . '%');
        }

        // 📄 Pagination
        $asetdesa = $query->orderBy('id', 'desc')->paginate(5);

        return view('admin.aset.index', compact('asetdesa'));
    }
}