<nav class="bg-white shadow-sm px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <a href="{{ route('menu') }}" class="text-xl font-bold text-orange-500">
             ISI Burger
        </a>

        <div class="flex items-center gap-6">
            <a href="{{ route('menu') }}"
               class="text-sm {{ request()->routeIs('menu') ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' }}">
                Menu
            </a>


            @auth
                <a href="{{ route('client.commandes.index') }}"
                   class="text-sm {{ request()->routeIs('client.commandes.*') ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' }}">
                    Mes Commandes
                </a>
            @endauth
        </div>

        <div class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-600 hover:text-orange-500">Connexion</a>
                <a href="{{ route('register') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded-lg transition">
                    Inscription
                </a>
            @endguest

            @auth
                <span class="text-sm text-gray-600"><i class="fa-solid fa-user-circle"></i> {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-lg transition">
                        Déconnexion
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
