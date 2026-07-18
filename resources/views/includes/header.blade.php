<header class="site-header">
    <div class="header-container">
        <a href="/" class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="CampusStay Logo" class="logo">
        </a>

        @include('layouts.navigation')

        <div class="header-actions">
            <!-- @auth
                @if(Auth::user()->role === 'landlord')
                    <a href="{{ route('landlord.dashboard') }}" class="landlord-btn">Landlord Dashboard</a>
                @endif
            @endauth -->
            @auth
                <span class="welcome">Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary">Logout</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn-secondary">Log in</a>
                <a href="{{ route('register') }}" class="btn-primary">Sign up</a>
            @endguest
        </div>

        <button class="menu-toggle" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
