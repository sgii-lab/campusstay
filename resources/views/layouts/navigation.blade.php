<nav class="nav">
    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
    <a href="{{ route('privacy') }}" class="{{ request()->routeIs('privacy') ? 'active' : '' }}">Privacy Policy</a>
    <a href="{{ route('terms') }}" class="{{ request()->routeIs('terms') ? 'active' : '' }}">Terms & Conditions</a>

    @auth
        @if(Auth::user()->role === 'landlord')
            <a href="{{ route('landlord.dashboard') }}" class="{{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">Landlord Dashboard</a>
        @elseif(Auth::user()->role === 'student')
            <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">Student Dashboard</a>
        @endif
    @endauth
</nav>
