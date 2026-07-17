@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Profile</h2>

    @if (session('status') === 'profile-updated')
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            Profile updated successfully.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
        @csrf
        @method('DELETE')

        <div>
            <label>Password</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Delete Account</button>
    </form>
</div>
@endsection
