<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SuggestionTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function test_index_page_loads_correctly_as_guest(): void {
        $homePage = $this->get("/");
        $homePage->assertSeeText("Top Suggestions");
        $homePage->assertDontSeeText("My Suggestions");
        $homePage->assertStatus(200);
    }

    public function test_index_page_loads_correctly_as_authenticated_user(): void {
        $user = \App\Models\User::factory()->create();
        $homePage = $this->actingAs($user)->get('/');
        $homePage->assertSeeText("Top Suggestions");
        $homePage->assertSeeText("My Suggestions");
        $homePage->assertStatus(200);
    }
}
