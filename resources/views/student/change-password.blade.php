@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Change Password</h1>

    @if(session('status'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.updatePassword') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="current_password" class="block font-semibold">Current Password</label>
            <input id="current_password" type="password" name="current_password" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold">New Password</label>
            <input id="password" type="password" name="password" required class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block font-semibold">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Update Password
        </button>
    </form>
</div>
@endsection
