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
        return view('suggestion.show', [
            'Suggestion' => $suggestion
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {
        $this->authorize('update', $suggestion);

        return view('suggestion.edit', [
            'Suggestion' => $suggestion
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SuggestionRequest $request, Suggestion $suggestion)
    {
        $this->authorize('update', $suggestion);
        $validated = $request->safe();

        $suggestion->name = $validated['name'];
        $suggestion->short_description = $validated['short_description'];
        $suggestion->long_description = $validated['long_description'];
        $suggestion->update();

        return redirect(route('suggestion.show', $suggestion));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        $this->authorize('delete', $suggestion);
        $suggestion->delete();
        return redirect(route('home'))->with('success', 'Suggestion Deleted');
    }

    public function approve(Suggestion $suggestion) {
        $this->authorize('manage', $suggestion);
        $suggestion->status = 2;
        $suggestion->save();
        return redirect(route('suggestion.show', $suggestion))->with('success', 'Suggestion Approved');
    }

    public function deny(Suggestion $suggestion) {
        $this->authorize('manage', $suggestion);
        $suggestion->status = 3;
        $suggestion->save();
        return redirect(route('suggestion.show', $suggestion))->with('information', 'Suggestion Denied');
    }

    public function reopen(Suggestion $suggestion) {
        $this->authorize('manage', $suggestion);
        $suggestion->status = 1;
        $suggestion->save();
        return redirect(route('suggestion.show', $suggestion))->with('info', 'Suggestion Re-opened');
    }
}
