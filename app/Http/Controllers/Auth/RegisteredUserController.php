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
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'role'      => ['nullable', 'in:student,landlord'],
            'phone'     => ['nullable', 'string', 'max:20'],
            'whatsapp'  => ['nullable', 'string', 'max:20'],
        ]);

        // Default role if none was supplied
        $role = $validated['role'] ?? 'student';

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role'      => $role,
            'phone'     => $validated['phone'] ?? null,
            'whatsapp'  => $validated['whatsapp'] ?? null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return match ($user->role) {
            'landlord' => redirect()->route('landlord.dashboard'),
            'student'  => redirect()->route('student.dashboard'),
            default    => redirect()->route('dashboard'),
        };
    }
}