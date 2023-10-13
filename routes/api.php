<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinishingController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\MaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * users
 */
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


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
