@extends('layouts.app')

@section('title', 'Add New Property')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Add New Property</h1>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('landlord.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Location</label>
            <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Price (per month)</label>
            <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Image</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Save Property
        </button>
    </form>
</div>
@endsection
