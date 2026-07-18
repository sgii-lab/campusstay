@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<h1>Student Profile</h1>

<p><strong>Name:</strong> {{ Auth::user()->name }}</p>
<p><strong>Email:</strong> {{ Auth::user()->email }}</p>
<p><strong>School:</strong> {{ Auth::user()->school }}</p>
<p><strong>School ID:</strong> {{ Auth::user()->school_id }}</p>

<h2>Liked Properties</h2>
<ul>
    @foreach($likedProperties as $property)
        <li>{{ $property->title }} – ${{ $property->price }}</li>
    @endforeach
</ul>

<h2>Pending Applications</h2>
<ul>
    @foreach($requests as $request)
        <li>{{ $request->property->title }} – Status: {{ $request->status }}</li>
    @endforeach
</ul>
@endsection
