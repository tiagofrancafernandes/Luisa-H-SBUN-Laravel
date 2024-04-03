<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RequestBorrowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RequestReturnController;

Route::get('/', fn () => to_route('dashboard'))->name('index');
Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::resource('books', BookController::class)->except(['delete']);
Route::match(['get', 'delete', 'post'], 'books/{book}/delete', [BookController::class, 'destroy'])->name('books.destroy');

Route::prefix('request_borrow')->name('request_borrow.')->group(function () {
    Route::get('/', [RequestBorrowController::class, 'index'])->name('index');
    Route::get('/{requestBorrow}', [RequestBorrowController::class, 'show'])->name('show');
    Route::match(
        ['get', 'post'],
        '/{requestBorrow}/update',
        [RequestBorrowController::class, 'update']
    )->name('update');
});

Route::prefix('request_return')->name('request_return.')->group(function () {
    Route::get('/', [RequestReturnController::class, 'index'])->name('index');
    Route::get('/{requestBorrow}', [RequestReturnController::class, 'show'])->name('show');
    Route::match(
        ['get', 'post'],
        '/{requestBorrow}/update',
        [RequestReturnController::class, 'update']
    )->name('update');
});
