<?php

use Illuminate\Support\Facades\Route;
use App\Parsers\Axa;
use App\Parsers\SCC;
use App\Parsers\Rest;
use App\Parsers\Allianz;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;

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

Route::get('/', [AuctionController::class, 'index'])->name('home');
Route::get('auction/{auction}/show', [AuctionController::class, 'show'])->name('auction.show')->middleware('auth');
Route::get('auction', [AuctionController::class, 'index'])->name('auction.index');
Route::get('auction/{auction}/edit', [AuctionController::class, 'edit'])->name('auction.edit')->middleware(['auth','admin.check']);
Route::get('auction/create', [AuctionController::class, 'create'])->name('auction.create')->middleware(['auth','admin.check']);
Route::put('auction/{auction}', [AuctionController::class, 'update'])->name('auction.update')->middleware(['auth','admin.check']);
Route::post('auction', [AuctionController::class, 'store'])->name('auction.store')->middleware(['auth','admin.check']);
Route::delete('auction/{auction}', [AuctionController::class, 'destroy'])->name('auction.destroy')->middleware(['auth','admin.check']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);
