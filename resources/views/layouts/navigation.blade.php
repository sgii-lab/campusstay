<nav class="nav flex items-center justify-between flex-nowrap p-2">
    <div class="flex space-x-4">
        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        <a href="{{ route('privacy') }}" class="nav-link {{ request()->routeIs('privacy') ? 'active' : '' }}">Privacy Policy</a>
    </div>

    <div class="flex space-x-4">
        @auth
            @if(Auth::user()->role === 'landlord')
                <a href="{{ route('landlord.dashboard') }}" class="nav-link {{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">Landlord Dashboard</a>
            @elseif(Auth::user()->role === 'student')
                <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">Student Dashboard</a>
            @endif
        @endauth
    </div>
</nav>
