@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Our Menu</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- On divise les menus en deux colonnes --}}
            @foreach($menus->chunk(ceil($menus->count() / 2)) as $menuColumn)
                <div class="flex flex-col space-y-6">
                    @foreach($menuColumn as $menu)
                        <div class="flex items-center bg-white shadow-md rounded p-4">
                            <img src="{{ asset('storage/burgers/' . $menu->image) }}"
                                 alt="{{ $menu->name }}"
                                 class="w-20 h-20 object-cover rounded mr-4">

                            <div class="flex-1">
                                <h2 class="font-bold text-lg">{{ $menu->name }}</h2>
                                <p class="text-gray-600 text-sm">{{ $menu->description }}</p>
                            </div>

                            <div class="text-[#c17f3a] font-bold text-lg ml-4">
                                FCFA {{ number_format($menu->price, 0) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
