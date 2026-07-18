@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Update Form -->
    <form action="{{ route('student.updateProfile') }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <div>
            <label class="block font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">School</label>
            <input type="text" name="school" value="{{ old('school', Auth::user()->school) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">School ID</label>
            <input type="text" name="school_id" value="{{ old('school_id', Auth::user()->school_id) }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold">Preferences</label>
            <textarea name="preferences" class="w-full border rounded px-3 py-2">{{ old('preferences', Auth::user()->preferences) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save Changes
        </button>
    </form>

    <!-- Change Password -->
    <div class="mt-6">
        <a href="{{ route('student.changePassword') }}" 
            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Change Password
        </a>

    </div>

    <!-- Activity -->
    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-2">Liked Properties</h2>
        <ul class="list-disc pl-6">
            @forelse(Auth::user()->likedProperties as $property)
                <li>{{ $property->title }} – ${{ $property->price }}</li>
            @empty
                <p class="text-gray-500">No liked properties yet.</p>
            @endforelse
        </ul>

        <h1 class="text-2xl font-bold mb-4">My Requests</h1>

        @if($requests->isEmpty())
            <p class="text-gray-500">No requests yet.</p>
        @else
            <ul class="space-y-2">
                @foreach($requests as $req)
                    <li class="bg-gray-100 p-3 rounded">
                        <strong>{{ $req->property->title }}</strong>  
                        <span class="text-sm text-gray-600">({{ $req->property->location }})</span>
                        <div>Status: 
                            <span class="capitalize font-semibold">
                                {{ $req->status }}
                            </span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
