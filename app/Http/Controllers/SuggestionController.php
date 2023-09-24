<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestionRequest;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class SuggestionController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('suggestion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SuggestionRequest $request)
    {
        $validated = $request->safe();

        $Suggestion = new Suggestion();
        $Suggestion->name = $validated['name'];
        $Suggestion->short_description = $validated['short_description'];
        $Suggestion->long_description = $validated['long_description'];
        $Suggestion->user_id = Auth::user()->id;
        $Suggestion->status = 1;
        $Suggestion->save();

        return redirect('/')->with('success', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        //
    }
}
