<header class="site-header relative">
    <div class="header-container max-w-7xl mx-auto flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('images/logo2.png') }}" alt="CampusStay Logo" class="h-12 w-auto">
        </a>

        <!-- Desktop Navigation -->
        <nav id="nav"
            class="hidden md:flex items-center gap-6">
            @include('layouts.navigation')
        </nav>

        <!-- Right Side -->
        <div class="flex items-center gap-3">

            @auth
                @php
                    $firstName = explode(' ', Auth::user()->name)[0];
                    $displayName = strlen($firstName) > 10
                        ? substr($firstName, 0, 10) . '...'
                        : $firstName;
                @endphp

                <span class="hidden lg:inline text-white">
                    Hello, {{ $displayName }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-secondary">
                    Log in
                </a>

                <a href="{{ route('register') }}" class="btn-primary">
                    Sign up
                </a>
            @endauth

            <!-- Hamburger -->
            <button
                id="menu-toggle"
                class="md:hidden flex flex-col justify-center items-center gap-1 p-2 rounded border border-gray-500"
                aria-label="Toggle Menu">

                <span class="w-6 h-0.5 bg-white"></span>
                <span class="w-6 h-0.5 bg-white"></span>
                <span class="w-6 h-0.5 bg-white"></span>

            </button>

        </div>

    </div>

    <!-- Mobile Menu -->
    <div
        id="mobile-menu"
        class="hidden md:hidden bg-[#1a1a1a] border-t border-gray-700">

        <nav class="flex flex-col p-4 space-y-3">
            @include('layouts.navigation')
        </nav>

    </div>

</header>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const button = document.getElementById('menu-toggle');
    const menu = document.getElementById('mobile-menu');

    button.addEventListener('click', function () {
        menu.classList.toggle('hidden');
    });

});
</script>