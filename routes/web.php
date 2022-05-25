<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect('login');
});


Route::middleware(['auth', 'nonstaff'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'guest'])->name('dashboard');  // nonstaff means guest because the middleware have double guest name

    Route::prefix('guestbook')->group(function() {
        Route::get('/create', [GuestbookController::class, 'create'])->name('guestbook.create');
        Route::post('/create', [GuestbookController::class, 'store']);
        Route::get('history', [GuestbookController::class, 'history'])->name('guestbook.history');
    });

    Route::prefix('inventories')->group(function() {
        Route::get('/list', [InventoryController::class, 'list'])->name('inventories.list');
    });
    
    Route::prefix('loans')->group(function() {
        Route::get('/create/{iventory:id}', [LoanController::class, 'create'])->name('loans.create');
        Route::post('/store', [LoanController::class, 'store'])->name('loans.store');
        Route::get('/history', [LoanController::class, 'history'])->name('loans.history');
    });

    Route::prefix('lab')->group(function() {
        Route::get('/info', [EventController::class, 'index'])->name('lab.info');
        Route::get('/info/{event:id}', [EventController::class, 'show'])->name('event.show');
    });

    Route::prefix('feedback')->group(function() {
        Route::get('create', [FeedbackController::class, 'create'])->name('feedback.create');
        Route::post('create', [FeedbackController::class, 'store']);
    });

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });
});

Route::middleware(['auth', 'staff'])->group(function() {
    Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->name('staff.dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
