<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>@yield('title', 'ISI Burger')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f5f0e8] text-gray-800 antialiased">

{{-- Navbar --}}
<nav class="px-16 py-5 flex items-center justify-between bg-[#f5f0e8]">
    <a href="{{ route('home') }}" class="text-2xl font-black text-gray-900 italic">
        ISI<span class="text-[#c17f3a]">.</span>
    </a>

    <div class="flex items-center gap-8">
        <a href="{{ route('home') }}"
           class="text-sm font-semibold {{ request()->routeIs('home') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
            <i class="fa-solid fa-house"></i> Home
        </a>
        <a href="{{ route('menu') }}"
           class="text-sm font-semibold {{ request()->routeIs('menu') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
            <i class="fa-solid fa-utensils"></i> Menu
        </a>
        <a href="{{ route('galerie') }}"
           class="text-sm {{ request()->routeIs('galerie') ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' }}">
            <i class="fa-solid fa-images"></i> Galerie
        </a>
        <a href="{{ route('burgers.index') }}"
           class="text-sm {{ request()->routeIs('burgers.index') ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' }}">
            <i class="fa-solid fa-burger"></i> Burgers
        </a>
        <a href="{{ route('menu') }}"
           class="text-sm {{ request()->routeIs('menu') ? 'text-orange-500 font-semibold' : 'text-gray-600 hover:text-orange-500' }}">
            <i class="fa-solid fa-circle-info"></i> About us
        </a>
        @auth
            <a href="{{ route('client.commandes.index') }}"
               class="text-sm font-semibold {{ request()->routeIs('client.commandes.*') ? 'text-gray-900 border-b-2 border-gray-900' : 'text-gray-500 hover:text-gray-900' }}">
                <i class="fa-solid fa-cart-shopping"></i> Mes Commandes
            </a>
        @endauth
    </div>

    <div class="flex items-center gap-4">

        {{-- ICÔNE PANIER --}}
        <button onclick="ouvrirPanier()" class="relative text-gray-600 hover:text-[#c17f3a] transition text-xl">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="cartCount" class="hidden absolute -top-2 -right-2 bg-[#c17f3a] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                0
            </span>
        </button>

        @guest
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-900">Connexion</a>
            <a href="{{ route('register') }}" class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white text-sm px-5 py-2 rounded-full transition">
                Inscription
            </a>
        @endguest

        @auth
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-[#c17f3a] rounded-full flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-sm text-gray-400 hover:text-red-500 transition">✕</button>
                </form>
            </div>
        @endauth
    </div>
</nav>

<main>
    @if(session('success'))
        <div class="mx-16 mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mx-16 mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

{{-- FOND SOMBRE --}}
<div class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden" id="fondSombre" onclick="toutFermer()"></div>

{{-- PANIER (présent sur toutes les pages) --}}
<div class="fixed top-0 right-0 h-full w-80 bg-white z-30 flex flex-col translate-x-full transition-transform duration-300 shadow-2xl" id="panier">
    <div class="flex justify-between p-4 border-b">
        <h2 class="font-black text-lg uppercase">
            <i class="fa-solid fa-cart-shopping text-[#c17f3a] mr-2"></i>Mon Panier
        </h2>
        <button onclick="toutFermer()" class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
    </div>
    <div id="listePanier" class="flex-1 overflow-y-auto p-4"></div>
    <div class="p-4 border-t">
        <div class="flex justify-between font-bold mb-4">
            <span>Total</span>
            <span id="total" class="text-[#c17f3a] text-xl">$0</span>
        </div>
        <button onclick="commander()"
                class="bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-8 py-3 rounded-full font-semibold w-full text-sm transition">
            Commander →
        </button>
    </div>
</div>

@stack('scripts')

{{-- SCRIPT PANIER (fonctionne sur toutes les pages) --}}
<script>
    var panier = JSON.parse(localStorage.getItem('panier')) || [];

    afficherPanier();

    function ouvrirPanier() {
        document.getElementById('panier').classList.remove('translate-x-full');
        document.getElementById('fondSombre').classList.remove('hidden');
    }

    function toutFermer() {
        document.getElementById('panier').classList.add('translate-x-full');
        document.getElementById('fondSombre').classList.add('hidden');
        var modal = document.getElementById('modal');
        if (modal) modal.classList.add('hidden');
    }

    function afficherPanier() {
        var liste          = document.getElementById('listePanier');
        var total          = 0;
        var nombreArticles = 0;
        liste.innerHTML    = '';

        if (panier.length === 0) {
            liste.innerHTML = '<p class="text-center text-gray-400 mt-10 text-sm">Votre panier est vide</p>';
        } else {
            for (var i = 0; i < panier.length; i++) {
                var a         = panier[i];
                var sousTotal = a.prix * a.quantite;
                total         += sousTotal;
                nombreArticles += a.quantite;

                liste.innerHTML +=
                    '<div class="flex items-center gap-3 py-3 border-b">' +
                    '<img src="' + a.image + '" class="w-14 h-14 object-contain rounded-lg">' +
                    '<div class="flex-1">' +
                    '<p class="font-bold text-xs text-gray-800">' + a.nom + '</p>' +
                    '<p class="text-[#c17f3a] font-bold text-sm">FCFA' + sousTotal + '</p>' +
                    '</div>' +
                    '<div class="flex items-center gap-1">' +
                    '<button onclick="changerQuantite(' + a.id + ', -1)" class="bg-gray-100 hover:bg-gray-200 w-7 h-7 rounded font-bold">−</button>' +
                    '<span class="w-5 text-center text-sm font-bold">' + a.quantite + '</span>' +
                    '<button onclick="changerQuantite(' + a.id + ', 1)" class="bg-gray-100 hover:bg-gray-200 w-7 h-7 rounded font-bold">+</button>' +
                    '</div>' +
                    '<button onclick="supprimerArticle(' + a.id + ')" class="text-gray-300 hover:text-red-500 ml-2">' +
                    '<i class="fa-solid fa-trash text-sm"></i>' +
                    '</button>' +
                    '</div>';
            }
        }

        document.getElementById('total').textContent = 'FCFA' + total;

        var compteur = document.getElementById('cartCount');
        if (nombreArticles > 0) {
            compteur.textContent = nombreArticles;
            compteur.classList.remove('hidden');
        } else {
            compteur.classList.add('hidden');
        }
    }

    function changerQuantite(id, valeur) {
        for (var i = 0; i < panier.length; i++) {
            if (panier[i].id === id) {
                panier[i].quantite += valeur;
                if (panier[i].quantite <= 0) panier.splice(i, 1);
                break;
            }
        }
        localStorage.setItem('panier', JSON.stringify(panier));
        afficherPanier();
    }

    function supprimerArticle(id) {
        for (var i = 0; i < panier.length; i++) {
            if (panier[i].id === id) { panier.splice(i, 1); break; }
        }
        localStorage.setItem('panier', JSON.stringify(panier));
        afficherPanier();
    }

    function commander() {
        if (panier.length === 0) {
            alert('Votre panier est vide !');
            return;
        }

        fetch('{{ route("commandes.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ panier: panier })
        })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if (data.commande_id) {
                    // Vider le panier
                    panier = [];
                    localStorage.removeItem('panier');
                    afficherPanier();
                    toutFermer();
                    alert('Commande passée avec succès !');
                } else {
                    alert(data.message);
                }
            });
    }
</script>

</body>
</html>
