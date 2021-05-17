<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("/productos", \App\Http\Controllers\ProductoController::class); //CRUD de una tabla
Route::put("set_like/{producto}", [\App\Http\Controllers\ProductoController::class, 'setLike'])->name('set_like');
Route::put("set_dislike/{producto}", [\App\Http\Controllers\ProductoController::class, 'setDislike'])->name('set_Dislike');
Route::put("set_imagen/{producto}", [\App\Http\Controllers\ProductoController::class, 'setImagen'])->name('set_imagen');


//Route::get("/productos", [\App\Http\Controllers\ProductoController::class, 'index']);
//Route::get("/productos/{id}", [\App\Http\Controllers\ProductoController::class, 'show']);
//Route::delete("/productos/{id}", [\App\Http\Controllers\ProductoController::class, 'destroy']);
//Route::post("/productos", [\App\Http\Controllers\ProductoController::class, 'store']);
//Route::put("/productos/{id}", [\App\Http\Controllers\ProductoController::class, 'update']);
