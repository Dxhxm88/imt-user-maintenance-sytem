<?php

use App\Http\Controllers\api\v1\UserController;
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

Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
    Route::post('/add', 'store')->name('add');
    Route::post('/all', 'index')->name('all');
    Route::post('/edit', 'update')->name('edit');
    Route::post('/delete', 'destroy')->name('delete');
});
