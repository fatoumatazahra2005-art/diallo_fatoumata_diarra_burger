@extends('layouts.dashboard')

@section('title', 'Paiements')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-xl font-bold text-gray-800">Historique des paiements</h4>
        <span class="bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full">
            {{ $paiements->total() }} paiement(s)
        </span>
    </div>

    {{-- Stats rapides --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-sm text-gray-500 mb-1">Recettes aujourd'hui</div>
            <div class="text-2xl font-bold text-gray-800">{{ number_format($totalJour, 0, ',', ' ') }} FCFA</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-sm text-gray-500 mb-1">Recettes ce mois</div>
            <div class="text-2xl font-bold text-gray-800">{{ number_format($totalMois, 0, ',', ' ') }} FCFA</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-sm text-gray-500 mb-1">Total général</div>
            <div class="text-2xl font-bold text-gray-800">{{ number_format($totalGeneral, 0, ',', ' ') }} FCFA</div>
        </div>
    </div>

    {{-- Tableau historique --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Commande</th>
                    <th class="px-4 py-3 text-left">Montant</th>
                    <th class="px-4 py-3 text-left">Méthode</th>
                    <th class="px-4 py-3 text-left">Enregistré par</th>
                    <th class="px-4 py-3 text-left">Date</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @forelse($paiements as $paiement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">#{{ $paiement->id }}</td>

                        <td class="px-4 py-3">
                            <div class="font-semibold">{{ $paiement->commande->user->name }}</div>
                            <div class="text-xs text-gray-400">{{ $paiement->commande->user->email }}</div>
                        </td>

                        <td class="px-4 py-3">
                            <a href="{{ route('dashboard.commandes.show', $paiement->commande) }}"
                               class="text-indigo-600 hover:underline font-medium">
                                #{{ $paiement->commande_id }}
                            </a>
                        </td>

                        <td class="px-4 py-3 font-bold text-green-700">
                            {{ number_format($paiement->amount, 0, ',', ' ') }} FCFA
                        </td>

                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                {{ ucfirst($paiement->method) }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            {{ $paiement->gestionnaire->name ?? '—' }}
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($paiement->paid_at)->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400">
                            Aucun paiement enregistré.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($paiements->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $paiements->links() }}
            </div>
        @endif
    </div>

@endsection
