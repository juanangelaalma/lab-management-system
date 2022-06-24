<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GuestbookController;
use App\Http\Controllers\Api\InventoryController;
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

Route::controller(AuthController::class)->group( function(){
    Route::get('me', 'me');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(GuestbookController::class)->prefix('guestbooks')->group(function() {
    Route::get('history', 'history')->middleware('auth:sanctum');
    Route::post('create', 'create')->middleware('auth:sanctum');
});

Route::controller(InventoryController::class)->prefix('inventories')->group(function() {
    Route::get('/', 'index')->middleware('auth:sanctum');
});