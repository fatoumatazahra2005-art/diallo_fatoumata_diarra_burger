@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <h1 class="text-3xl font-bold mb-2 text-center">Burger Gallery</h1>
        <p class="text-center text-gray-500 mb-8">Discover our delicious creations</p>

        <!-- GALLERY GRID -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach($produits as $burger)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/burgers/' . $burger->image) }}"
                             alt="{{ $burger->name }}"
                             class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <div class="p-4">

                        <h2 class="font-bold text-lg text-gray-800 truncate">
                            {{ $burger->name }}
                        </h2>

                        <p class="text-gray-500 text-sm mt-1 line-clamp-2">
                            {{ $burger->description }}
                        </p>

                        <div class="flex justify-end mt-3">
                            <i class="fa-solid fa-burger text-[#c17f3a]"></i>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <!-- STATS SECTION -->
        <div class="flex items-center my-12">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="mx-4 text-[#c17f3a] font-bold text-lg">
            <i class="fa-solid fa-burger"></i> ISI BURGER
        </span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center mb-10">

            <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition">
                <div class="text-4xl font-bold text-[#c17f3a]">{{ $produits->count() }}+</div>
                <div class="text-gray-500 mt-1 text-sm">Burgers available</div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition">
                <div class="text-4xl font-bold text-[#c17f3a]">100%</div>
                <div class="text-gray-500 mt-1 text-sm">Fresh ingredients</div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 hover:shadow-xl transition">
                <div class="text-4xl font-bold text-[#c17f3a]">
                    <i class="fa-solid fa-star text-yellow-400 text-2xl"></i> 5
                </div>
                <div class="text-gray-500 mt-1 text-sm">Average rating</div>
            </div>

        </div>

        <!-- CTA -->
        <div class="bg-[#c17f3a] rounded-2xl p-8 text-center text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Craving a great burger?</h2>
            <p class="text-white/80 mb-6">Order now and enjoy fresh burgers in minutes.</p>

            <a href="{{ route('menu') }}"
               class="inline-block bg-white text-[#c17f3a] font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition">
                View the menu
            </a>
        </div>

    </div>
@endsection
