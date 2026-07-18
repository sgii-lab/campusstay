@extends('layouts.app')

@section('title', 'Liked Properties')

@section('content')
<h1>Liked Properties</h1>
<ul>
    @forelse($properties as $property)
        <li>{{ $property->title }} – ${{ $property->price }}</li>
    @empty
        <p>You haven’t liked any properties yet.</p>
    @endforelse
</ul>
@endsection
