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

    public function voteUp(Suggestion $suggestion): void
    {
        $this->authorize('vote', [VotePolicy::class, Auth::user(), $suggestion]);
        $this->vote($suggestion, 1);
    }

    public function voteDown(Suggestion $suggestion): void
    {
        $this->authorize('vote', [VotePolicy::class, Auth::user(), $suggestion]);
        $this->vote($suggestion, -1);
    }

    private function vote($suggestion, int $vote) {
        $Vote = new SuggestionVote();
        $Vote->suggestion_id = $suggestion->id;
        $Vote->user_id = Auth::user()->id;
        $Vote->vote += $vote;
        $Vote->save();
    }
}
