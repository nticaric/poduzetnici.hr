<?php
namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $users = $query->withCount('ads')->latest()->paginate(20)->withQueryString();
        $roles = UserRole::options();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->loadCount('ads');
        $user->load(['ads' => fn($q) => $q->latest()->take(10)]);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = UserRole::options();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname'    => 'required|string|max:255',
            'lastname'     => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'role'         => 'required|in:' . implode(',', array_keys(UserRole::options())),
            'account_type' => 'required|in:person,company',
            'company_name' => 'nullable|string|max:255',
            'oib'          => 'nullable|string|max:11',
            'phone'        => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('status', 'Korisnik uspješno ažuriran.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Ne možete obrisati vlastiti račun.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('status', 'Korisnik uspješno obrisan.');
    }
}
