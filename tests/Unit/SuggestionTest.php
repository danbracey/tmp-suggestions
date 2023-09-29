<?php

namespace Tests\Unit;

use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
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

    public function test_edit_and_delete_buttons_show_for_user_who_created_suggestion(): void {
        $user = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $user->id
        ]);
        $homePage = $this->actingAs($user)->get(route('suggestion.show', $suggestion));
        $homePage->assertSeeText("Edit");
        $homePage->assertSeeText("Delete");
        $homePage->assertStatus(200);
    }

    public function test_edit_and_delete_buttons_dont_show_for_other_users_and_non_admins(): void {
        $user = \App\Models\User::factory()->create();
        $userTwo = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $user->id
        ]);
        $suggestionTwo = Suggestion::factory()->create([
            'user_id' => $userTwo->id
        ]);
        $homePage = $this->actingAs($user)->get(route('suggestion.show', $suggestionTwo));
        $homePage->assertDontSeeText("Edit");
        $homePage->assertDontSeeText("Delete");
        $homePage->assertStatus(200);
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

    public function test_suggestion_cannot_be_deleted_by_another_user(): void {
        $userOne = \App\Models\User::factory()->create();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $userOne->id
        ]);
        $userTwo = \App\Models\User::factory()->create();
        $page = $this->actingAs($userTwo)->delete(route('suggestion.destroy', $suggestionForUserOne));
        $page->assertForbidden();
    }

    public function test_suggestion_cannot_be_approved_by_self_or_another_user(): void {
        $userOne = \App\Models\User::factory()->create();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $userOne->id
        ]);
        $page = $this->actingAs($userOne)->get(route('suggestion.approve', $suggestionForUserOne));
        $page->assertForbidden();
        $userTwo = \App\Models\User::factory()->create();
        $page = $this->actingAs($userTwo)->get(route('suggestion.approve', $suggestionForUserOne));
        $page->assertForbidden();
    }

    public function test_suggestion_cannot_be_denied_by_self_or_another_user(): void {
        $userOne = \App\Models\User::factory()->create();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $userOne->id
        ]);
        $page = $this->actingAs($userOne)->get(route('suggestion.deny', $suggestionForUserOne));
        $page->assertForbidden();
        $userTwo = \App\Models\User::factory()->create();
        $page = $this->actingAs($userTwo)->get(route('suggestion.deny', $suggestionForUserOne));
        $page->assertForbidden();
    }

    public function test_suggestion_can_be_approved_by_admin(): void {
        $admin = User::where('name', 'Admin User')->first();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $admin->id
        ]);
        $page = $this->actingAs($admin)->get(route('suggestion.approve', $suggestionForUserOne));
        $page->assertRedirect();
    }

    public function test_suggestion_can_be_denied_by_admin(): void {
        $admin = User::where('name', 'Admin User')->first();
        $suggestionForUserOne = Suggestion::factory()->createOne([
            'user_id' => $admin->id
        ]);
        $page = $this->actingAs($admin)->get(route('suggestion.deny', $suggestionForUserOne));
        $page->assertRedirect();
    }

    public function test_suggestion_management_buttons_dont_show_for_non_admins(): void {
        $user = \App\Models\User::factory()->create();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $user->id
        ]);
        $homePage = $this->actingAs($user)->get(route('suggestion.show', $suggestion));
        $homePage->assertDontSeeText("Approve");
        $homePage->assertDontSeeText("Deny");
        $homePage->assertStatus(200);
    }

    public function test_suggestion_management_buttons_show_for_admins(): void {
        $user = \App\Models\User::where('name', 'Admin User')->firstOrFail();
        $suggestion = Suggestion::factory()->create([
            'user_id' => $user->id
        ]);
        $homePage = $this->actingAs($user)->get(route('suggestion.show', $suggestion));
        $homePage->assertSeeText("Approve");
        $homePage->assertSeeText("Deny");
        $homePage->assertStatus(200);
    }
}
