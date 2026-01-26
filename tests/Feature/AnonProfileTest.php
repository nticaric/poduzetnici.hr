<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnonProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_update_profile_contact_info(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->patch('/profile', [
            'firstname' => 'Test',
            'lastname' => 'User',
            'email' => $user->email,
            'phone' => '123456789',
            'preferred_contact_method' => 'phone',
        ]);

        $response->assertSessionHasNoErrors()->assertRedirect('/profile');

        $user->refresh();
        $this->assertEquals('123456789', $user->phone);
        $this->assertEquals('phone', $user->preferred_contact_method);
    }

    public function test_authenticated_user_can_create_anonymous_ad(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/ads', [
            'title' => 'Anon Ad',
            'description' => 'Test Description',
            'type' => 'offer',
            'category' => 'Usluge',
            'price' => 100,
            'duration_days' => 30,
            'is_anonymous' => true,
        ]);

        $response->assertRedirect('/ads');
        $this->assertDatabaseHas('ads', [
            'title' => 'Anon Ad',
            'is_anonymous' => true,
        ]);
    }

    public function test_anonymous_ad_hides_user_info_on_show_page(): void
    {
        $user = User::factory()->create();
        $ad = Ad::create([
            'user_id' => $user->id,
            'title' => 'Anon Ad Show',
            'slug' => 'anon-ad-show-'.uniqid(),
            'description' => 'Desc',
            'type' => 'offer',
            'category' => 'Usluge',
            'duration_days' => 30,
            'expires_at' => now()->addDays(30),
            'is_anonymous' => true,
        ]);

        $response = $this->get('/ads/'.$ad->id);
        $response->assertStatus(200);
        $response->assertSee('Anonimni oglašivač');
        $response->assertDontSee($user->firstname);
        $response->assertDontSee($user->lastname);
    }
}
