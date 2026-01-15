<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function callback($driver)
    {
        try {
            $socialUser = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Neuspješna prijava putem društvene mreže.']);
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        // Account Merge Logic
        if ($user) {
            // Update social ID if missing
            $socialIdColumn = $driver . '_id';
            if (empty($user->$socialIdColumn)) {
                $user->update([
                    $socialIdColumn => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar() ?? $user->avatar,
                    'email_verified_at' => $user->email_verified_at ?? now(), // Trust social verification
                ]);
            }
        } else {
            // Create New User
            $nameParts = explode(' ', $socialUser->getName() ?? 'Korisnik');
            $firstname = array_shift($nameParts);
            $lastname = !empty($nameParts) ? implode(' ', $nameParts) : '';

            $user = User::create([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $socialUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'account_type' => 'person', // Default to person
                $driver . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }
}
