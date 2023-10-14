<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\StockController;
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
    return view('dashboard', [
        'page' => 'home'
    ]);
})->name('dashboard');

/**
 * applications
 */
Route::prefix('/applications')->name('applications.')->group(function () {
    Route::get('/', [ApplicationController::class, 'index'])->name('index');
    Route::get('/{id}', [ApplicationController::class, 'show'])->name('show');
    Route::post('/', [ApplicationController::class, 'store'])->name('store');
    Route::put('/{id}', [ApplicationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApplicationController::class, 'destroy'])->name('destroy');
});

/**
 * categories
 */
Route::prefix('/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
    Route::post('/', [CategoryController::class, 'store'])->name('store');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

/**
 * finishings
 */
Route::prefix('/finishings')->name('finishings.')->group(function () {
    Route::get('/', [FinishingController::class, 'index'])->name('index');
    Route::get('/{id}', [FinishingController::class, 'show'])->name('show');
    Route::post('/', [FinishingController::class, 'store'])->name('store');
    Route::put('/{id}', [FinishingController::class, 'update'])->name('update');
    Route::delete('/{id}', [FinishingController::class, 'destroy'])->name('destroy');
});

/**
 * furnitures
 */
Route::prefix('/furnitures')->name('furnitures.')->group(function () {
    Route::get('/create', [FurnitureController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [FurnitureController::class, 'edit'])->name('edit');
    Route::get('/', [FurnitureController::class, 'index'])->name('index');
    Route::get('/{id}', [FurnitureController::class, 'show'])->name('show');
    Route::post('/', [FurnitureController::class, 'store'])->name('store');
    Route::put('/{id}', [FurnitureController::class, 'update'])->name('update');
    Route::delete('/{id}', [FurnitureController::class, 'destroy'])->name('destroy');
});

/**
 * materials
 */
Route::prefix('/materials')->name('materials.')->group(function () {
    Route::get('/', [MaterialController::class, 'index'])->name('index');
    Route::get('/{id}', [MaterialController::class, 'show'])->name('show');
    Route::post('/', [MaterialController::class, 'store'])->name('store');
    Route::put('/{id}', [MaterialController::class, 'update'])->name('update');
    Route::delete('/{id}', [MaterialController::class, 'destroy'])->name('destroy');
});

/**
 * stock_ins
 */
Route::prefix('/stock_ins')->name('stock_ins.')->group(function () {
    Route::get('/create', [StockController::class, 'create'])->name('create');
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::get('/{id}', [StockController::class, 'show'])->name('show');
    Route::post('/', [StockController::class, 'store'])->name('store');
    Route::put('/{id}', [StockController::class, 'update'])->name('update');
    Route::delete('/{id}', [StockController::class, 'destroy'])->name('destroy');
});
/**
 * stock_outs
 */
Route::prefix('/stock_outs')->name('stock_outs.')->group(function () {
    Route::get('/create', [StockController::class, 'create'])->name('create');
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::get('/{id}', [StockController::class, 'show'])->name('show');
    Route::post('/', [StockController::class, 'store'])->name('store');
    Route::put('/{id}', [StockController::class, 'update'])->name('update');
    Route::delete('/{id}', [StockController::class, 'destroy'])->name('destroy');
});
