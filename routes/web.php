<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockInSelectController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\StockOutSelectController;
use App\Http\Controllers\SuplierController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/furnitures', FurnitureController::class);
Route::resource('/supliers', SuplierController::class);
Route::resource('/buyers', BuyerController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/materials', MaterialController::class);
Route::resource('/applications', ApplicationController::class);
Route::resource('/finishings', FinishingController::class);
Route::resource('/stockins', StockInController::class);
Route::resource('/stockinselects', StockInSelectController::class);
Route::resource('/stockouts', StockOutController::class);
Route::resource('/stockoutselects', StockOutSelectController::class);
