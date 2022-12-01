<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
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

Route::get('/', [AffiliateController::class,'index'])->name('affiliates');
Route::get('/parse', [AffiliateController::class,'insert'])->name('parse');
Route::get('/filter', [AffiliateController::class,'filter'])->name('filter');