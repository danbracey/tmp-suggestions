<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     */
    public function test_creating_admin_user(): void
    {
        $user = \App\Models\User::factory()->create();
        $user->assignRole('admin');
        $this->assertTrue($user->hasRole('admin'));
        $user->delete();
    }

    public function test_creating_normal_user(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->assertFalse($user->hasRole('admin'));
        $user->delete();
    }
}
