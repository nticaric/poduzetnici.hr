<?php

namespace App\Http\Controllers;

use App\Enums\CompanyRole;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(Request $request): View
    {
        $companies = $request->user()->companies()->with('users')->get();

        return view('companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(StoreCompanyRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $company = Company::create($validated);

        $company->addUser($request->user(), CompanyRole::Owner);

        $request->user()->setCurrentCompany($company);

        return redirect()->route('companies.index')
            ->with('status', 'Tvrtka je uspješno kreirana.');
    }

    public function show(Company $company): View
    {
        $this->authorizeCompanyAccess($company);

        $company->load('users', 'ads');

        return view('companies.show', compact('company'));
    }

    public function edit(Company $company): View
    {
        $this->authorizeCompanyManagement($company);

        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company): RedirectResponse
    {
        $validated = $request->validated();

        $company->update($validated);

        return redirect()->route('companies.edit', $company)
            ->with('status', 'Tvrtka je uspješno ažurirana.');
    }

    public function destroy(Company $company): RedirectResponse
    {
        $this->authorizeCompanyDeletion($company);

        $user = auth()->user();

        if ($user->current_company_id === $company->id) {
            $user->setCurrentCompany(null);
        }

        $company->delete();

        return redirect()->route('companies.index')
            ->with('status', 'Tvrtka je uspješno obrisana.');
    }

    public function switchTo(Company $company): RedirectResponse
    {
        $this->authorizeCompanyAccess($company);

        auth()->user()->setCurrentCompany($company);

        return redirect()->back()
            ->with('status', 'Prebačeno na tvrtku: '.$company->name);
    }

    public function members(Company $company): View
    {
        $this->authorizeCompanyAccess($company);

        $company->load('users');
        $userRole = $company->userRole(auth()->user());
        $canManageMembers = $userRole && $userRole->canManageMembers();

        return view('companies.members', compact('company', 'canManageMembers'));
    }

    public function checkSlug(Request $request): \Illuminate\Http\JsonResponse
    {
        $slug = $request->input('slug');
        $companyId = $request->input('company_id');

        $query = Company::where('slug', $slug);

        if ($companyId) {
            $query->where('id', '!=', $companyId);
        }

        $exists = $query->exists();

        return response()->json(['available' => ! $exists]);
    }

    public function generateSlug(Request $request): \Illuminate\Http\JsonResponse
    {
        $companyId = $request->input('company_id');
        $company = Company::findOrFail($companyId);

        $this->authorizeCompanyManagement($company);

        $baseSlug = Str::slug($company->name);
        $slug = $baseSlug;
        $counter = 1;

        while (Company::where('slug', $slug)->where('id', '!=', $company->id)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return response()->json(['slug' => $slug]);
    }

    public function togglePublic(Request $request): \Illuminate\Http\JsonResponse
    {
        $companyId = $request->input('company_id');
        $company = Company::findOrFail($companyId);

        $this->authorizeCompanyManagement($company);

        $company->update(['is_public' => ! $company->is_public]);

        return response()->json([
            'is_public' => $company->is_public,
            'message' => $company->is_public
                ? 'Tvrtka je sada javno vidljiva.'
                : 'Tvrtka više nije javno vidljiva.',
        ]);
    }

    private function authorizeCompanyAccess(Company $company): void
    {
        if (! $company->hasUser(auth()->user())) {
            abort(403, 'Nemate pristup ovoj tvrtki.');
        }
    }

    private function authorizeCompanyManagement(Company $company): void
    {
        if (! $company->userCanManage(auth()->user())) {
            abort(403, 'Nemate ovlasti za upravljanje ovom tvrtkom.');
        }
    }

    private function authorizeCompanyDeletion(Company $company): void
    {
        if (! $company->userCanDelete(auth()->user())) {
            abort(403, 'Samo vlasnik može obrisati tvrtku.');
        }
    }
}
