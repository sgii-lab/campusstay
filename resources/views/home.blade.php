@extends('layouts.app')

@section('title', 'CampusStay')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Available Properties</h2>

    @if($properties->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            No properties available yet. Please check back soon!
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" 
                             alt="{{ $property->title }}" 
                             class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $property->title }}</h3>
                        <p class="text-gray-600">{{ $property->location }}</p>
                        <p class="text-gray-900 font-bold mt-2">${{ $property->price }}/month</p>
                        <p class="text-sm text-gray-500 mt-1">Landlord: {{ $property->landlord?->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
