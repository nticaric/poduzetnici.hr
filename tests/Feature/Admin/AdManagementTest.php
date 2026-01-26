<?php

namespace Tests\Feature\Admin;

use App\Enums\AdStatus;
use App\Enums\UserRole;
use App\Models\Ad;
use App\Models\User;
use App\Notifications\AdStatusChangedNotification;
use App\Notifications\NewAdSubmittedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AdManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_cannot_access_admin_ads(): void
    {
        $user = User::factory()->create(['role' => UserRole::User]);

        $response = $this->actingAs($user)->get('/admin/ads');

        $response->assertStatus(403);
    }

    public function test_admin_can_view_ads_list(): void
    {
        $admin = User::factory()->admin()->create();
        Ad::factory()->count(5)->create();

        $response = $this->actingAs($admin)->get('/admin/ads');

        $response->assertStatus(200);
    }

    public function test_admin_can_view_ad_details(): void
    {
        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/ads/{$ad->id}");

        $response->assertStatus(200);
        $response->assertSee($ad->title);
    }

    public function test_admin_can_approve_ad(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->pending()->create();

        $response = $this->actingAs($admin)->post("/admin/ads/{$ad->id}/approve");

        $response->assertRedirect();
        $this->assertDatabaseHas('ads', [
            'id' => $ad->id,
            'status' => AdStatus::Approved->value,
            'reviewed_by' => $admin->id,
        ]);

        Notification::assertSentTo($ad->user, AdStatusChangedNotification::class);
    }

    public function test_admin_can_reject_ad(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->pending()->create();

        $response = $this->actingAs($admin)->post("/admin/ads/{$ad->id}/reject", [
            'rejection_reason' => 'Sadržaj nije prikladan.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('ads', [
            'id' => $ad->id,
            'status' => AdStatus::Rejected->value,
            'rejection_reason' => 'Sadržaj nije prikladan.',
            'reviewed_by' => $admin->id,
        ]);

        Notification::assertSentTo($ad->user, AdStatusChangedNotification::class);
    }

    public function test_admin_can_delete_ad(): void
    {
        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/ads/{$ad->id}");

        $response->assertRedirect('/admin/ads');
        $this->assertDatabaseMissing('ads', ['id' => $ad->id]);
    }

    public function test_admin_can_filter_ads_by_status(): void
    {
        $admin = User::factory()->admin()->create();
        Ad::factory()->count(3)->pending()->create();
        Ad::factory()->count(2)->approved()->create();

        $response = $this->actingAs($admin)->get('/admin/ads?status=pending');

        $response->assertStatus(200);
    }

    public function test_new_ad_notifies_admins(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/ads', [
            'title' => 'Test Oglas',
            'description' => 'Ovo je test opis oglasa.',
            'type' => 'offer',
            'category' => 'Partnerstva',
            'location' => 'Zagreb',
            'duration_days' => 30,
        ]);

        $response->assertRedirect();
        Notification::assertSentTo($admin, NewAdSubmittedNotification::class);
    }

    public function test_new_ad_is_pending_by_default(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->post('/ads', [
            'title' => 'Test Oglas',
            'description' => 'Ovo je test opis oglasa.',
            'type' => 'offer',
            'category' => 'Partnerstva',
            'location' => 'Zagreb',
            'duration_days' => 30,
        ]);

        $this->assertDatabaseHas('ads', [
            'title' => 'Test Oglas',
            'status' => AdStatus::Pending->value,
        ]);
    }

    public function test_only_approved_ads_shown_in_public_list(): void
    {
        $approvedAd = Ad::factory()->approved()->create(['title' => 'Approved Ad']);
        $pendingAd = Ad::factory()->pending()->create(['title' => 'Pending Ad']);

        $response = $this->get('/ads');

        $response->assertSee('Approved Ad');
        $response->assertDontSee('Pending Ad');
    }

    public function test_pending_ad_not_visible_to_public(): void
    {
        $ad = Ad::factory()->pending()->create();

        $response = $this->get("/ads/{$ad->id}");

        $response->assertStatus(404);
    }

    public function test_pending_ad_visible_to_owner(): void
    {
        $ad = Ad::factory()->pending()->create();

        $response = $this->actingAs($ad->user)->get("/ads/{$ad->id}");

        $response->assertStatus(200);
    }

    public function test_pending_ad_visible_to_admin(): void
    {
        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->pending()->create();

        $response = $this->actingAs($admin)->get("/ads/{$ad->id}");

        $response->assertStatus(200);
    }

    public function test_rejected_ad_resubmitted_for_review_after_edit(): void
    {
        Notification::fake();

        $admin = User::factory()->admin()->create();
        $ad = Ad::factory()->rejected()->create();

        $response = $this->actingAs($ad->user)->patch("/ads/{$ad->id}", [
            'title' => 'Updated Title',
            'description' => $ad->description,
            'type' => $ad->type,
            'category' => $ad->category,
            'price' => $ad->price,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('ads', [
            'id' => $ad->id,
            'status' => AdStatus::Pending->value,
        ]);
    }
}
