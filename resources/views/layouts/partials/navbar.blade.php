<header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between">
    <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
    <div class="flex items-center gap-3">
        <span class="text-sm text-gray-500"><i class="fa-solid fa-user-circle"></i>{{ auth()->user()->name }}</span>
    </div>
</header>
