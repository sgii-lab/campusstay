@extends('layouts.app')

@section('title', 'Landlord Dashboard')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Welcome, {{ auth()->user()->name }}</h2>
        <a href="{{ route('landlord.listings.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
           + Add New Listing
        </a>
    </div>

    <h3 class="text-xl font-semibold mb-4">Your Listings</h3>

    @forelse($properties as $property)
        <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
            @if($property->image)
                <img src="{{ asset('storage/' . $property->image) }}" 
                     alt="{{ $property->title }}" 
                     class="w-full h-48 object-cover">
            @endif

            <div class="p-4 flex justify-between items-center">
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">{{ $property->title }}</h4>
                    <p class="text-gray-600">{{ $property->location }}</p>
                    <p class="text-gray-900 font-bold mt-1">${{ $property->price }}/month</p>
                    <p class="text-sm text-gray-500">Status: {{ $property->status }}</p>
                </div>
                <div class="space-x-2">
                    <!-- Edit button -->
                    <a href="{{ route('landlord.listings.edit', $property) }}" 
                       class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                        Edit
                    </a>

                    <!-- Delete button -->
                    <form action="{{ route('landlord.listings.destroy', $property) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this listing?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            You don’t have any listings yet. Click “Add New Listing” to create one.
        </div>
    @endforelse
@endsection
