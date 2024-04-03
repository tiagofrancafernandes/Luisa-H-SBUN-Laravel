<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RequestReturnStatus;
use App\Http\Controllers\Controller;
use App\Models\RequestReturn;
use Illuminate\Http\Request;

class RequestReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->integer('status', RequestReturnStatus::PENDING?->value);
        $status = RequestReturnStatus::tryFrom($status) ?? RequestReturnStatus::PENDING;

        return view(
            'admin.request_return.index',
            [
                'records' => RequestReturn::whereStatus($status)
                    ->with([
                        'borrow.user' => fn ($query) => $query->select('id', 'name'),
                        'borrow.book' => fn ($query) => $query->select('id', 'title', 'quantity'),
                    ])
                    ->with('borrow')
                    ->whereHas(
                        'borrow',
                        fn ($query) => $query?->when(
                            $status === RequestReturnStatus::PENDING,
                            fn ($query) => $query?->whereNull('returned_at'),
                        )
                    )
                    // ->whereHas(
                    //     'borrow',
                    //     fn($query) => $query?->whereNull('returned_at')
                    // )
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
            'status' => 'required|integer|in:' . collect(RequestReturnStatus::cases())->pluck('value')->implode(','),
        ]);

        $status = $request->integer('status');
        $status = RequestReturnStatus::tryFrom($status) ?? RequestReturnStatus::APPROVED;

        $requestReturn = RequestReturn::query()
            ->where('status', RequestReturnStatus::PENDING)
            ->with('borrow')
            ->whereHas(
                'borrow',
                fn ($query) => $query?->whereNull('returned_at')
            )
            ->where('id', $id)
            ->first();

        if (!$requestReturn) {
            return redirect()->route('admin.request_return.index');
        }

        $status = RequestReturnStatus::tryFrom($request->input('status'));

        $updated = $requestReturn->update([
            'status' => $status,
        ]);

        $requestReturn = $requestReturn?->fresh();

        $success = $status === RequestReturnStatus::APPROVED ? null : true;

        if ($updated && $requestReturn?->status === RequestReturnStatus::APPROVED) {
            $success = $requestReturn?->confirmReturnThis();
        }

        if ($updated && $success) {
            return redirect()->route('admin.request_return.index')->with('success', __('Request updated successfully!'));
        }

        return redirect()->route('admin.request_return.index')->with('error', __('Fail on update the request!'));
    }
}
