@extends('layouts.app')

@section('content')


    <div class="text-center py-10">
        <h2 class="text-3xl font-black uppercase tracking-wide text-gray-800">Our Burgers</h2>
        <p class="text-gray-500 mt-1 text-sm">Click on a burger to see the details</p>
    </div>


    <form method="GET" action="{{ route('burgers.index') }}"
          class="max-w-6xl mx-auto px-6 mb-8 flex flex-wrap gap-3 items-center">


        <div class="flex-1 min-w-[200px]">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search a burger..."
                   class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#c17f3a]">
        </div>


        <div>
            <select name="category"
                    class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#c17f3a]">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div>
            <select name="prix"
                    class="border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#c17f3a]">
                <option value="">Price</option>
                <option value="asc"  {{ request('prix') === 'asc'  ? 'selected' : '' }}>Price: Low to High</option>
                <option value="desc" {{ request('prix') === 'desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>


        <button type="submit"
                class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-6 py-2 rounded-full text-sm font-semibold transition">
            Filter
        </button>


        @if(request('search') || request('category') || request('prix'))
            <a href="{{ route('burgers.index') }}"
               class="text-sm text-gray-500 hover:text-gray-700 underline">
                Reset
            </a>
        @endif

    </form>


    @if($burgers->isEmpty())
        <div class="text-center text-gray-400 py-20">
            <p class="text-xl">No burgers found.</p>
            <a href="{{ route('burgers.index') }}" class="text-[#c17f3a] underline text-sm mt-2 inline-block">See all burgers</a>
        </div>
    @else


        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 px-6 max-w-6xl mx-auto pb-20">
            @foreach ($burgers as $burger)
                <div onclick="ouvrirModal({{ $burger->id }}, '{{ addslashes($burger->name) }}', '{{ addslashes($burger->description) }}', {{ $burger->price }}, '{{ asset('storage/burgers/' . $burger->image) }}')"
                     class="bg-white rounded-2xl p-4 text-center cursor-pointer hover:-translate-y-1 transition-transform shadow-sm">

                    <img src="{{ asset('storage/burgers/' . $burger->image) }}"
                         alt="{{ $burger->name }}"
                         class="w-36 h-36 object-contain mx-auto my-2">

                    <p class="font-bold text-sm text-gray-800">{{ $burger->name }}</p>
                    <p class="text-gray-400 text-xs">{{ $burger->category->name ?? '' }}</p>
                    <p class="text-[#c17f3a] font-bold text-lg">FCFA {{ $burger->price }}</p>
                </div>
            @endforeach
        </div>

    @endif


    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl p-6 w-11/12 max-w-md z-30 hidden text-center shadow-xl" id="modal">

        <img id="modalImage" class="w-44 h-44 object-contain mx-auto my-3">
        <h3 id="modalNom" class="text-xl font-black uppercase text-gray-800"></h3>
        <p id="modalDescription" class="text-gray-500 text-sm mt-2 mb-4"></p>
        <span id="modalPrix" class="text-[#c17f3a] text-2xl font-black"></span>


        <div class="flex justify-center gap-4 my-4">
            <button onclick="diminuer()" class="bg-gray-100 hover:bg-gray-200 w-9 h-9 rounded font-bold text-lg">−</button>
            <span id="quantite" class="text-lg font-bold w-8 text-center">1</span>
            <button onclick="augmenter()" class="bg-gray-100 hover:bg-gray-200 w-9 h-9 rounded font-bold text-lg">+</button>
        </div>

        <button onclick="ajouterAuPanier()"
                class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-6 py-2 rounded-full w-full font-semibold transition">
            <i class="fa-solid fa-cart-plus mr-2"></i>Add to cart
        </button>

        <button onclick="fermerModal()" class="text-gray-400 hover:text-gray-600 mt-3 block mx-auto text-sm">
            Close
        </button>
    </div>

@endsection

@push('scripts')
    <script>
        var burgerActuel     = null;
        var quantiteActuelle = 1;

        function ouvrirModal(id, name, description, price, image) {
            burgerActuel     = { id, name, price, image };
            quantiteActuelle = 1;

            document.getElementById('modalImage').src               = image;
            document.getElementById('modalNom').textContent         = name;
            document.getElementById('modalDescription').textContent = description;
            document.getElementById('modalPrix').textContent        = 'FCFA ' + price;
            document.getElementById('quantite').textContent         = 1;

            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('fondSombre').classList.remove('hidden');
        }

        function fermerModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('fondSombre').classList.add('hidden');
        }

        function augmenter() {
            quantiteActuelle++;
            document.getElementById('quantite').textContent = quantiteActuelle;
        }

        function diminuer() {
            if (quantiteActuelle > 1) {
                quantiteActuelle--;
                document.getElementById('quantite').textContent = quantiteActuelle;
            }
        }

        function ajouterAuPanier() {
            var trouve = false;
            for (var i = 0; i < panier.length; i++) {
                if (panier[i].id === burgerActuel.id) {
                    panier[i].quantite += quantiteActuelle;
                    trouve = true;
                    break;
                }
            }
            if (!trouve) {
                panier.push({
                    id:       burgerActuel.id,
                    nom:      burgerActuel.name,
                    image:    burgerActuel.image,
                    prix:     burgerActuel.price,
                    quantite: quantiteActuelle
                });
            }

            localStorage.setItem('panier', JSON.stringify(panier));
            afficherPanier();
            fermerModal();
        }
    </script>
@endpush
