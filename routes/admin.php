<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RequestBorrowController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn () => to_route('dashboard'))->name('index');
Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::resource('books', BookController::class);

Route::prefix('request_borrow')->name('request_borrow.')->group(function () {
    Route::get('/', [RequestBorrowController::class, 'index'])->name('index');
    Route::get('/{requestBorrow}', [RequestBorrowController::class, 'show'])->name('show');
    Route::match(
        ['get', 'post'],
        '/{requestBorrow}/update',
        [RequestBorrowController::class, 'update']
    )->name('update');
});
