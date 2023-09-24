<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
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
        //Not needed, use main index
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
    public function store(Request $request)
    {
        //
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
