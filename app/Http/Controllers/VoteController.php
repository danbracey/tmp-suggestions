<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use App\Models\SuggestionVote;
use App\Policies\VotePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:vote');
    }

    public function voteUp(Suggestion $suggestion): \Illuminate\Http\RedirectResponse {
        $this->authorize('vote', $suggestion);
        $this->vote($suggestion, 1);
        return redirect(route('home'))->with('success', 'You have successfully upvoted ' . $suggestion->name);
    }

    public function voteDown(Suggestion $suggestion): \Illuminate\Http\RedirectResponse {
        $this->authorize('vote', $suggestion);
        $this->vote($suggestion, -1);
        return redirect(route('home'))->with('success', 'You have successfully downvoted ' . $suggestion->name);
    }

    public function remove(Suggestion $suggestion): \Illuminate\Http\RedirectResponse
    {
        try {
            SuggestionVote::where('suggestion_id', $suggestion->id)->where('user_id', Auth::user()->id)
                ->firstOrFail()->delete();
            return redirect(route('home'))->with('success', 'Vote removed');
        } catch(\Exception) {
            return redirect(route('home'))
                ->with('danger', 'Unable to remove vote. Have you already removed your vote?');
        }
    }

    private function vote($suggestion, int $vote) {
        $Vote = new SuggestionVote();
        $Vote->suggestion_id = $suggestion->id;
        $Vote->user_id = Auth::user()->id;
        $Vote->vote += $vote;
        $Vote->save();
    }
}
