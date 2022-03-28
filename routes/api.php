<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;

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


Route::group(['prefix' => 'category'], function () use ($router) {
    Route::post('/', [CategoryController::class, 'createCategory']);
    Route::get('/', [CategoryController::class, 'getAllCategories']);
    Route::get('/{id}', [CategoryController::class, 'getCategory']);
    Route::put('/{id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/{id}', [CategoryController::class, 'deleteCategory']);
});

Route::group(['prefix' => 'status'], function () use ($router) {
    Route::post('/', [StatusController::class, 'createStatus']);
    Route::get('/', [StatusController::class, 'getAllStatus']);
    Route::get('/{id}', [StatusController::class, 'getStatus']);
    Route::put('/{id}', [StatusController::class, 'updateStatus']);
    Route::delete('/{id}', [StatusController::class, 'deleteStatus']);
});

Route::group(['prefix' => 'item'], function () use ($router) {
    Route::post('/', [StatusController::class, 'createStatus']);
    Route::get('/', [StatusController::class, 'getAllStatus']);
    Route::get('/{id}', [StatusController::class, 'getStatus']);
    Route::put('/{id}', [StatusController::class, 'updateStatus']);
    Route::delete('/{id}', [StatusController::class, 'deleteStatus']);
});
