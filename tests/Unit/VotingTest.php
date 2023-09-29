<?php

namespace Tests\Unit;

use App\Models\Suggestion;
use App\Models\SuggestionVote;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VotingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_voting_buttons_dont_appear_to_guests(): void
    {
        $response = $this->get('/');
        $response->assertDontSeeText('&uarr;', false);
        $response->assertDontSeeText('&darr;', false);
    }

    public function test_voting_buttons_dont_appear_on_own_suggestions(): void
    {
        $user = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $user->id
        ]);
        $response = $this->get('/');
        $response->assertDontSeeText('&uarr;', false);
        $response->assertDontSeeText('&darr;', false);
    }

    public function test_voting_buttons_appear_on_suggestions_by_other_users(): void
    {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $userTwo->id,
            'status' => 1 //Force the suggestion into pending, even though this is the default
        ]);
        $response = $this->actingAs($user)->get('/');
        $response->assertSeeText('&uarr;', false);
        $response->assertSeeText('&darr;', false);
    }

    public function test_voting_buttons_dont_appear_on_suggestions_user_has_already_voted_on(): void
    {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $userTwo->id,
            'status' => 1 //Force the suggestion into pending, even though this is the default
        ]);
        //Create a new vote record for this suggestion
        $vote = new SuggestionVote();
        $vote->suggestion_id = $suggestion->id;
        $vote->user_id = $user->id;
        $vote->vote = 1;
        $vote->save();
        $response = $this->actingAs($user)->get('/');
        $response->assertSeeText('Remove Vote', false);
    }

    public function test_user_cannot_double_vote_on_suggestions(): void
    {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $userTwo->id,
            'status' => 1 //Force the suggestion into pending, even though this is the default
        ]);
        $response = $this->actingAs($user)->get(route('suggestion.vote.down', $suggestion));
        $response->assertStatus(302);
        $doubleVoteDown = $this->actingAs($user)->get(route('suggestion.vote.down', $suggestion));
        $doubleVoteDown->assertForbidden();
        $doubleVoteUp = $this->actingAs($user)->get(route('suggestion.vote.up', $suggestion));
        $doubleVoteUp->assertForbidden();
    }
}
