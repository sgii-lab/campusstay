@extends('layouts.app')

@section('title', 'Student Preferences')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Update Preferences</h1>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/student/preferences') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="preferred_location" class="block text-gray-700 font-semibold">Preferred Location</label>
            <input type="text" id="preferred_location" name="preferred_location"
                   value="{{ old('preferred_location', $user->preferred_location ?? '') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="budget_min" class="block text-gray-700 font-semibold">Minimum Budget</label>
            <input type="number" id="budget_min" name="budget_min"
                   value="{{ old('budget_min', $user->budget_min ?? '') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="budget_max" class="block text-gray-700 font-semibold">Maximum Budget</label>
            <input type="number" id="budget_max" name="budget_max"
                   value="{{ old('budget_max', $user->budget_max ?? '') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save Preferences
        </button>
    </form>
</div>
@endsection
