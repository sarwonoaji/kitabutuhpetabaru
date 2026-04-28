<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KependudukanController extends Controller
{
    public function index()
    {
        $menuItems = [
            // RW 1
            ['id' => 'penduduk11', 'name' => 'RT 1 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk11.index'],
            ['id' => 'penduduk21', 'name' => 'RT 2 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk21.index'],
            ['id' => 'penduduk31', 'name' => 'RT 3 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk31.index'],
            ['id' => 'penduduk41', 'name' => 'RT 4 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk41.index'],
            ['id' => 'penduduk51', 'name' => 'RT 5 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk51.index'],
            ['id' => 'penduduk61', 'name' => 'RT 6 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk61.index'],
            ['id' => 'penduduk71', 'name' => 'RT 7 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk71.index'],
            ['id' => 'penduduk81', 'name' => 'RT 8 / RW 1', 'icon' => 'rumah1.png', 'route' => 'penduduk81.index'],
            // RW 2
            ['id' => 'penduduk12', 'name' => 'RT 1 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk12.index'],
            ['id' => 'penduduk22', 'name' => 'RT 2 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk22.index'],
            ['id' => 'penduduk32', 'name' => 'RT 3 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk32.index'],
            ['id' => 'penduduk42', 'name' => 'RT 4 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk42.index'],
            ['id' => 'penduduk52', 'name' => 'RT 5 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk52.index'],
            ['id' => 'penduduk62', 'name' => 'RT 6 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk62.index'],
            ['id' => 'penduduk72', 'name' => 'RT 7 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk72.index'],
            ['id' => 'penduduk82', 'name' => 'RT 8 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk82.index'],
            ['id' => 'penduduk92', 'name' => 'RT 9 / RW 2', 'icon' => 'rumah2.png', 'route' => 'penduduk92.index'],
        ];

        return view('kependudukan.index', compact('menuItems'));
    }
}
