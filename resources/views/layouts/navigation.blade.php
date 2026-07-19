<nav class="w-full">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full">

        <!-- Main Links -->
        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-4">

            <a href="{{ url('/') }}"
               class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                Home
            </a>

            <a href="{{ route('about') }}"
               class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                About
            </a>

            <a href="{{ route('contact') }}"
               class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                Contact
            </a>

            <a href="{{ route('privacy') }}"
               class="nav-link {{ request()->routeIs('privacy') ? 'active' : '' }}">
                Privacy Policy
            </a>

        </div>

        <!-- Dashboard -->
        @auth
            <div class="flex flex-col md:flex-row mt-2 md:mt-0">

                @if(Auth::user()->role === 'landlord')

                    <a href="{{ route('landlord.dashboard') }}"
                       class="nav-link {{ request()->routeIs('landlord.dashboard') ? 'active' : '' }}">
                        Landlord Dashboard
                    </a>

                @elseif(Auth::user()->role === 'student')

                    <a href="{{ route('student.dashboard') }}"
                       class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        Student Dashboard
                    </a>

                @endif

            </div>
        @endauth

    </div>
</nav>