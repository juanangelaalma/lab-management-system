<?php

use App\Http\Controllers\CategoryController;
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

Route::middleware(['auth', 'staff'])->prefix('staff')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'staff'])->name('staff.dashboard');


    Route::prefix('inventories')->group(function() {
        Route::get('/', [InventoryController::class, 'table'])->name('staff.inventories.table');

        Route::get('/create', [InventoryController::class, 'create'])->name('staff.inventories.create');
        Route::post('/create', [InventoryController::class, 'store']);
        Route::get('/{inventory:id}/edit', [InventoryController::class, 'edit'])->name('staff.inventories.edit');
        Route::put('/{inventory:id}/edit', [InventoryController::class, 'update']);
        Route::delete('/{inventory:id}/delete', [InventoryController::class, 'destroy'])->name('staff.inventories.delete');
    });
    
    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('staff.categories.table');

        Route::get('/create', [CategoryController::class, 'create'])->name('staff.categories.create');
        Route::post('/create', [CategoryController::class, 'store']);
        Route::get('/{category:id}/edit', [CategoryController::class, 'edit'])->name('staff.categories.edit');
        Route::put('/{category:id}/edit', [CategoryController::class, 'update']);
        Route::delete('/{category:id}/delete', [CategoryController::class, 'destroy'])->name('staff.categories.delete');
    });

    Route::prefix('loans')->group(function() {
        Route::get('/', [LoanController::class, 'index'])->name('staff.loans.table');
        Route::put('/{loan:id}/asdone', [LoanController::class, 'asdone']);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
