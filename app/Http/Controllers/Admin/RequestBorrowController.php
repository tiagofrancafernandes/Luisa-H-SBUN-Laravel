<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequestBorrowStatus;
use App\Http\Controllers\Controller;
use App\Models\RequestBorrow;
use Illuminate\Http\Request;

class RequestBorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->integer('status', 1);
        $status = RequestBorrowStatus::tryFrom($status) ?? RequestBorrowStatus::PENDING;

        return view(
            'admin.request_borrow.index',
            [
                'records' => RequestBorrow::whereStatus($status)
                    ->with([
                        'user' => fn ($query) => $query->select('id', 'name'),
                        'book' => fn ($query) => $query->select('id', 'title', 'quantity'),
                    ])
                    ->orderBy('id', 'asc')->paginate(20),
            ]
        );
    }

    /**
     * Show the specified resource in storage.
     */
    public function show(Request $request, string $id)
    {
        return '[WIP] ' . __METHOD__;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|integer|in:' . collect(RequestBorrowStatus::cases())->pluck('value')->implode(','),
        ]);

        $requestBorrow = RequestBorrow::where('status', RequestBorrowStatus::PENDING)->where('id', $id)->first();

        if (!$requestBorrow) {
            return redirect()->route('admin.request_borrow.index');
        }

        $status = RequestBorrowStatus::tryFrom($request->input('status'));

        $updated = $requestBorrow?->update([
            'status' => $status,
        ]);

        $requestBorrow = $requestBorrow?->fresh();

        $borrow = null;

        if ($updated && $requestBorrow?->status === RequestBorrowStatus::APPROVED) {
            $borrow = $requestBorrow?->book->borrowThis($requestBorrow?->user);
        }

        return $updated && $borrow
            ? redirect()->route('admin.request_borrow.index')->with('success', __('Request updated successfully!'))
            : redirect()->route('admin.request_borrow.index')->with('error', __('Fail on update the request!'));
    }
}
