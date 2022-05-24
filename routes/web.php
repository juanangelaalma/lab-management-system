<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'nonstaff'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'guest'])->name('dashboard');  // nonstaff means guest because the middleware have double guest name

    Route::prefix('guestbook')->group(function() {
        Route::get('/create', [GuestbookController::class, 'create'])->name('guestbook.create');
        Route::post('/create', [GuestbookController::class, 'store']);
        Route::get('history', [GuestController::class, 'history'])->name('guestbook.history');
    });
});

Route::middleware(['auth', 'staff'])->group(function() {
    Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->name('staff.dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
