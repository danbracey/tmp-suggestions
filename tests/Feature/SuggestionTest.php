<?php

namespace Tests\Feature;

use App\Models\Suggestion;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SuggestionTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_suggestion_can_be_created_with_valid_data(): void {
        $user = \App\Models\User::factory()->create();
        $page = $this->actingAs($user)->get(route('suggestion.create'));
        $page->assertSeeText("Create new Suggestion");
        //Testing form loads correctly
        $page->assertSeeText("Suggestion Name");
        $page->assertSeeText("Short Description");
        $page->assertSeeText("Long Description");
        //Fill in form and test submission
        $form = $this->post(route('suggestion.store'), [
            'name' => 'Test Suggestion',
            'short_description' => 'Short Description of the Suggestion',
            'long_description' => 'Long Description of the Suggestion'
        ]);
        $form->assertFound();
    }

    public function test_suggestion_cannot_be_created_with_invalid_data(): void {
        $user = \App\Models\User::factory()->create();
        $page = $this->actingAs($user)->get(route('suggestion.create'));
        $form = $this->post(route('suggestion.store'), [
            'name' => null,
            'short_description' => null,
            'long_description' => null
        ]);
        $form->assertSessionHasErrors([
            'name', 'short_description', 'long_description'
        ]);
    }

    public function test_suggestion_can_be_edited(): void {
        $user = \App\Models\User::factory()->create();
        $getRandomSuggestion = Suggestion::inRandomOrder()->first();
        $page = $this->actingAs($user)->get(route('suggestion.edit', $getRandomSuggestion));
        //Assert that the current values are showing in the edit form
        $page->assertSeeText($getRandomSuggestion->short_description);
        $page->assertSeeText($getRandomSuggestion->long_description);
        $form = $this->put(route('suggestion.update', $getRandomSuggestion), [
            'name' => "New Name",
            'short_description' => "New Short Description",
            'long_description' => "New Long Description"
        ]);
        $this->assertDatabaseHas('suggestions', [
            'id' => $getRandomSuggestion->id,
            'name' => "New Name",
            'short_description' => 'New Short Description',
            'long_description' => 'New Long Description'
        ]);
    }

    public function test_suggestion_cannot_be_edited_by_another_user(): void {
        //Create our first user and create a random suggestion in their name
        $userOne = \App\Models\User::factory()->create();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $userOne->id
        ]);
        $userTwo = \App\Models\User::factory()->create();
        $page = $this->actingAs($userTwo)->get(route('suggestion.edit', $suggestionForUserOne));
        $page->assertForbidden();
    }
}
