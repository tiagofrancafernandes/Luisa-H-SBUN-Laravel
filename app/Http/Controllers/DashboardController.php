<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        return view('dashboard', static::getViewData($request->user()));
    }

    public static function getViewData(User $user): array
    {
        return [
            'myBorrowedBooks' => Borrow::latest('updated_at')
                ->orderBy('id', 'desc')
                ->with('book')
                ->where('user_id', auth()->user()->id)
                ->limit(5)->get(),
        ];
    }
}
