<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiBarangController;
use App\Http\Controllers\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route di bawah group ini, hanya bisa diakses oleh pengguna yang telah
//menyertakan token dari sanctum
Route::group(['middleware' => ['auth:sanctum']], function () {   
    Route::resource('barang', ApiBarangController::class);
}); 

//semua url pada file ini diakses pada "localhost/nama_project/public/api"

//untuk index url = localhost/nama_project/public/api/barang (GET)
//untuk store url = localhost/nama_project/public/api/barang (POST)
//untuk update url = localhost/nama_project/public/api/barang/{id} (PUT)
//untuk destroy url = localhost/nama_project/public/api/barang/{id} (DELETE)
//route ini bisa diakses oleh siapapun
// Route::resource('barang', ApiBarangController::class);


Route::post('/login', [ApiAuthController::class, 'login']);