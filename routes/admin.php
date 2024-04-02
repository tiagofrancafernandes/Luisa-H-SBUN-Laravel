<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RequestBorrowController;

Route::resource('books', BookController::class);

Route::prefix('request_borrow')->name('request_borrow.')->group(function () {
    Route::get('/', [RequestBorrowController::class, 'index'])->name('index');
    Route::get('/{requestBorrow}', [RequestBorrowController::class, 'show'])->name('show');
    Route::post('/{requestBorrow}/update', [RequestBorrowController::class, 'updade'])->name('updade');
});