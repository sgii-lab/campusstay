<nav class="bg-white shadow mb-6">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="{{ route('home') }}" class="text-gray-700 font-semibold hover:text-blue-600">Home</a>

            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">Register</a>
            @endguest

            @auth
                @if(Auth::user()->role === 'landlord')
                    <a href="{{ route('landlord.dashboard') }}" class="text-gray-700 hover:text-blue-600">Landlord Dashboard</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="text-gray-700 hover:text-blue-600">Admin Dashboard</a>
                @endif
            @endauth
        </div>

        @auth
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>
