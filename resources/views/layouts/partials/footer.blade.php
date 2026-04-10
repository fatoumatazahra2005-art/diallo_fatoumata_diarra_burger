<footer class="bg-[#1f1f1f] text-gray-300 mt-10">
    <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        <div>
            <h2 class="text-xl font-bold text-white mb-3">ISI Burger</h2>
            <p class="text-sm text-gray-400">
                Enjoy the best burgers made with fresh ingredients and a unique taste.
            </p>
        </div>

        <div>
            <h3 class="text-white font-semibold mb-3">Quick Links</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-[#c17f3a]">Home</a></li>
                <li><a href="{{ route('menu') }}" class="hover:text-[#c17f3a]">Menu</a></li>
                <li><a href="{{ route('burgers.index') }}" class="hover:text-[#c17f3a]">Burgers</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-white font-semibold mb-3">Contact</h3>
            <p class="text-sm text-gray-400">
                <i class="fa-solid fa-location-dot"></i> Dakar, Senegal
            </p>
            <p class="text-sm text-gray-400">
                <i class="fa-solid fa-phone"></i> +221 77 000 00 00
            </p>
            <p class="text-sm text-gray-400">
                <i class="fa-solid fa-envelope"></i> contact@isiburger.com
            </p>
        </div>

    </div>

    <div class="border-t border-gray-700 text-center py-4 text-sm text-gray-500">
        © {{ date('Y') }} ISI Burger — All rights reserved
    </div>
</footer>
