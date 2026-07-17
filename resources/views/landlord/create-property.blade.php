@extends('layouts.app')

@section('title', 'Create Listing')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Add a New Property</h2>

    <form method="POST" action="{{ route('landlord.listings.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Description</label>
            <textarea name="description" value="{{ old('description') }}" class="w-full border rounded p-2" required></textarea>
        </div>
        <div>
            <label class="block text-gray-700">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Price</label>
            <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded p-2" required>
        </div>
        <div>
            <label class="block text-gray-700">Image</label>
            <input type="file" name="image" class="w-full border rounded p-2">
        </div>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Submit Listing
        </button>
    </form>
@endsection
