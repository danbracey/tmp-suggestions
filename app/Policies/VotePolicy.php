<?php

namespace App\Policies;

use App\Models\Suggestion;
use App\Models\SuggestionVote;
use App\Models\User;

class VotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function vote(User $user, Suggestion $suggestion): bool
    {
        //Prevent voting on their own suggestion
        if($suggestion->user_id === $user->id) {
            return false;
        }
        //Prevent duplicate votes
        if(SuggestionVote::where('suggestion_id', $suggestion->id)->where('user_id', $user->id)->first()) {
            return false;
        }

        return true;
    }
}
