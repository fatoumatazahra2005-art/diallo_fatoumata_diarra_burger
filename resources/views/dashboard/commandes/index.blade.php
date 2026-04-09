@extends('layouts.dashboard')

@section('title', 'Commandes')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-xl font-bold text-gray-800">Liste des commandes</h4>
        <span class="bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full">
            {{ $commandes->total() }} commande(s)
        </span>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Articles</th>
                    <th class="px-4 py-3 text-left">Total</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($commandes as $commande)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-500">#{{ $commande->id }}</td>

                        <td class="px-4 py-3">
                            <div class="font-semibold">{{ $commande->user->name }}</div>
                            <div class="text-xs text-gray-400">{{ $commande->user->email }}</div>
                        </td>

                        <td class="px-4 py-3">
                            @foreach($commande->details as $detail)
                                <div class="text-xs text-gray-600">{{ $detail->burger->nom }} x{{ $detail->quantity }}</div>
                            @endforeach
                        </td>

                        <td class="px-4 py-3 font-semibold">
                            {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA
                        </td>

                        <td class="px-4 py-3">
                            @php
                                $colors = [
                                    'en_attente'     => 'bg-yellow-100 text-yellow-800',
                                    'en_preparation' => 'bg-blue-100 text-blue-800',
                                    'prete'          => 'bg-green-100 text-green-800',
                                    'payee'          => 'bg-indigo-100 text-indigo-800',
                                    'annulee'        => 'bg-red-100 text-red-800',
                                ];
                                $labels = [
                                    'en_attente'     => 'En attente',
                                    'en_preparation' => 'En préparation',
                                    'prete'          => 'Prête',
                                    'payee'          => 'Payée',
                                    'annulee'        => 'Annulée',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $colors[$commande->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $labels[$commande->status] ?? $commande->status }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ $commande->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2 justify-center">

                                {{-- Bouton voir détails --}}
                                <a href="{{ route('dashboard.commandes.show', $commande) }}"
                                   class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-2 rounded-lg transition whitespace-nowrap">
                                    Voir détails
                                </a>

                                {{-- Formulaire valider --}}
                                @if(!in_array($commande->status, ['payee', 'annulee']))
                                    <form action="{{ route('dashboard.commandes.update', $commande) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status"
                                                class="text-sm border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                            @if($commande->status == 'en_attente')
                                                <option value="en_attente" selected>En attente</option>
                                                <option value="en_preparation">En préparation</option>
                                                <option value="annulee">Annulée</option>
                                            @elseif($commande->status == 'en_preparation')
                                                <option value="en_preparation" selected>En préparation</option>
                                                <option value="prete">Prête</option>
                                                <option value="annulee">Annulée</option>
                                            @elseif($commande->status == 'prete')
                                                <option value="prete" selected>Prête</option>
                                                <option value="payee">Payée</option>
                                                <option value="annulee">Annulée</option>
                                            @endif
                                        </select>
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-2 rounded-lg transition whitespace-nowrap">
                                            Valider
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm"> <i class="fas fa-minus"></i></span>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400">
                            Aucune commande trouvée.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($commandes->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $commandes->links() }}
            </div>
        @endif
    </div>

@endsection
