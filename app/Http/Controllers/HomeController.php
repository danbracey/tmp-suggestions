<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        if(Auth::check()) {
            return view('index', [
                'MySuggestions' => Suggestion::where('user_id', Auth::user()->id)->get(),
                'Suggestions' => Suggestion::all()
            ]);
        }

        return view('index', [
            'MySuggestions' => null,
            'Suggestions' => Suggestion::all()
        ]);
    }
}
