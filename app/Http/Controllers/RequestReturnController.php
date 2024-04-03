<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Models\RequestReturn;

class RequestReturnController extends Controller
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
            'borrow_id' => 'integer|exists:App\Models\Borrow,id',
        ]);

        /**
         * @var Borrow $borrow
         */
        $borrow = Borrow::whereNull('returned_at')->findOrFail($request?->integer('borrow_id'));

        /**
         * @var RequestReturn|bool $requestReturn
         */
        $requestReturn = $borrow->requestReturnThis();

        /**
         * Maybe on success, redirect to request_borrow.index??!!
         */
        return $requestReturn
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
