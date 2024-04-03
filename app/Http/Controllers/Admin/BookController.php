<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.books.index', [
            'records' => Book::orderBy('id', 'asc')
                ->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        return '[WIP] ' . __METHOD__;
    }
}
