<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\RequestBorrow;
use App\Enums\RequestBorrowStatus;

// use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        if ($request?->user()?->isAdmin()) {
            return redirect()->route('admin.books.index');
        }

        return view('books.index', [
            //'books' => DB::table('books')->limit(20)->get(),
            'myBorrowedBooks' => Borrow::where('user_id', auth()->user()->id)
                ->whereNull('returned_at')->select(['user_id', 'book_id'])->pluck('book_id'),

            'myRequestBorrowedBooks' => RequestBorrow::where('user_id', auth()->user()->id)
                ->where('status', RequestBorrowStatus::PENDING)->select(['user_id', 'book_id'])->pluck('book_id'),
            'books' => Book::with('author', 'category')->paginate(20),
        ]);
    }
}
