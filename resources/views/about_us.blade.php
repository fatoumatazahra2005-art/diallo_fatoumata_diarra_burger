@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-b from-white to-gray-50 py-14">

        <div class="max-w-6xl mx-auto px-6">


            <h1 class="text-4xl font-extrabold text-center text-[#c17f3a] mb-12">
                About Us
            </h1>


            <div class="grid md:grid-cols-2 gap-12 items-center bg-white p-8 rounded-2xl shadow-lg">


                <div>
                    <h2 class="text-3xl font-bold mb-4 text-gray-800">
                        Welcome to ISI Burger
                    </h2>

                    <p class="text-gray-600 mb-4 leading-relaxed">
                        ISI Burger is a fast-food restaurant dedicated to offering delicious,
                        fresh, and high-quality burgers made with passion.
                    </p>

                    <p class="text-gray-600 mb-4 leading-relaxed">
                        We believe in quality ingredients, fast service, and unforgettable taste experiences
                        that bring people together.
                    </p>

                    <p class="text-gray-600 leading-relaxed">
                        Whether dining in or ordering online, we guarantee satisfaction in every bite.
                    </p>
                </div>


                <div class="relative">
                    <img src="{{ asset('storage/burgers/burger.png') }}"
                         alt="About ISI Burger"
                         class="rounded-2xl shadow-xl transform hover:scale-105 transition duration-500">
                </div>

            </div>


            <div class="mt-14 grid md:grid-cols-3 gap-6">


                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <i class="fa-solid fa-award text-3xl text-[#c17f3a] mb-3"></i>
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Quality</h3>
                    <p class="text-gray-500 text-sm">Fresh ingredients every day.</p>
                </div>


                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <i class="fa-solid fa-bolt text-3xl text-[#c17f3a] mb-3"></i>
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Fast Service</h3>
                    <p class="text-gray-500 text-sm">Quick and efficient delivery.</p>
                </div>


                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                    <i class="fa-solid fa-utensils text-3xl text-[#c17f3a] mb-3"></i>
                    <h3 class="font-bold text-xl mb-2 text-gray-800">Taste</h3>
                    <p class="text-gray-500 text-sm">Unique and delicious recipes.</p>
                </div>

            </div>

        </div>
    </div>
@endsection
