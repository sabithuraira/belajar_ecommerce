<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiBarangController;

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

//semua url pada file ini diakses pada "localhost/nama_project/public/api"

//untuk index url = localhost/nama_project/public/api/barang (GET)
//untuk store url = localhost/nama_project/public/api/barang (POST)
//untuk update url = localhost/nama_project/public/api/barang/{id} (PUT)
//untuk destroy url = localhost/nama_project/public/api/barang/{id} (DELETE)
Route::resource('barang', ApiBarangController::class);