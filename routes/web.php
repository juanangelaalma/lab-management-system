<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\GuestController;
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

    Route::controller(GuestbookController::class)->prefix('guestbook')->name('guestbook.')->group(function(){
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store');
        Route::get('history', 'history')->name('history');
    });

    Route::prefix('inventories')->group(function() {
        Route::get('/list', [InventoryController::class, 'list'])->name('inventories.list');
    });

    Route::controller(LoanController::class)->prefix('loans')->name('loans.')->group(function() {
        Route::get('create/{inventory:id}', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('history', 'history')->name('history');
    });

    Route::controller(EventController::class)->prefix('lab')->group(function() {
        Route::get('info', 'index')->name('lab.info');
        Route::get('info/{event:id}', 'show')->name('event.show');
    });

    Route::controller(FeedbackController::class)->prefix('feedback')->name('feedback.')->group(function() {
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function() {
        Route::get('/', 'index')->name('profile');
        Route::put('/', 'update')->name('profile.update');
    });
});

Route::middleware(['auth', 'staff'])->prefix('staff')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'staff'])->name('staff.dashboard');

    Route::controller(InventoryController::class)->prefix('inventories')->name('staff.inventories.')->group(function() {
        Route::get('/', 'table')->name('table');

        Route::get('create', 'create')->name('create');
        Route::post('create', 'store');
        Route::get('{inventory:id}/edit', 'edit')->name('edit');
        Route::put('{inventory:id}/edit', 'update');
        Route::delete('{inventory:id}/delete', 'destroy')->name('delete');
    });
    
    Route::controller(  CategoryController::class)->prefix('categories')->name('staff.categories.')->group(function() {
        Route::get('/', 'index')->name('table');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store');
        Route::get('/{category:id}/edit', 'edit')->name('edit');
        Route::put('/{category:id}/edit', 'update');
        Route::delete('/{category:id}/delete', 'destroy')->name('delete');
    });

    Route::controller(LoanController::class)->prefix('loans')->name('staff.loans.')->group(function() {
        Route::get('/', 'index')->name('table');
        Route::put('{loan:id}/asdone', 'asdone');
    });

    Route::controller(EventController::class)->prefix('info')->name('staff.info.')->group(function(){
        Route::get('/', 'table')->name('table');

        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/{event:id}/edit', 'edit')->name('edit');
        Route::put('/{event:id}/edit', 'update')->name('update');
        Route::delete('/{event:id}/delete', 'destroy')->name('delete');
    });

    Route::get('guestbook', [GuestbookController::class, 'index'])->name('staff.guestbook.table');

    Route::get('feedback', [FeedbackController::class, 'index'])->name('staff.feedback.table');

    Route::prefix('guests')->group(function() {
        Route::get('/', [GuestController::class, 'index'])->name('staff.guests.table');

        Route::get('{user:id}/details', [GuestController::class, 'details'])->name('staff.guests.details');

        Route::delete('{guest:id}/delete', [GuestController::class, 'destroy'])->name('staff.guests.delete');
    });

    Route::controller(GuestController::class)->prefix('guest')->name('staff.guests.')->group(function() {
        Route::get('/', 'index')->name('table');

        Route::get('{user:id}/details', 'details')->name('details');

        Route::delete('{guest:id}/delete', 'destroy')->name('delete');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('test', 'test');