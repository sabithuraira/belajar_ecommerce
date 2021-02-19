<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\PenerbanganController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home/halo', [HomeController::class, 'halo']);
// Route::post('/home/store', [HomeController::class, 'halo']);
Route::resource('barang', BarangController::class);
Route::resource('bandara', BandaraController::class);
Route::resource('penerbangan', PenerbanganController::class);
Route::resource('invoice', InvoiceController::class);
Route::resource('keranjang', KeranjangController::class);
Route::resource('kategori', KategoriController::class);
// Route::get('/barang/edit_dong', [BarangController::class, 'edit_dong']);