<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function() {
    return 'dashbord guest';
})->middleware(['auth', 'nonstaff'])->name('dashboard'); // nonstaff means guest because the middleware have double guest name

Route::get('/staff/dashboard', function() {
    return 'dashboad staff';
})->middleware(['auth', 'staff'])->name('staff.dashboard');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
