<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['nullable', 'string', 'max:255', 'required_if:account_type,person'],
            'lastname' => ['nullable', 'string', 'max:255', 'required_if:account_type,person'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'account_type' => ['required', 'in:person,company'],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:account_type,company'],
            'company_type' => ['nullable', 'string', 'in:company,craft', 'required_if:account_type,company'],
            'oib' => ['nullable', 'string', 'size:11', 'required_if:account_type,company'],
        ]);

        $user = User::create([
            'firstname' => $request->firstname ?: '',
            'lastname' => $request->lastname ?: '',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => $request->account_type,
            'company_name' => $request->company_name,
            'company_type' => $request->company_type,
            'oib' => $request->oib,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
