<?php

use Illuminate\Support\Facades\Route;
use App\Parsers\Axa;
use App\Parsers\SCC;
use App\Parsers\Rest;
use App\Parsers\Allianz;
use App\Http\Controllers\AuctionController;

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

Route::get('/axa-download', [Axa::class, 'save']);
Route::get('/scc-download', [SCC::class, 'save']);
Route::get('/rest-download', [Rest::class, 'save']);
Route::get('/allianz-download', [Allianz::class, 'save']);

Route::get('/', [AuctionController::class, 'index']);
Route::resource('/auction', AuctionController::class);
