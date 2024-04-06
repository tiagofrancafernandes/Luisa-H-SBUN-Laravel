<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Borrow;

class BorrowController extends Controller
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
        $orderBy = in_array($request->input('orderBy'), Borrow::query()?->getModel()->getFillable())
            ? $request->input('orderBy') : 'id';
        $sortDir = in_array($request->input('dir'), ['asc', 'desc', 'ASC', 'DESC']) ? $request->input('dir') : 'asc';

        $search = $request->input('search');

        $search = filled($search) && is_string($search) ? strtolower(trim($search)) : null;

        return view('borrows.index', [
            'records' => Borrow::latest('updated_at')
                ->whereNull('returned_at')
                ->with('requestReturns')
                ->withCount('requestReturns')
                // ->doesntHave('requestReturns')
                ->orderBy($orderBy, $sortDir)
                ->with(['book.author', 'book.category'])
                ->where('user_id', auth()->user()->id)
                ->when($search, function ($query, $s) {
                    return $query
                    ?->whereHas(
                        'book',
                        fn ($q) => $q
                        ->where(DB::raw('LOWER(title)'), 'like', "%{$s}%")
                        ->orWhere(DB::raw('LOWER(sinopsis)'), 'like', "%{$s}%")
                        ->orWhere(DB::raw('LOWER(id)'), 'like', "%{$s}%")
                        ->orWhere(DB::raw('LOWER(reference)'), 'like', "%{$s}%")
                    )
                    ?->orWhereHas(
                        'book.author',
                        fn ($q) => $q
                        ->where(DB::raw('LOWER(name)'), 'like', "%{$s}%")
                    )
                    ?->orWhereHas(
                        'book.category',
                        fn ($q) => $q
                        ->where(DB::raw('LOWER(name)'), 'like', "%{$s}%")
                    );
                })
                ->paginate(5),
        ]);
    }
}
