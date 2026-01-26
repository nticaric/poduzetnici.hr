<?php

namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdTest extends TestCase
{
    use RefreshDatabase;

    public function test_ads_screen_can_be_rendered(): void
    {
        $response = $this->get('/ads');
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_access_create_ad_screen(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/ads/create');
        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_create_ad(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/ads', [
            'title' => 'Test Ad',
            'description' => 'Test Description',
            'type' => 'offer',
            'category' => 'IT & Razvoj',
            'price' => 100,
            'duration_days' => 30,
        ]);

        $response->assertRedirect('/ads');
        $this->assertDatabaseHas('ads', [
            'title' => 'Test Ad',
            'user_id' => $user->id,
            'duration_days' => 30,
        ]);

        $ad = Ad::where('title', 'Test Ad')->first();
        $this->assertNotNull($ad->slug);
        $this->assertNotNull($ad->expires_at);
    }
}
