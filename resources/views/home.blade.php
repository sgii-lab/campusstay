@extends('layouts.app')

@section('title', 'CampusStay')

@section('content')
    <form method="GET" action="{{ route('home') }}" class="flex gap-4 mb-6">
        <input type="text" name="location" value="{{ request('location') }}" placeholder="Location" class="border rounded px-2 py-1">
        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min Price" class="border rounded px-2 py-1">
        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max Price" class="border rounded px-2 py-1">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('home') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Clear</a>
    </form>



    <h2 class="text-2xl font-bold mb-6">Available Properties</h2>

    @if($properties->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
            No properties available yet. Please check back soon!
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div 
                    x-data="{ open: false }" 
                    class="relative bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl cursor-pointer"
                    @click="open = !open"
                >
                    <!-- Card image -->
                    @if($property->image)
                        <img src="{{ asset('storage/' . $property->image) }}" 
                            alt="{{ $property->title }}" 
                            class="w-full h-48 object-cover">
                    @endif

                    <!-- Card content -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $property->title }}</h3>
                        <p class="text-gray-600">{{ $property->location }}</p>
                        <p class="text-gray-900 font-bold mt-2">${{ $property->price }}/month</p>
                    </div>

                    <!-- Expanded floating panel -->
                    <div 
                        x-show="open" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="absolute inset-0 bg-white rounded-lg shadow-2xl p-6 z-20"
                    >
                        <h3 class="text-xl font-bold mb-2">{{ $property->title }}</h3>
                        <p class="text-gray-700 mb-2">{{ $property->description }}</p>
                        <p class="text-gray-900 font-semibold mb-4">Price: ${{ $property->price }}/month</p>
                        <p class="text-sm text-gray-500 mb-4">Landlord: {{ $property->landlord?->name }}</p>

                        <!-- Contact buttons -->
                        <div class="flex gap-4">
                            <a href="mailto:{{ $property->landlord?->email }}" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Email Landlord
                            </a>
                            @php
                                $countryCode = '+263'; // or dynamically from user profile
                                $whatsapp = ltrim($property->landlord?->whatsapp, '0'); // remove leading 0
                                $waLink = "https://wa.me/{$countryCode}{$whatsapp}";
                            @endphp

                            <a href="{{ $waLink }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Chat on WhatsApp
                            </a>
                            <!-- <a href="https://wa.me/{{ $property->landlord?->whatsapp }}" 
                            target="_blank"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                WhatsApp Landlord
                            </a> -->
                        </div>

                        <!-- Close button -->
                        <button @click="open = false" 
                                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                            ✕
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
