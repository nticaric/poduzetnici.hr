<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::back()->with('status', 'profile-updated');
    }

    /**
     * Check if a slug is available.
     */
    public function checkSlug(Request $request): JsonResponse
    {
        $request->validate([
            'slug' => ['required', 'string', 'max:255'],
        ]);

        $slug = Str::slug($request->input('slug'));
        $userId = $request->user()->id;

        $exists = User::where('slug', $slug)
            ->where('id', '!=', $userId)
            ->exists();

        return response()->json([
            'available' => ! $exists,
            'slug' => $slug,
        ]);
    }

    /**
     * Toggle the public profile visibility.
     */
    public function togglePublic(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->is_public = ! $user->is_public;
        $user->save();

        return response()->json([
            'is_public' => $user->is_public,
        ]);
    }

    /**
     * Generate a slug based on user's name or company.
     */
    public function generateSlug(Request $request): JsonResponse
    {
        $user = $request->user();

        $baseName = $user->account_type === 'company'
        ? ($user->company_name ?: 'tvrtka')
        : (($user->firstname ?? '').' '.($user->lastname ?? '') ?: 'korisnik');

        $baseSlug = Str::slug($baseName);
        $slug = $baseSlug;
        $counter = 1;

        while (User::where('slug', $slug)->where('id', '!=', $user->id)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return response()->json([
            'slug' => $slug,
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
