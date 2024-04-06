<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookUpdateRequest;
use App\Models\Author;
use App\Models\Category;
use App\Http\Requests\Admin\BookStoreRequest;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderBy = in_array($request->input('orderBy'), Book::query()?->getModel()->getFillable())
            ? $request->input('orderBy') : 'id';
        $sortDir = in_array($request->input('dir'), ['asc', 'desc', 'ASC', 'DESC']) ? $request->input('dir') : 'asc';

        $search = $request->input('search');

        $search = filled($search) && is_string($search) ? strtolower(trim($search)) : null;

        return view('admin.books.index', [
            'records' => Book::orderBy($orderBy, $sortDir)
                ->when($search, function ($query, $s) {
                    return $query
                    // ->orWhere(DB::raw('LOWER(sinopsis)'), 'like', "%{$s}%")
                    ->orWhere(DB::raw('LOWER(id)'), 'like', "%{$s}%")
                    ->orWhere(DB::raw('LOWER(title)'), 'like', "%{$s}%")
                    ->orWhere(DB::raw('LOWER(reference)'), 'like', "%{$s}%");
                })
                ->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.books.form', [
            'record' => null,
            'request' => $request,
            'authors' => Author::keyValue(),
            'categories' => Category::keyValue(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookStoreRequest $request)
    {
        $validated = [
            'title' => $request->validated('title'),
            'quantity' => $request->validated('quantity'),
            'reference' => $request->validated('reference'),
            'sinopsis' => $request->validated('sinopsis'),
            'author_id' => $request->validated('author_id'),
            'category_id' => $request->validated('category_id'),
        ];

        $book = Book::create($validated);

        if ($book) {
            return redirect()
                ->route('admin.books.index')
                ->with('success', __('Book created successfully'));
        }

        return redirect()
            ->route('admin.books.index')
            ->with('error', __('Fail on create book'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $book = Book::with([
            'author',
            'category',
        ])->findOrFail($id);

        return view('admin.books.show', [
            'record' => $book,
            'request' => $request,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        return view('admin.books.form', [
            'record' => $book,
            'request' => $request,
            'authors' => Author::keyValue(),
            'categories' => Category::keyValue(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = [
            'title' => $request->validated('title'),
            'quantity' => $request->validated('quantity'),
            'reference' => $request->validated('reference'),
            'sinopsis' => $request->validated('sinopsis'),
            'author_id' => $request->validated('author_id'),
            'category_id' => $request->validated('category_id'),
        ];

        $updated = $book->update($validated);

        if ($updated) {
            return redirect()
                ->route('admin.books.index')
                ->with('success', __('Book updated successfully'));
        }

        return redirect()
            ->route('admin.books.index')
            ->with('error', __('Fail on update book'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $book = Book::find($id);
        $deleted = $book?->delete();

        if ($deleted) {
            return redirect()
                ->route('admin.books.index')
                ->with('success', __('Book deleted successfully'));
        }

        return redirect()
            ->route('admin.books.index');
    }
}
