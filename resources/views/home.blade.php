@extends('layouts.app')

@section('title', 'ISI Burger — Accueil')

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@section('content')


    <section class="min-h-screen bg-[#f5f0e8] flex items-center px-16 py-16 -mt-20">
        <div class="w-1/2 z-10">
            <span class="inline-block bg-[#e8d5b7] text-[#c17f3a] text-xs font-semibold px-4 py-2 rounded-full mb-6 uppercase tracking-wider">
                The Original Burger
            </span>
            <h1 class="text-7xl font-black text-gray-900 leading-none mb-6">
                SAVORY &<br>DELICIOUS
            </h1>
            <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
                Delicious burgers made from high-quality beef, carefully processed to create a juicy and flavorful taste.
            </p>
            <div class="flex items-center gap-4">
                <a href="{{ route('burgers.index') }}"
                   class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-8 py-3 rounded-full font-semibold transition text-sm">
                    Explore Now
                </a>
                <a href="{{ route('menu') }}"
                   class="border border-gray-400 text-gray-700 hover:border-[#c17f3a] hover:text-[#c17f3a] px-8 py-3 rounded-full font-semibold transition text-sm">
                    See Menu <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <div class="w-1/2 flex justify-center items-center relative">
            <div class="w-96 h-96 bg-[#e8d5b7] rounded-full absolute opacity-50"></div>
            <div class="relative z-10 text-center">
                <img src="storage/burgers/burger.png" alt="">
            </div>
        </div>
    </section>


    <section class="burger-section">
        <h2 class="burger-section__title">Popular Delicious Burger</h2>
        <div class="burger-grid">


            <div class="burger-card">
                <div class="burger-card__img-wrap">
                    <span class="burger-card__badge">HOT</span>
                    <img src="{{ asset('storage/burgers/burger.png') }}" alt="Vegetable Beef Burger" class="burger-card__img" style="height:125px; object-fit:cover;">
                </div>
                <div class="burger-card__body">
                    <div class="burger-card__stars">
                        @for($i=0;$i<5;$i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        @endfor
                        <span>(5k)</span>
                    </div>
                    <p class="burger-card__name">Vegetable Beef Burger</p>
                    <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                </div>
            </div>


            <div class="burger-card">
                <div class="burger-card__img-wrap">
                    <span class="burger-card__badge">-10%</span>
                    <img src="{{ asset('storage/burgers/img.png') }}" alt="Beef Chicken Burger" class="burger-card__img" style="height:125px; object-fit:cover;">
                </div>
                <div class="burger-card__body">
                    <div class="burger-card__stars">
                        @for($i=0;$i<5;$i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        @endfor
                        <span>(5k)</span>
                    </div>
                    <p class="burger-card__name">Beef Chicken Burger</p>
                    <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                </div>
            </div>


            <div class="burger-card">
                <div class="burger-card__img-wrap">
                    <img src="{{ asset('storage/burgers/pexels-nadin-sh-78971847-18632205.jpg') }}" alt="Burgers Black Bread" class="burger-card__img" style="height:125px; object-fit:cover;" >
                </div>
                <div class="burger-card__body">
                    <div class="burger-card__stars">
                        @for($i=0;$i<5;$i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        @endfor
                        <span>(5k)</span>
                    </div>
                    <p class="burger-card__name">Burgers Black Bread</p>
                    <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                </div>
            </div>


            <div class="burger-card">
                <div class="burger-card__img-wrap">
                    <span class="burger-card__badge">NEW</span>
                    <img src="{{ asset('storage/burgers/pexels-nano-erdozain-120534369-27905923.jpg') }}"
                         alt="Delicious Burger With Beef"
                         class="burger-card__img"
                         style="height:120px; object-fit:cover;">
                </div>
                <div class="burger-card__body">
                    <div class="burger-card__stars">
                        @for($i=0;$i<5;$i++)
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        @endfor
                        <span>(5k)</span>
                    </div>
                    <p class="burger-card__name">Delicious Burger With Beef</p>
                    <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                </div>
            </div>

        </div>

        <div class="burger-dots">
            <button class="active"></button>
            <button></button>
            <button></button>
            <button></button>
        </div>
    </section>

@endsection

@push('scripts')
    @vite(['resources/js/home.js'])
@endpush
