<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk11;
use App\Models\Penduduk21;
use App\Models\Penduduk31;
use App\Models\Penduduk41;
use App\Models\Penduduk51;
use App\Models\Penduduk61;
use App\Models\Penduduk71;
use App\Models\Penduduk81;
use App\Models\Penduduk12;
use App\Models\Penduduk22;
use App\Models\Penduduk32;
use App\Models\Penduduk42;
use App\Models\Penduduk52;
use App\Models\Penduduk62;
use App\Models\Penduduk72;
use App\Models\Penduduk82;
use App\Models\Penduduk92;

class PendudukMapController extends Controller
{
    /**
     * Mapping dari ID penduduk ke model class
     */
    private $modelMap = [
        'penduduk11' => Penduduk11::class,
        'penduduk21' => Penduduk21::class,
        'penduduk31' => Penduduk31::class,
        'penduduk41' => Penduduk41::class,
        'penduduk51' => Penduduk51::class,
        'penduduk61' => Penduduk61::class,
        'penduduk71' => Penduduk71::class,
        'penduduk81' => Penduduk81::class,
        'penduduk12' => Penduduk12::class,
        'penduduk22' => Penduduk22::class,
        'penduduk32' => Penduduk32::class,
        'penduduk42' => Penduduk42::class,
        'penduduk52' => Penduduk52::class,
        'penduduk62' => Penduduk62::class,
        'penduduk72' => Penduduk72::class,
        'penduduk82' => Penduduk82::class,
        'penduduk92' => Penduduk92::class,
    ];

    /**
     * Mapping dari ID penduduk ke label RT/RW
     */
    private $labelMap = [
        'penduduk11' => 'RT 1 / RW 1',
        'penduduk21' => 'RT 2 / RW 1',
        'penduduk31' => 'RT 3 / RW 1',
        'penduduk41' => 'RT 4 / RW 1',
        'penduduk51' => 'RT 5 / RW 1',
        'penduduk61' => 'RT 6 / RW 1',
        'penduduk71' => 'RT 7 / RW 1',
        'penduduk81' => 'RT 8 / RW 1',
        'penduduk12' => 'RT 1 / RW 2',
        'penduduk22' => 'RT 2 / RW 2',
        'penduduk32' => 'RT 3 / RW 2',
        'penduduk42' => 'RT 4 / RW 2',
        'penduduk52' => 'RT 5 / RW 2',
        'penduduk62' => 'RT 6 / RW 2',
        'penduduk72' => 'RT 7 / RW 2',
        'penduduk82' => 'RT 8 / RW 2',
        'penduduk92' => 'RT 9 / RW 2',
    ];

    public function show($id, Request $request)
    {
        // Validasi ID
        if (!isset($this->modelMap[$id])) {
            abort(404, 'Data tidak ditemukan');
        }

        $modelClass = $this->modelMap[$id];
        $label = $this->labelMap[$id];

        // Query dengan search jika ada
        $query = $modelClass::query();
        
        if ($request->has('keyword') && !empty($request->keyword)) {
            $keyword = $request->keyword;
            $query->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('keterangan', 'like', "%{$keyword}%");
        }

        $penduduk = $query->get();

        return view('penduduk.map', [
            'penduduk' => $penduduk,
            'label' => $label,
            'id' => $id,
            'keyword' => $request->get('keyword', '')
        ]);
    }
}
