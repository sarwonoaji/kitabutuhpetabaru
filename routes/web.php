<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\GrafikTamuController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AsetDesaController;
use App\Http\Controllers\Admin\TernakTaniController;
use App\Http\Controllers\Admin\UMKMAdminController;
use App\Http\Controllers\Admin\IndustriAdminController;
use App\Http\Controllers\Admin\Penduduk11Controller;
use App\Http\Controllers\Admin\Penduduk21Controller;
use App\Http\Controllers\Admin\Penduduk31Controller;
use App\Http\Controllers\Admin\Penduduk41Controller;
use App\Http\Controllers\Admin\Penduduk51Controller;
use App\Http\Controllers\Admin\Penduduk61Controller;
use App\Http\Controllers\Admin\Penduduk71Controller;
use App\Http\Controllers\Admin\Penduduk81Controller;


Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth:admin')->name('admin.dashboard');




Route::middleware('auth:admin')->group(function () {
    Route::get('/ternak-tani/admin', [TernakTaniController::class, 'index'])->name('ternaktani.index');
    Route::delete('/ternak-tani/admin/{id}', [TernakTaniController::class, 'destroy'])->name('ternaktani.delete');
    Route::get('/ternak-tani/admin/create', [TernakTaniController::class, 'create'])->name('ternaktani.create');
    Route::post('/ternak-tani/admin/store', [TernakTaniController::class, 'store'])->name('ternaktani.store');
    Route::get('/ternak-tani/admin/{id}/edit', [TernakTaniController::class, 'edit'])->name('ternaktani.edit');
    Route::match(['put', 'patch'], '/ternak-tani/admin/{id}', [TernakTaniController::class, 'update'])->name('ternaktani.update');
    Route::get('/aset-desa/admin', [AsetDesaController::class, 'index'])->name('aset.index');
    Route::get('/asetdesa/admin/create', [AsetDesaController::class, 'create'])->name('aset.create');
    Route::post('/asetdesa/admin/store', [AsetDesaController::class, 'store'])->name('aset.store');
    Route::get('/asetdesa/admin/{id}/edit', [AsetDesaController::class, 'edit'])->name('aset.edit');
    Route::match(['put', 'patch'], '/asetdesa/admin/{id}', [AsetDesaController::class, 'update'])->name('aset.update');
    Route::delete('/aset-desa/admin/{id}', [AsetDesaController::class, 'destroy'])->name('aset.delete');
    Route::get('/umkm/admin', [UMKMAdminController::class, 'index'])->name('umkm.index');
    Route::get('/umkm/admin/create', [UMKMAdminController::class, 'create'])->name('umkm.create');
    Route::post('/umkm/admin/store', [UMKMAdminController::class, 'store'])->name('umkm.store');
    Route::get('/umkm/admin/{id}/edit', [UMKMAdminController::class, 'edit'])->name('umkm.edit');
    Route::match(['put', 'patch'], '/umkm/admin/{id}', [UMKMAdminController::class, 'update'])->name('umkm.update');
    Route::delete('/umkm/admin/{id}', [UMKMAdminController::class, 'destroy'])->name('umkm.delete');
    Route::get('/industri/admin', [IndustriAdminController::class, 'index'])->name('industri.index');
    Route::get('/industri/admin/create', [IndustriAdminController::class, 'create'])->name('industri.create');
    Route::post('/industri/admin/store', [IndustriAdminController::class, 'store'])->name('industri.store');
    Route::get('/industri/admin/{id}/edit', [IndustriAdminController::class, 'edit'])->name('industri.edit');
    Route::match(['put', 'patch'], '/industri/admin/{id}', [IndustriAdminController::class, 'update'])->name('industri.update');
    Route::delete('/industri/admin/{id}', [IndustriAdminController::class, 'destroy'])->name('industri.delete');

    Route::get('/penduduk/admin', fn() => view('admin.penduduk.card'))->name('penduduk');

    Route::get('/penduduk11/admin', [Penduduk11Controller::class, 'index'])->name('penduduk11.index');
    Route::get('/penduduk11/admin/create', [Penduduk11Controller::class, 'create'])->name('penduduk11.create');
    Route::post('/penduduk11/admin/store', [Penduduk11Controller::class, 'store'])->name('penduduk11.store');
    Route::get('/penduduk11/admin/{id}/edit', [Penduduk11Controller::class, 'edit'])->name('penduduk11.edit');
    Route::match(['put', 'patch'], '/penduduk11/admin/{id}', [Penduduk11Controller::class, 'update'])->name('penduduk11.update');
    Route::delete('/penduduk11/admin/{id}', [Penduduk11Controller::class, 'destroy'])->name('penduduk11.delete');
    
    Route::get('/penduduk21/admin', [Penduduk21Controller::class, 'index'])->name('penduduk21.index');
    Route::get('/penduduk21/admin/create', [Penduduk21Controller::class, 'create'])->name('penduduk21.create');
    Route::post('/penduduk21/admin/store', [Penduduk21Controller::class, 'store'])->name('penduduk21.store');
    Route::get('/penduduk21/admin/{id}/edit', [Penduduk21Controller::class, 'edit'])->name('penduduk21.edit');
    Route::match(['put', 'patch'], '/penduduk21/admin/{id}', [Penduduk21Controller::class, 'update'])->name('penduduk21.update');
    Route::delete('/penduduk21/admin/{id}', [Penduduk21Controller::class, 'destroy'])->name('penduduk21.delete');
    
    Route::get('/penduduk31/admin', [Penduduk31Controller::class, 'index'])->name('penduduk31.index');
    Route::get('/penduduk31/admin/create', [Penduduk31Controller::class, 'create'])->name('penduduk31.create');
    Route::post('/penduduk31/admin/store', [Penduduk31Controller::class, 'store'])->name('penduduk31.store');
    Route::get('/penduduk31/admin/{id}/edit', [Penduduk31Controller::class, 'edit'])->name('penduduk31.edit');
    Route::match(['put', 'patch'], '/penduduk31/admin/{id}', [Penduduk31Controller::class, 'update'])->name('penduduk31.update');
    Route::delete('/penduduk31/admin/{id}', [Penduduk31Controller::class, 'destroy'])->name('penduduk31.delete');       
    
    Route::get('/penduduk41/admin', [Penduduk41Controller::class, 'index'])->name('penduduk41.index');
    Route::get('/penduduk41/admin/create', [Penduduk41Controller::class, 'create'])->name('penduduk41.create');
    Route::post('/penduduk41/admin/store', [Penduduk41Controller::class, 'store'])->name('penduduk41.store');
    Route::get('/penduduk41/admin/{id}/edit', [Penduduk41Controller::class, 'edit'])->name('penduduk41.edit');
    Route::match(['put', 'patch'], '/penduduk41/admin/{id}', [Penduduk41Controller::class, 'update'])->name('penduduk41.update');
    Route::delete('/penduduk41/admin/{id}', [Penduduk41Controller::class, 'destroy'])->name('penduduk41.delete');   
    
    Route::get('/penduduk51/admin', [Penduduk51Controller::class, 'index'])->name('penduduk51.index');
    Route::get('/penduduk51/admin/create', [Penduduk51Controller::class, 'create'])->name('penduduk51.create');
    Route::post('/penduduk51/admin/store', [Penduduk51Controller::class, 'store'])->name('penduduk51.store');
    Route::get('/penduduk51/admin/{id}/edit', [Penduduk51Controller::class, 'edit'])->name('penduduk51.edit');
    Route::match(['put', 'patch'], '/penduduk51/admin/{id}', [Penduduk51Controller::class, 'update'])->name('penduduk51.update');
    Route::delete('/penduduk51/admin/{id}', [Penduduk51Controller::class, 'destroy'])->name('penduduk51.delete');       
    
    Route::get('/penduduk61/admin', [Penduduk61Controller::class, 'index'])->name('penduduk61.index');
    Route::get('/penduduk61/admin/create', [Penduduk61Controller::class, 'create'])->name('penduduk61.create');
    Route::post('/penduduk61/admin/store', [Penduduk61Controller::class, 'store'])->name('penduduk61.store');
    Route::get('/penduduk61/admin/{id}/edit', [Penduduk61Controller::class, 'edit'])->name('penduduk61.edit');
    Route::match(['put', 'patch'], '/penduduk61/admin/{id}', [Penduduk61Controller::class, 'update'])->name('penduduk61.update');
    Route::delete('/penduduk61/admin/{id}', [Penduduk61Controller::class, 'destroy'])->name('penduduk61.delete');       
    
    Route::get('/penduduk71/admin', [Penduduk71Controller::class, 'index'])->name('penduduk71.index');      
    Route::get('/penduduk71/admin/create', [Penduduk71Controller::class, 'create'])->name('penduduk71.create');
    Route::post('/penduduk71/admin/store', [Penduduk71Controller::class, 'store'])->name('penduduk71.store');
    Route::get('/penduduk71/admin/{id}/edit', [Penduduk71Controller::class, 'edit'])->name('penduduk71.edit');
    Route::match(['put', 'patch'], '/penduduk71/admin/{id}', [Penduduk71Controller::class, 'update'])->name('penduduk71.update');
    Route::delete('/penduduk71/admin/{id}', [Penduduk71Controller::class, 'destroy'])->name('penduduk71.delete');   
    
    Route::get('/penduduk81/admin', [Penduduk81Controller::class, 'index'])->name('penduduk81.index');
    Route::get('/penduduk81/admin/create', [Penduduk81Controller::class, 'create'])->name('penduduk81.create');
    Route::post('/penduduk81/admin/store', [Penduduk81Controller::class, 'store'])->name('penduduk81.store');
    Route::get('/penduduk81/admin/{id}/edit', [Penduduk81Controller::class, 'edit'])->name('penduduk81.edit');
    Route::match(['put', 'patch'], '/penduduk81/admin/{id}', [Penduduk81Controller::class, 'update'])->name('penduduk81.update');
    Route::delete('/penduduk81/admin/{id}', [Penduduk81Controller::class, 'destroy'])->name('penduduk81.delete');

});

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


