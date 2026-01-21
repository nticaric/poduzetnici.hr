<?php
namespace Tests\Feature;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_returns_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
    }

    public function test_sitemap_contains_static_pages(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertSee(url('/'));
        $response->assertSee(route('ads.index'));
        $response->assertSee(route('profiles.index'));
        $response->assertSee(route('tools.index'));
        $response->assertSee(route('faq'));
    }

    public function test_sitemap_contains_active_ads(): void
    {
        $user = User::factory()->create();
        $ad   = Ad::factory()->create([
            'user_id'    => $user->id,
            'expires_at' => now()->addDays(30),
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertSee(route('ads.show', $ad->id));
    }

    public function test_sitemap_contains_public_profiles(): void
    {
        $user = User::factory()->create([
            'is_public' => true,
            'slug'      => 'test-company',
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertSee(route('profile.show', $user->slug));
    }

    public function test_sitemap_excludes_private_profiles(): void
    {
        $user = User::factory()->create([
            'is_public' => false,
            'slug'      => 'private-company',
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertDontSee(route('profile.show', $user->slug));
    }
}
