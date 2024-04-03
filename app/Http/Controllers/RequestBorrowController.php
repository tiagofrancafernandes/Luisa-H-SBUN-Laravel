<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\RequestBorrow;

class RequestBorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return 'estou no index';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'integer|exists:App\Models\Book,id',
        ]);

        /**
         * @var Book $book
         */
        $book = Book::findOrFail($request?->integer('book_id'));

        if (!$book?->available) {
            return back()->with('error', __('This book is unavailable.'));
        }

        /**
         * @var RequestBorrow|bool $requestBorrow
         */
        $requestBorrow = $book->requestBorrowThis($request?->user());

        /**
         * Maybe on success, redirect to request_borrow.index??!!
         */
        return $requestBorrow
            ? back()->with('success', __('Request registered successfully!'))
            : back()->with('error', __('Fail on register the request!'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // TODO
    }
}
