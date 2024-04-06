<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Route;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        if ($request?->user()?->isAdmin() && Route::currentRouteName() !== 'admin.dashboard') {
            return redirect()->route('admin.dashboard');
        }

        if (!$request->user()?->isAdmin()) {
            return view('dashboard', static::getViewData($request->user()));
        }

        return view('admin.dashboard', static::getViewData($request->user()));
    }

    public static function getViewData(User $user): array
    {
        if ($user?->isAdmin()) {
            return static::getAdminViewData();
        }

        return [
            'myBorrowedBooks' => Borrow::latest('updated_at')
                ->whereNull('returned_at')
                ->with('requestReturns')
                ->withCount('requestReturns')
                // ->doesntHave('requestReturns')
                ->orderBy('id', 'desc')
                ->with('book')
                ->where('user_id', auth()->user()->id)
                ->paginate(5),
        ];
    }

    protected static function getAdminViewData(): array
    {
        return [
            'myBorrowedBooks' => Borrow::latest('updated_at')
                ->whereNull('returned_at')
                ->with('requestReturns')
                ->withCount('requestReturns')
                // ->doesntHave('requestReturns')
                ->orderBy('id', 'desc')
                ->with('book')
                ->where('user_id', auth()->user()->id)
                ->paginate(5),
        ];
    }
}
