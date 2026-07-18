@extends('layouts.app')

@section('title', 'My Requests')

@section('content')
<h1>Pending Requests</h1>
<ul>
    @forelse($requests as $request)
        <li>{{ $request->property->title }} – Status: {{ $request->status }}</li>
    @empty
        <p>No requests submitted yet.</p>
    @endforelse
</ul>
@endsection
