<?php

namespace App\Http\Controllers;

use App\Enums\CompanyRole;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyMemberController extends Controller
{
    public function store(Request $request, Company $company): RedirectResponse
    {
        $this->authorizeManageMembers($company);

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'role' => ['required', 'in:admin,member'],
        ], [
            'email.required' => 'Email adresa je obavezna.',
            'email.email' => 'Unesite ispravnu email adresu.',
            'email.exists' => 'Korisnik s ovom email adresom ne postoji.',
            'role.required' => 'Uloga je obavezna.',
            'role.in' => 'Uloga mora biti administrator ili član.',
        ]);

        $user = User::where('email', $validated['email'])->firstOrFail();

        if ($company->hasUser($user)) {
            return redirect()->back()
                ->withErrors(['email' => 'Ovaj korisnik je već član tvrtke.']);
        }

        $role = CompanyRole::from($validated['role']);
        $company->addUser($user, $role);

        return redirect()->route('companies.members', $company)
            ->with('status', 'Korisnik je uspješno dodan u tvrtku.');
    }

    public function update(Request $request, Company $company, User $user): RedirectResponse
    {
        $this->authorizeManageMembers($company);

        if (! $company->hasUser($user)) {
            abort(404);
        }

        $currentRole = $company->userRole($user);

        if ($currentRole === CompanyRole::Owner) {
            return redirect()->back()
                ->withErrors(['role' => 'Ne možete promijeniti ulogu vlasnika.']);
        }

        $validated = $request->validate([
            'role' => ['required', 'in:admin,member'],
        ], [
            'role.required' => 'Uloga je obavezna.',
            'role.in' => 'Uloga mora biti administrator ili član.',
        ]);

        $newRole = CompanyRole::from($validated['role']);
        $company->updateUserRole($user, $newRole);

        return redirect()->route('companies.members', $company)
            ->with('status', 'Uloga korisnika je uspješno ažurirana.');
    }

    public function destroy(Company $company, User $user): RedirectResponse
    {
        $this->authorizeManageMembers($company);

        if (! $company->hasUser($user)) {
            abort(404);
        }

        $currentRole = $company->userRole($user);

        if ($currentRole === CompanyRole::Owner) {
            return redirect()->back()
                ->withErrors(['user' => 'Ne možete ukloniti vlasnika iz tvrtke.']);
        }

        if ($user->current_company_id === $company->id) {
            $user->setCurrentCompany(null);
        }

        $company->removeUser($user);

        return redirect()->route('companies.members', $company)
            ->with('status', 'Korisnik je uspješno uklonjen iz tvrtke.');
    }

    public function leave(Company $company): RedirectResponse
    {
        $user = auth()->user();

        if (! $company->hasUser($user)) {
            abort(404);
        }

        $currentRole = $company->userRole($user);

        if ($currentRole === CompanyRole::Owner) {
            return redirect()->back()
                ->withErrors(['user' => 'Vlasnik ne može napustiti tvrtku. Prvo prenesite vlasništvo.']);
        }

        if ($user->current_company_id === $company->id) {
            $user->setCurrentCompany(null);
        }

        $company->removeUser($user);

        return redirect()->route('companies.index')
            ->with('status', 'Uspješno ste napustili tvrtku.');
    }

    public function transferOwnership(Request $request, Company $company): RedirectResponse
    {
        $user = auth()->user();

        if (! $company->userCanDelete($user)) {
            abort(403, 'Samo vlasnik može prenijeti vlasništvo.');
        }

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $newOwner = User::findOrFail($validated['user_id']);

        if (! $company->hasUser($newOwner)) {
            return redirect()->back()
                ->withErrors(['user_id' => 'Korisnik mora biti član tvrtke.']);
        }

        $company->updateUserRole($user, CompanyRole::Admin);
        $company->updateUserRole($newOwner, CompanyRole::Owner);

        return redirect()->route('companies.members', $company)
            ->with('status', 'Vlasništvo je uspješno preneseno.');
    }

    private function authorizeManageMembers(Company $company): void
    {
        $role = $company->userRole(auth()->user());

        if (! $role || ! $role->canManageMembers()) {
            abort(403, 'Nemate ovlasti za upravljanje članovima.');
        }
    }
}
