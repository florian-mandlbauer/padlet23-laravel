<?php

use App\Http\Controllers\PadletController;
use App\Models\Padlet;
use Illuminate\Support\Facades\Route;

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

// ROUTE 1 - index (Hauptseite)
Route::get('/', [PadletController::class, 'index']);

// ROUTE 2 - Mehrere Padlets mit Links
Route::get('/padlets', [PadletController::class, 'index']);

// ROUTE 3 - Einzelnes Padlet anzeigen
Route::get('/padlets/{padlet}', [PadletController::class, 'show']);

