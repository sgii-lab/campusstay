<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function preferences()
    {
        return view('student.preferences', ['user' => Auth::user()]);
    }

    public function updatePreferences(Request $request)
    {
        $request->validate([
            'preferred_location' => 'nullable|string|max:255',
            'budget_min' => 'nullable|numeric',
            'budget_max' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $user->update($request->only('preferred_location','budget_min','budget_max'));

        return redirect()->route('student.dashboard')->with('success', 'Preferences updated!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'school' => 'nullable|string|max:255',
            'school_id' => 'nullable|string|max:255',
            'preferences' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $user->update($request->only('name','email','school','school_id','preferences'));

        return redirect()->route('student.dashboard')->with('success', 'Profile updated successfully!');
    }

    

    public function editPassword()
    {
        return view('student.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match our records.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('student.dashboard')->with('status', 'Password updated successfully!');
    }



}
