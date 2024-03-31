<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestBorrowController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'myBorrowedBooks' => \App\Models\Borrow::latest('updated_at')
            ->with('book')
            ->where('user_id', auth()->user()->id)
            ->limit(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/books', function () {
    //dd($books);
    //dump and die, debug only
    return view('books.index', [
        //'books' => DB::table('books')->limit(20)->get(),
        'myBorrowedBooks' => \App\Models\Borrow::where('user_id', auth()->user()->id)
            ->whereNull('returned_at')->select(['user_id', 'book_id'])->pluck('book_id'),
        'books' => \App\Models\Book::with('author', 'category')->paginate(20),
    ]);
})->middleware(['auth'])->name('books.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('request_borrow', RequestBorrowController::class);

require __DIR__.'/auth.php';
