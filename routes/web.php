<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\GrafikTamuController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AsetDesaController;



Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');


Route::get('/admin/aset', [AsetDesaController::class, 'index'])
    ->middleware('auth:admin')
    ->name('aset-admin');


Route::get('/', function () {
    return view('welcome'); // ganti dari 'welcome' ke 'home'
});

// ================= MENU UTAMA =================
Route::get('/kependudukan', fn() => view('kependudukan.index'))->name('kependudukan');
//Route::get('/aset-desa', fn() => view('aset.index'))->name('aset');
Route::get('/aset-desa', [AsetController::class, 'index'])->name('aset');
Route::get('/ternak-tani', [TernakController::class, 'index'])->name('ternak');
Route::get('/umkm', [UMKMController::class, 'index'])->name('umkm');
Route::get('/industri', [IndustriController::class, 'index'])->name('industri');
Route::get('/informasi', fn() => view('informasi.index'))->name('informasi');

// ================= FITUR =================



Route::get('/grafik-tamu', [GrafikTamuController::class, 'index'])->name('grafik');
//Route::get('/grafik-tamu', fn() => view('tamu.grafik'))->name('grafik');
Route::get('/layanan', fn() => view('layanan.index'))->name('layanan');




// ================= PERSYARATAN =================
Route::get('/persyaratan', fn() => view('persyaratan.index'))->name('persyaratan');
// KK & KTP
Route::get('/persyaratan/kk', fn() => view('persyaratan.kk'))->name('persyaratan.kk');
Route::get('/persyaratan/ktp', fn() => view('persyaratan.ktp'))->name('persyaratan.ktp');

// Pindah
Route::get('/persyaratan/pindah-datang', fn() => view('persyaratan.pindah-datang'))->name('persyaratan.pindah-datang');
Route::get('/persyaratan/pindah-keluar', fn() => view('persyaratan.pindah-keluar'))->name('persyaratan.pindah-keluar');

// KIA & KTS
Route::get('/persyaratan/kia', fn() => view('persyaratan.kia'))->name('persyaratan.kia');
Route::get('/persyaratan/kts', fn() => view('persyaratan.kts'))->name('persyaratan.kts');

// Akta
Route::get('/persyaratan/akta-kelahiran', fn() => view('persyaratan.akta-kelahiran'))->name('persyaratan.akta-kelahiran');
Route::get('/persyaratan/akta-kematian', fn() => view('persyaratan.akta-kematian'))->name('persyaratan.akta-kematian');

// Perkawinan & Perceraian
Route::get('/persyaratan/pencatatan-perkawinan', fn() => view('persyaratan.pencatatan-perkawinan'))->name('persyaratan.pencatatan-perkawinan');
Route::get('/persyaratan/perceraian', fn() => view('persyaratan.perceraian'))->name('persyaratan.perceraian');

// Perubahan data
Route::get('/persyaratan/perubahan-nama', fn() => view('persyaratan.perubahan-nama'))->name('persyaratan.perubahan-nama');

// Anak
Route::get('/persyaratan/pengakuan-anak', fn() => view('persyaratan.pengakuan-anak'))->name('persyaratan.pengakuan-anak');
Route::get('/persyaratan/pengesahan-anak', fn() => view('persyaratan.pengesahan-anak'))->name('persyaratan.pengesahan-anak');
Route::get('/persyaratan/pengangkatan-anak', fn() => view('persyaratan.pengangkatan-anak'))->name('persyaratan.pengangkatan-anak');
Route::get('/masukan', fn() => view('masukan.index'))->name('masukan');



// ================= DEFAULT BAWAAN =================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Static pages
Route::get('/about', fn() => view('about_page'));
Route::get('/contact', fn() => view('contact_page'));
Route::get('/login', fn() => view('admin.login'));


