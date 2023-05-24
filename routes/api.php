<?php

use App\Http\Controllers\PadletContainerController;
use App\Http\Controllers\PadletController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('auth/login', [AuthController::class,'login']);

Route::get("padlets", [PadletController::class,'index']);
Route::get("padlets/{id}", [PadletController::class,'findPadletById']);

/* Route for PadletContainer */
Route::get("padletcontainers", [PadletContainerController::class, 'index']);
Route::get("padletcontainers/{id}", [PadletContainerController::class, 'findContainerById']);

//Route::post("padletcontainers/{id}", [PadletContainerController::class, 'findContainerById',]);
//Route::post("admin", [PadletContainerController::class, 'findContainerById']);

Route::group(['middleware' => ['api', 'auth.jwt']], function () {
    Route::post('padlets', [PadletController::class,'save']);
    Route::put('padlets/{id}', [PadletController::class,'update']);
    Route::delete('padlets/{id}', [PadletController::class,'delete']);
    Route::post('auth/logout', [AuthController::class,'logout']);
});
