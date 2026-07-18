@extends('layouts.app')

@section('title', 'Landlord Dashboard')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">My Properties</h1>

    <a href="{{ route('landlord.properties.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
       ➕ Add New Property
    </a>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($properties as $property)
            <div class="bg-gray-50 rounded-lg shadow p-4">
                <h3 class="text-lg font-semibold">{{ $property->title }}</h3>
                <p>{{ $property->location }}</p>
                <p class="font-bold">${{ $property->price }}/month</p>
                <p>Status: <span class="capitalize">{{ $property->status }}</span></p>

                <div class="mt-2">
                    <a href="{{ route('landlord.properties.edit', $property) }}" 
                       class="bg-yellow-500 text-white px-3 py-1 rounded">✏️ Edit</a>
                    <form action="{{ route('landlord.properties.destroy', $property) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">🗑 Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No properties yet. Add one above.</p>
        @endforelse
    </div>
    <h2 class="text-xl font-bold mt-6 mb-2">Notifications</h2>

    @if($unread->isEmpty())
        <p class="text-gray-500">No new notifications.</p>
    @else
        <ul class="space-y-2">
        @foreach($unread as $note)
            <li class="bg-yellow-100 border-l-4 border-yellow-500 p-3 rounded">
                {{ $note->data['message'] ?? 'No message available' }}
                <div class="text-sm text-gray-600">
                    {{ $note->data['contact'] ?? '' }}
                </div>
                <form action="{{ route('landlord.notifications.read', $note->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-blue-600 hover:underline">Mark as read</button>
                </form>

            </li>
        @endforeach

        </ul>
    @endif
    <h2 class="text-xl font-bold mt-6 mb-2">Pending Requests</h2>
    <ul>
        @foreach($properties as $property)
            @foreach($property->requests()->where('status','pending')->get() as $req)
                <li class="bg-gray-100 p-3 rounded mb-2">
                    {{ $req->student->name }} requested {{ $property->title }}
                    <form action="{{ route('landlord.requests.approve', $req->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Approve</button>
                    </form>

                    <form action="{{ route('landlord.requests.reject', $req->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Reject</button>
                    </form>

                </li>
            @endforeach
        @endforeach
    </ul>

</div>
@endsection
