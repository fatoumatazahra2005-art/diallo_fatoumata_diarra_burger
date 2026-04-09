@extends('layouts.dashboard')

@section('title', 'Détail commande #' . $commande->id)

@section('content')

    <div class="flex items-center justify-between mb-6">
        <h4 class="text-xl font-bold text-gray-800">Commande #{{ $commande->id }}</h4>
        <a href="{{ route('dashboard.commandes.index') }}"
           class="text-sm text-indigo-600 hover:underline">← Retour à la liste</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif

    {{-- Infos client --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h5 class="font-semibold text-gray-700 mb-3">Informations client</h5>
        <p><span class="text-gray-500">Nom :</span> {{ $commande->user->name }}</p>
        <p><span class="text-gray-500">Email :</span> {{ $commande->user->email }}</p>
        <p><span class="text-gray-500">Date :</span> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
        <p class="mt-2">
            <span class="text-gray-500">Statut :</span>
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
        </p>
    </div>

    {{-- Articles --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h5 class="font-semibold text-gray-700 mb-3">Articles commandés</h5>
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="px-4 py-2 text-left">Burger</th>
                <th class="px-4 py-2 text-left">Quantité</th>
                <th class="px-4 py-2 text-left">Prix unitaire</th>
                <th class="px-4 py-2 text-left">Sous-total</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($commande->details as $detail)
                <tr>
                    <td class="px-4 py-2">{{ $detail->burger->name }}</td>
                    <td class="px-4 py-2">{{ $detail->quantity }}</td>
                    <td class="px-4 py-2">{{ number_format($detail->unit_price, 0, ',', ' ') }} FCFA</td>
                    <td class="px-4 py-2 font-semibold">{{ number_format($detail->quantity * $detail->unit_price, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" class="px-4 py-2 text-right font-bold">Total</td>
                <td class="px-4 py-2 font-bold text-indigo-700">{{ number_format($commande->total_price, 0, ',', ' ') }} FCFA</td>
            </tr>
            </tfoot>
        </table>
    </div>

    {{-- Statut --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h5 class="font-semibold text-gray-700 mb-3">Modifier le statut</h5>
        @if(!in_array($commande->status, ['payee', 'annulee']))
            <form action="{{ route('dashboard.commandes.update', $commande) }}" method="POST"
                  class="flex items-center gap-3">
                @csrf
                @method('PUT')
                <select name="status"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
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
                        class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Valider
                </button>
            </form>
        @else
            <p class="text-gray-400 text-sm">Cette commande ne peut plus être modifiée.</p>
        @endif
    </div>

    {{-- Paiement --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h5 class="font-semibold text-gray-700 mb-3">Paiement</h5>

        @if($commande->paiement)
            {{-- Paiement déjà enregistré --}}
            <div class="flex items-center gap-3 text-green-700 bg-green-50 rounded-lg p-4">
                <i class="fa-solid fa-circle-check text-xl"></i>
                <div>
                    <p class="font-semibold">Paiement enregistré</p>
                    <p class="text-sm text-gray-500">
                        {{ number_format($commande->paiement->amount, 0, ',', ' ') }} FCFA —
                        {{ ucfirst($commande->paiement->method) }} —
                        {{ \Carbon\Carbon::parse($commande->paiement->paid_at)->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
        @elseif($commande->status === 'prete')
            {{-- Formulaire enregistrement paiement --}}
            <form action="{{ route('dashboard.paiements.store') }}" method="POST"
                  class="flex items-center gap-3">
                @csrf
                <input type="hidden" name="commande_id" value="{{ $commande->id }}">
                <div class="text-gray-700 font-semibold">
                    Montant : {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA
                </div>
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg transition">
                    Enregistrer le paiement
                </button>
            </form>
        @else
            <p class="text-gray-400 text-sm">Le paiement sera disponible quand la commande sera prête.</p>
        @endif
    </div>

@endsection
