<header class="site-header">
    <div class="header-container">
        <a href="/" class="logo">
            <img src="{{ asset('images/logo2.png') }}" alt="CampusStay Logo" class="logo">
        </a>

        @include('layouts.navigation')

        <div class="header-actions">

            @auth
                @php
                    // Get full name
                    $fullName = Auth::user()->name;

                    // Extract first name
                    $firstName = explode(' ', $fullName)[0];

                    // If longer than 10 chars, shorten
                    $displayName = strlen($firstName) > 10 ? substr($firstName, 0, 10) . '…' : $firstName;
                @endphp

                <span class="welcome">Hello, {{ $displayName }}</span>

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
