@extends('layouts.app')

@section('title', 'Edit Property')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6">Edit Listing</h2>

        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('landlord.listings.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $property->title) }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded p-2 focus:ring focus:ring-blue-300">{{ old('description', $property->description) }}</textarea>
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $property->location) }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Price (per month)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $property->price) }}"
                       class="w-full border rounded p-2 focus:ring focus:ring-blue-300">
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Image</label>
                @if($property->image)
                    <img src="{{ asset('storage/' . $property->image) }}" 
                         alt="{{ $property->title }}" 
                         class="w-full h-48 object-cover mb-2 rounded">
                @endif
                <input type="file" name="image" class="w-full border rounded p-2">
                <p class="text-sm text-gray-500 mt-1">Leave blank to keep current image.</p>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('landlord.dashboard') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update Listing
                </button>
            </div>
        </form>
    </div>
@endsection
