<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RequestBorrowController;
use App\Http\Controllers\RequestReturnController;
use App\Http\Controllers\BorrowController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn () => view('welcome'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
    });

    Route::prefix('borrows')->name('borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('index');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('request_borrow')->name('request_borrow.')->group(function () {
        Route::get('/', [RequestBorrowController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'store', [RequestBorrowController::class, 'store'])->name('store');
        Route::match(['delete', 'post'], 'destroy', [RequestBorrowController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('request_return')->name('request_return.')->group(function () {
        Route::get('/', [RequestReturnController::class, 'index'])->name('index');
        Route::match(['get', 'post'], 'store', [RequestReturnController::class, 'store'])->name('store');
        Route::match(['delete', 'post'], 'destroy', [RequestReturnController::class, 'destroy'])->name('destroy');
    });
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin')
    ->group(function () {
        require __DIR__ . '/admin.php';
    });

require __DIR__ . '/auth.php';
