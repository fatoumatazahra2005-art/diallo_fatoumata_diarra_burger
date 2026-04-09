@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto px-6 py-10">

        <h2 class="text-3xl font-black uppercase tracking-wide text-gray-800 mb-8">
            Mes Commandes
        </h2>

        @if ($commandes->isEmpty())
            {{-- Aucune commande --}}
            <div class="text-center py-20">
                <p class="text-5xl mb-4">🍔</p>
                <p class="text-gray-500">Vous n'avez pas encore de commande.</p>
                <a href="{{ route('burgers.index') }}"
                   class="inline-block mt-4 bg-[#c17f3a] hover:bg-[#a96d2e] text-white px-8 py-3 rounded-full font-semibold transition text-sm">
                    Commander maintenant
                </a>
            </div>

        @else
            {{-- Liste des commandes --}}
            <div class="flex flex-col gap-6">

                @foreach ($commandes as $commande)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                        {{-- En-tête de la commande --}}
                        <div class="flex items-center justify-between px-6 py-4 border-b">
                            <div>
                                <p class="font-black text-gray-800">Commande #{{ $commande->id }}</p>
                                <p class="text-gray-400 text-xs mt-1">
                                    {{ $commande->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>

                            {{-- Statut --}}
                            @php
                                $statuts = [
                                    'en_attente'     => ['label' => 'En attente',     'class' => 'bg-yellow-100 text-yellow-700'],
                                    'en_preparation' => ['label' => 'En préparation', 'class' => 'bg-blue-100 text-blue-700'],
                                    'prete'          => ['label' => 'Prête',          'class' => 'bg-green-100 text-green-700'],
                                    'payee'          => ['label' => 'Payée',          'class' => 'bg-gray-100 text-gray-600'],
                                    'annulee'        => ['label' => 'Annulée',        'class' => 'bg-red-100 text-red-500'],
                                ];
                                $statut = $statuts[$commande->status] ?? ['label' => $commande->status, 'class' => 'bg-gray-100 text-gray-600'];
                            @endphp

                            <span class="text-xs font-semibold px-4 py-2 rounded-full {{ $statut['class'] }}">
                            {{ $statut['label'] }}
                        </span>
                        </div>

                        {{-- Détails des burgers --}}
                        <div class="px-6 py-4">
                            @foreach ($commande->details as $detail)
                                <div class="flex items-center gap-4 py-2 border-b last:border-0">
                                    <img src="{{ asset('storage/burgers/' . $detail->burger->image) }}"
                                         alt="{{ $detail->burger->name }}"
                                         class="w-12 h-12 object-contain rounded-lg">
                                    <div class="flex-1">
                                        <p class="font-bold text-sm text-gray-800">{{ $detail->burger->name }}</p>
                                        <p class="text-gray-400 text-xs">x{{ $detail->quantity }} — FCFA {{ $detail->unit_price }} / unité</p>
                                    </div>
                                    <p class="font-bold text-[#c17f3a] text-sm">
                                        FCFA {{ $detail->quantity * $detail->unit_price }}
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {{-- Total --}}
                        <div class="flex justify-between items-center px-6 py-4 bg-gray-50">
                            <span class="text-sm text-gray-500">Total</span>
                            <span class="font-black text-[#c17f3a] text-lg">FCFA {{ $commande->total_price }}</span>
                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>

@endsection
