<?php

namespace Tests\Feature;

use App\Models\Suggestion;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VotingTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_user_can_vote_up_on_suggestions(): void
    {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $userTwo->id,
            'status' => 1 //Force the suggestion into pending, even though this is the default
        ]);

        $response = $this->actingAs($user)->get(route('suggestion.vote.up', $suggestion));
        $response->assertStatus(302); //Redirected to Home
        $this->assertDatabaseHas('suggestion_votes', [
            'user_id' => $user->id,
            'suggestion_id' => $suggestion->id,
            'vote' => 1
        ]);
    }

    public function test_user_can_vote_down_on_suggestions(): void
    {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $userTwo->id,
            'status' => 1 //Force the suggestion into pending, even though this is the default
        ]);

        $response = $this->actingAs($user)->get(route('suggestion.vote.down', $suggestion));
        $response->assertStatus(302); //Redirected to Home
        $this->assertDatabaseHas('suggestion_votes', [
            'user_id' => $user->id,
            'suggestion_id' => $suggestion->id,
            'vote' => -1
        ]);
    }
}
