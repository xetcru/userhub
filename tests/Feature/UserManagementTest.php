<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_index_requires_authentication()
    {
        $response = $this->get('/users');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_see_users_list()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get('/users')
             ->assertStatus(200)
             ->assertSee('Users');
    }

    public function test_user_can_be_created()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/users', [
                 'name' => 'New User',
                 'email' => 'new@example.com',
                 'password' => 'password123',
                 'ip' => '192.168.1.1',
                 'comment' => 'Test comment',
             ])
             ->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'email' => 'new@example.com',
        ]);
    }

    public function test_user_can_be_updated()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $this->actingAs($user)
             ->put("/users/{$targetUser->id}", [
                 'name' => 'Updated Name',
                 'email' => $targetUser->email,
             ])
             ->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'id' => $targetUser->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();
        $targetUser = User::factory()->create();

        $this->actingAs($user)
             ->delete("/users/{$targetUser->id}")
             ->assertRedirect('/users');

        $this->assertDatabaseMissing('users', [
            'id' => $targetUser->id,
        ]);
    }
}
