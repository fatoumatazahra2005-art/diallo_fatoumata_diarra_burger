@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-center">Burger Gallery</h1>
        <p class="text-center text-gray-500 mb-8">Discover our delicious creations</p>

        {{-- Main Slider --}}
        <div class="relative overflow-hidden rounded-2xl shadow-lg" id="slider">

            <div class="flex transition-transform duration-500 ease-in-out" id="slider-track">
                @foreach($produits as $index => $burger)
                    <div class="min-w-full relative">
                        <img src="{{ asset('storage/burgers/' . $burger->image) }}"
                             alt="{{ $burger->name }}"
                             class="w-full h-[500px] object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                            <h2 class="text-white text-2xl font-bold">{{ $burger->name }}</h2>
                            <p class="text-gray-300 text-sm mt-1">{{ $burger->description }}</p>
                            <div class="text-[#c17f3a] font-bold text-xl mt-2">
                                FCFA {{ number_format($burger->price, 0) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button onclick="prevSlide()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                &#8592;
            </button>

            <button onclick="nextSlide()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/80 text-white rounded-full w-10 h-10 flex items-center justify-center transition">
                &#8594;
            </button>
        </div>

        {{-- Navigation Dots --}}
        <div class="flex justify-center gap-2 mt-4" id="dots">
            @foreach($produits as $index => $burger)
                <button onclick="goToSlide({{ $index }})"
                        class="w-3 h-3 rounded-full transition-all duration-300 dot {{ $index === 0 ? 'bg-[#c17f3a] w-6' : 'bg-gray-300' }}">
                </button>
            @endforeach
        </div>

        {{-- Clickable Thumbnails --}}
        <div class="flex flex-wrap justify-center gap-3 mt-8">
            @foreach($produits as $index => $burger)
                <div onclick="goToSlide({{ $index }})"
                     class="cursor-pointer rounded-xl overflow-hidden shadow hover:scale-105 transition-transform border-2 border-transparent hover:border-[#c17f3a] miniature w-28"
                     data-index="{{ $index }}">
                    <img src="{{ asset('storage/burgers/' . $burger->image) }}"
                         alt="{{ $burger->name }}"
                         class="w-full h-20 object-cover">
                    <p class="text-xs text-center py-1 font-medium text-gray-700 truncate px-1">
                        {{ $burger->name }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Divider --}}
        <div class="flex items-center my-10">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="mx-4 text-[#c17f3a] font-bold text-lg"><i class="fa-solid fa-burger"></i> ISI BURGER</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-6 text-center mb-10">
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-4xl font-bold text-[#c17f3a]">{{ $produits->count() }}+</div>
                <div class="text-gray-500 mt-1 text-sm">Burgers available</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-4xl font-bold text-[#c17f3a]">100%</div>
                <div class="text-gray-500 mt-1 text-sm">Fresh ingredients</div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-4xl font-bold text-[#c17f3a]"><i class="fa-solid fa-star text-yellow-400 text-2xl"></i> 5</div>
                <div class="text-gray-500 mt-1 text-sm">Average rating</div>
            </div>
        </div>

        {{-- Call to action --}}
        <div class="bg-[#c17f3a] rounded-2xl p-8 text-center text-white shadow-lg">
            <h2 class="text-2xl font-bold mb-2">Craving a great burger?</h2>
            <p class="text-white/80 mb-6">Order now and get it delivered in just a few minutes.</p>
            <a href="{{ route('menu') }}"
               class="inline-block bg-white text-[#c17f3a] font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition">
                View the menu
            </a>
        </div>

    </div>

    @push('scripts')
        <script>
            let current = 0;
            const total      = {{ $produits->count() }};
            const track      = document.getElementById('slider-track');
            const dots       = document.querySelectorAll('.dot');
            const miniatures = document.querySelectorAll('.miniature');

            function updateSlider() {
                track.style.transform = `translateX(-${current * 100}%)`;

                dots.forEach((dot, i) => {
                    if (i === current) {
                        dot.classList.add('bg-[#c17f3a]', 'w-6');
                        dot.classList.remove('bg-gray-300');
                    } else {
                        dot.classList.remove('bg-[#c17f3a]', 'w-6');
                        dot.classList.add('bg-gray-300');
                    }
                });

                miniatures.forEach((m, i) => {
                    if (i === current) {
                        m.classList.add('border-[#c17f3a]');
                    } else {
                        m.classList.remove('border-[#c17f3a]');
                    }
                });
            }

            function nextSlide() {
                current = (current + 1) % total;
                updateSlider();
            }

            function prevSlide() {
                current = (current - 1 + total) % total;
                updateSlider();
            }

            function goToSlide(index) {
                current = index;
                updateSlider();
            }

            setInterval(nextSlide, 4000);
        </script>
    @endpush
@endsection
