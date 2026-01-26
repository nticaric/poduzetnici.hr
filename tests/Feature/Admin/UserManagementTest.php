<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_users_list(): void
    {
        $admin = User::factory()->admin()->create();
        User::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_user_details(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertSee($user->email);
    }

    public function test_admin_can_edit_user(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/users/{$user->id}/edit");

        $response->assertStatus(200);
    }

    public function test_admin_can_update_user(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->patch("/admin/users/{$user->id}", [
            'firstname' => 'Updated',
            'lastname' => 'Name',
            'email' => $user->email,
            'role' => UserRole::User->value,
            'account_type' => 'person',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'firstname' => 'Updated',
            'lastname' => 'Name',
        ]);
    }

    public function test_admin_can_change_user_role(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create(['role' => UserRole::User]);

        $response = $this->actingAs($admin)->patch("/admin/users/{$user->id}", [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'role' => UserRole::Admin->value,
            'account_type' => 'person',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => UserRole::Admin->value,
        ]);
    }

    public function test_admin_can_delete_user(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/users/{$user->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");

        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_admin_can_filter_users_by_role(): void
    {
        $admin = User::factory()->admin()->create();
        User::factory()->count(3)->create(['role' => UserRole::User]);
        User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/admin/users?role=admin');

        $response->assertStatus(200);
    }

    public function test_admin_can_search_users(): void
    {
        $admin = User::factory()->admin()->create();
        $user = User::factory()->create(['firstname' => 'UniqueTestName']);

        $response = $this->actingAs($admin)->get('/admin/users?search=UniqueTestName');

        $response->assertStatus(200);
        $response->assertSee('UniqueTestName');
    }
}
