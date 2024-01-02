<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemInOutController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index']);
Route::get('/toko', [LandingController::class, 'listoutlet'])->name('toko.index');
Route::get('/toko/detail/{outlet}', [LandingController::class, 'detailoutlet'])->name('toko.detail');

Auth::routes();

Route::get('logout', function() {
	Auth::logout();

    return redirect('/login');
})->name('logout-user');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
Route::middleware(['auth','authtype:admin'])->group(function() {
	Route::resource('kategori', KategoriController::class)->except('show');
	Route::resource('kecamatan', KecamatanController::class)->except('show');
	Route::resource('outlet', OutletController::class);
	Route::get('admin/produk', [ProdukController::class, 'indexadmin'])->name('produk.index.admin');
});

Route::middleware(['auth','authtype:outlet'])->group(function() {
	Route::resource('produk', ProdukController::class)->except('show');
	Route::get('user', [UserController::class, 'index'])->name('user.index');
	Route::get('user/edit', [UserController::class, 'edit'])->name('user.edit');
	Route::put('user/update', [UserController::class, 'update'])->name('user.update');
	Route::resource('iteminout', ItemInOutController::class)->except('show');
});