<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});*/

Route::controller(ProductoController::class)->group(function(){
    Route::get('/producto', 'index');
    Route::post('/producto', 'store');
    Route::put('/producto/{producto}', 'update');
    Route::delete('/producto/{id}', 'delete');
    Route::get('/producto/{id}', 'showProducto');
});

Route::controller(CategoriaController::class)->group(function(){
    Route::get('/categoria', 'index');
    
});