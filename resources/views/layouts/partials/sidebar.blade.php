<aside class="w-64 bg-gray-900 text-white px-8 py-3">

    <div class="p-6 text-xl font-bold border-b border-gray-700">
        <i class="fa-solid fa-burger"></i>ISI Burger
    </div>

    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('dashboard.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard.index') ? 'bg-orange-500 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <span><i class="fa-solid fa-chart-line"></i></span><span>Dashboard</span>
        </a>
        <a href="{{ route('dashboard.burgers.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard.burgers.*') ? 'bg-orange-500 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <span><i class="fa-solid fa-burger"></i></span><span>Burgers</span>
        </a>
        <a href="{{ route('dashboard.categories.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard.categories.*') ? 'bg-orange-500 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <span><i class="fa-solid fa-layer-group"></i></span><span>Catégories</span>
        </a>
        <a href="{{ route('dashboard.commandes.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard.commandes.*') ? 'bg-orange-500 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <span><i class="fa-solid fa-cart-shopping"></i></span><span>Commandes</span>
        </a>
        <a href="{{ route('dashboard.paiements.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                  {{ request()->routeIs('dashboard.paiements.*') ? 'bg-orange-500 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <span><i class="fa-solid fa-credit-card"></i></span><span>Paiements</span>
        </a>
    </nav>

    <div class="p-4 border-t border-gray-700">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full text-left text-gray-400 hover:text-white transition text-sm">
                <i class="fa-solid fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
</aside>
