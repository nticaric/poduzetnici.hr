<?php

namespace Tests\Feature;

use App\Enums\CompanyRole;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_companies_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('companies.index'));

        $response->assertStatus(200);
        $response->assertViewIs('companies.index');
    }

    public function test_user_can_view_create_company_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('companies.create'));

        $response->assertStatus(200);
        $response->assertViewIs('companies.create');
    }

    public function test_user_can_create_company(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('companies.store'), [
            'name' => 'Test Tvrtka d.o.o.',
            'type' => 'company',
            'oib' => '12345678901',
        ]);

        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Tvrtka d.o.o.',
            'type' => 'company',
            'oib' => '12345678901',
        ]);

        $company = Company::where('oib', '12345678901')->first();

        $this->assertDatabaseHas('company_user', [
            'company_id' => $company->id,
            'user_id' => $user->id,
            'role' => 'owner',
        ]);

        $this->assertEquals($company->id, $user->fresh()->current_company_id);
    }

    public function test_oib_must_be_unique(): void
    {
        $user = User::factory()->create();
        Company::factory()->create(['oib' => '12345678901']);

        $response = $this->actingAs($user)->post(route('companies.store'), [
            'name' => 'Test Tvrtka d.o.o.',
            'type' => 'company',
            'oib' => '12345678901',
        ]);

        $response->assertSessionHasErrors('oib');
    }

    public function test_oib_must_be_11_characters(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('companies.store'), [
            'name' => 'Test Tvrtka d.o.o.',
            'type' => 'company',
            'oib' => '123456',
        ]);

        $response->assertSessionHasErrors('oib');
    }

    public function test_owner_can_edit_company(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($user, CompanyRole::Owner);

        $response = $this->actingAs($user)->get(route('companies.edit', $company));

        $response->assertStatus(200);
        $response->assertViewIs('companies.edit');
    }

    public function test_admin_can_edit_company(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($user, CompanyRole::Admin);

        $response = $this->actingAs($user)->get(route('companies.edit', $company));

        $response->assertStatus(200);
    }

    public function test_member_cannot_edit_company(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($user, CompanyRole::Member);

        $response = $this->actingAs($user)->get(route('companies.edit', $company));

        $response->assertStatus(403);
    }

    public function test_owner_can_update_company(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create(['name' => 'Old Name']);
        $company->addUser($user, CompanyRole::Owner);

        $response = $this->actingAs($user)->put(route('companies.update', $company), [
            'name' => 'New Name',
            'type' => 'company',
            'oib' => $company->oib,
        ]);

        $response->assertRedirect(route('companies.edit', $company));
        $this->assertEquals('New Name', $company->fresh()->name);
    }

    public function test_only_owner_can_delete_company(): void
    {
        $owner = User::factory()->create();
        $admin = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);
        $company->addUser($admin, CompanyRole::Admin);

        $response = $this->actingAs($admin)->delete(route('companies.destroy', $company));
        $response->assertStatus(403);

        $response = $this->actingAs($owner)->delete(route('companies.destroy', $company));
        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }

    public function test_user_can_switch_companies(): void
    {
        $user = User::factory()->create();
        $company1 = Company::factory()->create();
        $company2 = Company::factory()->create();
        $company1->addUser($user, CompanyRole::Owner);
        $company2->addUser($user, CompanyRole::Member);

        $user->setCurrentCompany($company1);

        $response = $this->actingAs($user)->post(route('companies.switch', $company2));

        $response->assertRedirect();
        $this->assertEquals($company2->id, $user->fresh()->current_company_id);
    }

    public function test_user_cannot_switch_to_company_they_dont_belong_to(): void
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $response = $this->actingAs($user)->post(route('companies.switch', $company));

        $response->assertStatus(403);
    }

    public function test_owner_can_add_member(): void
    {
        $owner = User::factory()->create();
        $newMember = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);

        $response = $this->actingAs($owner)->post(route('companies.members.store', $company), [
            'email' => $newMember->email,
            'role' => 'member',
        ]);

        $response->assertRedirect(route('companies.members', $company));
        $this->assertTrue($company->hasUser($newMember));
    }

    public function test_member_cannot_add_other_members(): void
    {
        $member = User::factory()->create();
        $newMember = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($member, CompanyRole::Member);

        $response = $this->actingAs($member)->post(route('companies.members.store', $company), [
            'email' => $newMember->email,
            'role' => 'member',
        ]);

        $response->assertStatus(403);
    }

    public function test_owner_can_remove_member(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);
        $company->addUser($member, CompanyRole::Member);

        $response = $this->actingAs($owner)->delete(route('companies.members.destroy', [$company, $member]));

        $response->assertRedirect(route('companies.members', $company));
        $this->assertFalse($company->hasUser($member));
    }

    public function test_owner_cannot_be_removed(): void
    {
        $owner = User::factory()->create();
        $admin = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);
        $company->addUser($admin, CompanyRole::Admin);

        $response = $this->actingAs($admin)->delete(route('companies.members.destroy', [$company, $owner]));

        $response->assertSessionHasErrors();
        $this->assertTrue($company->hasUser($owner));
    }

    public function test_owner_can_transfer_ownership(): void
    {
        $owner = User::factory()->create();
        $newOwner = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);
        $company->addUser($newOwner, CompanyRole::Admin);

        $response = $this->actingAs($owner)->post(route('companies.transfer-ownership', $company), [
            'user_id' => $newOwner->id,
        ]);

        $response->assertRedirect(route('companies.members', $company));

        $this->assertEquals(CompanyRole::Owner, $company->userRole($newOwner));
        $this->assertEquals(CompanyRole::Admin, $company->userRole($owner));
    }

    public function test_non_member_can_leave_company(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);
        $company->addUser($member, CompanyRole::Member);

        $response = $this->actingAs($member)->post(route('companies.leave', $company));

        $response->assertRedirect(route('companies.index'));
        $this->assertFalse($company->hasUser($member));
    }

    public function test_owner_cannot_leave_company(): void
    {
        $owner = User::factory()->create();
        $company = Company::factory()->create();
        $company->addUser($owner, CompanyRole::Owner);

        $response = $this->actingAs($owner)->post(route('companies.leave', $company));

        $response->assertSessionHasErrors();
        $this->assertTrue($company->hasUser($owner));
    }
}
