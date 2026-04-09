@extends('layouts.app')

@section('title', 'ISI Burger — Accueil')

@section('content')

    {{-- Hero Section --}}
    <section class="min-h-screen bg-[#f5f0e8] flex items-center px-16 py-16 -mt-20">

        {{-- Left --}}
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
                <a href="{{ route('menu') }}"
                   class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-8 py-3 rounded-full font-semibold transition text-sm">
                    Explore Now
                </a>
                <a href="{{ route('menu') }}"
                   class="border border-gray-400 text-gray-700 hover:border-[#c17f3a] hover:text-[#c17f3a] px-8 py-3 rounded-full font-semibold transition text-sm">
                    See Menu →
                </a>
            </div>
        </div>

        {{-- Right --}}
        <div class="w-1/2 flex justify-center items-center relative">
            <div class="w-96 h-96 bg-[#e8d5b7] rounded-full absolute opacity-50"></div>
            <div class="relative z-10 text-center">
                <div class="text-[180px] leading-none drop-shadow-2xl"><img src="storage/burgers/burger.png"  alt=""></div>
            </div>
        </div>

    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&display=swap');

        .burger-section {
            padding: 70px 20px 80px;
            background: #fff;
            font-family: inherit;
        }
        .burger-section__title {
            text-align: center;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a1a1a;
            margin: 0 0 52px;
        }
        .burger-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            max-width: 1240px;
            margin: 0 auto;
        }
        @media (max-width: 1024px) { .burger-grid { grid-template-columns: repeat(2,1fr); } }
        @media (max-width: 580px)  { .burger-grid { grid-template-columns: 1fr; } }

        .burger-card {
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: transform .3s ease, box-shadow .3s ease;
            overflow: visible;
            cursor: pointer;
            text-align: center;
        }
        .burger-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 14px 40px rgba(232,75,15,0.18);
        }
        .burger-card__img-wrap {
            position: relative;
            height: 210px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        .burger-card__img {
            width: 210px;
            height: 210px;
            object-fit: contain;
            transform: translateY(-20px);
            transition: transform .3s ease;
            filter: drop-shadow(0 12px 20px rgba(0,0,0,0.2));
            position: relative;
            z-index: 1;
        }
        .burger-card:hover .burger-card__img {
            transform: translateY(-32px) scale(1.05);
        }
        .burger-card__badge {
            position: absolute;
            top: 8px; left: 8px;
            z-index: 2;
            background: #E84B0F;
            color: #fff;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: .78rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            width: 50px; height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(232,75,15,.45);
        }
        .burger-card__body { padding: 6px 16px 22px; }
        .burger-card__stars {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2px;
            margin-bottom: 8px;
        }
        .burger-card__stars svg { color: #F5A623; }
        .burger-card__stars span { font-size: .82rem; color: #999; margin-left: 4px; }
        .burger-card__name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #1a1a1a;
            margin: 0 0 8px;
        }
        .burger-card__price { display: flex; align-items: center; justify-content: center; gap: 10px; }
        .burger-card__price s  { color: #aaa; font-size: .95rem; font-weight: 600; }
        .burger-card__price em { color: #E84B0F; font-size: 1.1rem; font-weight: 800; font-style: normal;
            font-family: 'Barlow Condensed', sans-serif; }
        /* dots */
        .burger-dots { display: flex; justify-content: center; gap: 8px; margin-top: 40px; }
        .burger-dots button {
            width: 10px; height: 10px; border-radius: 999px;
            background: #ddd; border: none; cursor: pointer; padding: 0;
            transition: background .3s, width .3s;
        }
        .burger-dots button.active { background: #E84B0F; width: 28px; }
    </style>

    <section class="burger-section">
        <div>
            <h2 class="burger-section__title">Popular Delicious Burger</h2>

            <div class="burger-grid">

                {{-- Card 1 --}}
                <div class="burger-card">
                    <div class="burger-card__img-wrap">
                        <span class="burger-card__badge">HOT</span>
                        <img src="{{ asset('storage/burgers/burger.png') }}" alt="Vegetable Beef Burger" class="burger-card__img">
                    </div>
                    <div class="burger-card__body">
                        <div class="burger-card__stars">
                            @for($i=0;$i<5;$i++)<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                            <span>(5k)</span>
                        </div>
                        <p class="burger-card__name">Vegetable Beef Burger</p>
                        <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="burger-card">
                    <div class="burger-card__img-wrap">
                        <span class="burger-card__badge">-10%</span>
                        <img src="{{ asset('storage/burgers/img.png') }}" alt="Beef Chicken Burger" class="burger-card__img">
                    </div>
                    <div class="burger-card__body">
                        <div class="burger-card__stars">
                            @for($i=0;$i<5;$i++)<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                            <span>(5k)</span>
                        </div>
                        <p class="burger-card__name">Beef Chicken Burger</p>
                        <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="burger-card">
                    <div class="burger-card__img-wrap">
                        <img src="{{ asset('storage/burgers/pexels-nadin-sh-78971847-18632205.jpg') }}" alt="Burgers Black Bread" class="burger-card__img">
                    </div>
                    <div class="burger-card__body">
                        <div class="burger-card__stars">
                            @for($i=0;$i<5;$i++)<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
                            <span>(5k)</span>
                        </div>
                        <p class="burger-card__name">Burgers Black Bread</p>
                        <div class="burger-card__price"><s>FCFA7000</s><em>FCFA5000</em></div>
                    </div>
                </div>

                {{-- Card 4 --}}
                <div class="burger-card">
                    <div class="burger-card__img-wrap">
                        <span class="burger-card__badge">NEW</span>
                        <img src="{{ asset('storage/burgers/pexels-nano-erdozain-120534369-27905923.jpg') }}" alt="Delicious Burger With Beef" class="burger-card__img">
                    </div>
                    <div class="burger-card__body">
                        <div class="burger-card__stars">
                            @for($i=0;$i<5;$i++)<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor
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
        </div>
    </section>

    <script>
        document.querySelectorAll('.burger-dots button').forEach((btn, i, all) => {
            btn.addEventListener('click', () => {
                all.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
    </script>

@endsection
