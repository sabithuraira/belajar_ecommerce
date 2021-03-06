<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BandaraController;
use App\Http\Controllers\PenerbanganController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserRoleController;

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
// Route::get('/barang/edit_dong', [BarangController::class, 'edit_dong']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//ini dapat diakses oleh siapa saja, tanpa login
// Route::resource('barang', BarangController::class);
//ini hanya bisa diakses oleh user yang telah melakukan autentikasi
// Route::resource('barang', BarangController::class)->middleware('auth');

//sekumpulan grup routes di dalam kode
//hanya bisa diakses oleh pengguna yang telah melakukan autentikasi
Route::group(['middleware' => 'auth'], function(){
    //pada kode ini fungsi destroy di "except" karena selanjutnya
    //message/destroy hanya bisa diakses oleh pengguna dengan role 'superadmin'
    Route::resource('message', MessageController::class)->except('destroy');
    
    // Route::post('/home/store', [HomeController::class, 'halo']);
    Route::resource('bandara', BandaraController::class);
    Route::resource('penerbangan', PenerbanganController::class)->except('show');
    Route::get('/penerbangan/{id}/show', [PenerbanganController::class, 'show']);
    Route::get('/penerbangan/{id}/tambah_penumpang', [PenerbanganController::class, 'tambah_penumpang']);
    Route::post('/penerbangan/{id}/store_penumpang', [PenerbanganController::class, 'store_penumpang']);
    Route::get('/penerbangan/create_many', [PenerbanganController::class, 'create_many']);
    Route::post('/penerbangan/store_many', [PenerbanganController::class, 'store_many']);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('keranjang', KeranjangController::class)->except('show');
    Route::get('keranjang/beli_semua', [KeranjangController::class, 'beli_semua']);
    Route::post('keranjang/beli_sebagian', [KeranjangController::class, 'beli_sebagian']);
    
    Route::get('/barang/{id}/add_review', [BarangController::class, 'add_review']);
    Route::post('/barang/{id}/store_review', [BarangController::class, 'store_review']);
    Route::post('/barang/store_keranjang', [BarangController::class, 'store_keranjang']);
    Route::get('/keranjang/{id}/pindah_ke_invoice', [KeranjangController::class, 'pindahKeInvoice']);
    
    Route::get('/barang/{id}/print_pdf', [BarangController::class, 'print_pdf']);
});

//controller atau fungsi di bawah group ini
//hanya bisa diakses oleh user dengan level superadmin atau pedagang
Route::group(['middleware' => ['role:superadmin|pedagang']], function () {   
    Route::resource('barang', BarangController::class);
}); 

//yang bisa mengakses routes di bawah hanya user yang telah login dan memiliki tipe superadmin
Route::group(['middleware' => ['role:superadmin']], function () {    
    Route::resource('kategori', KategoriController::class);
    
    //ini adalah function menghapus message, yang hanya bisa diakses oleh 'superadmin'
    Route::delete('/message/{id}', [MessageController::class, 'destroy']);

    // ROUTE untuk pengaturan ROLE, PERMISSION dan USER ROLE
    Route::resource('permission',PermissionController::class)->except(['show', 'edit', 'update', 'create', 'destroy']);
    Route::resource('role',RoleController::class)->except(['show', 'edit', 'update', 'create', 'destroy']);
    Route::resource('user_role',UserRoleController::class)->except(['show', 'create', 'store', 'destroy']);
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function () {
//         // Uses first & second middleware...
//     });

//     Route::get('/user/profile', function () {
//         // Uses first & second middleware...
//     });
// });
