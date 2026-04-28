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
use App\Models\UMKM;
use App\Models\TernakTani;
use App\Models\Industri;

class InformasiController extends Controller
{
    public function index()
    {
        $count1 = Penduduk11::count();
        $count2 = Penduduk21::count();
        $count3 = Penduduk31::count();
        $count4 = Penduduk41::count();
        $count5 = Penduduk51::count();
        $count6 = Penduduk61::count();
        $count7 = Penduduk71::count();
        $count8 = Penduduk81::count();
        $count9 = Penduduk12::count();
        $count10 = Penduduk22::count();
        $count11 = Penduduk32::count();
        $count12 = Penduduk42::count();
        $count13 = Penduduk52::count();
        $count14 = Penduduk62::count();
        $count15 = Penduduk72::count();
        $count16 = Penduduk82::count();
        $count17 = Penduduk92::count();
        $count18 = UMKM::count();
        $count19 = TernakTani::where('jenis', 'ternaktani')->count();
        $count20 = TernakTani::where('jenis', 'ternak')->count();
        $count21 = TernakTani::where('jenis', 'tani')->count();
        $count22 = Industri::count();

        return view('informasi.index', compact(
            'count1', 'count2', 'count3', 'count4', 'count5', 'count6', 'count7', 'count8',
            'count9', 'count10', 'count11', 'count12', 'count13', 'count14', 'count15', 'count16',
            'count17', 'count18', 'count19', 'count20', 'count21', 'count22'
        ));
    }
}