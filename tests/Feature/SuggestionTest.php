<?php

namespace Tests\Feature;

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
}
