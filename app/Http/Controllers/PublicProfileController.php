<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicProfileController extends Controller
{
    /**
     * Display a listing of public companies.
     */
    public function index(Request $request): View
    {
        $query = Company::whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('is_public', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        // Filter by Industry
        if ($request->filled('industry')) {
            $query->where('industry', $request->input('industry'));
        }

        // Filter by Type (company/craft)
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filter by has website
        if ($request->filled('has_website')) {
            $query->whereNotNull('web')->where('web', '!=', '');
        }

        // Filter by has phone
        if ($request->filled('has_phone')) {
            $query->whereNotNull('phone')->where('phone', '!=', '');
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        if ($sort === 'name') {
            $query->orderBy('name', 'asc');
        } else {
            $query->latest();
        }

        // Get industries for filter dropdown
        $industries = [
            'IT usluge',
            'Trgovina',
            'Proizvodnja',
            'Ugostiteljstvo',
            'Građevinarstvo',
            'Financije',
            'Marketing',
            'Konzalting',
            'Dizajn',
            'Računovodstvo',
            'Pravo',
            'Edukacija',
            'Zdravlje i ljepota',
            'Turizam',
            'Prijevoz i logistika',
            'Ostalo',
        ];

        $companies = $query->paginate(12)->withQueryString();

        return view('profiles.index', compact('companies', 'industries'));
    }

    /**
     * Display the specified company profile.
     */
    public function show(string $slug): View
    {
        $company = Company::where('slug', $slug)
            ->where('is_public', true)
            ->firstOrFail();

        $activeAds = $company->ads()->active()->latest()->get();

        return view('profile.show', compact('company', 'activeAds'));
    }
}
