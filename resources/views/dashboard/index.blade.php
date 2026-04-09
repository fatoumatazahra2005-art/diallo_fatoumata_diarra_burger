@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    {{-- Stats journalières --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-3xl mb-2"><i class="fa-solid fa-burger text-xl text-orange-500"></i></div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalBurgers }}</div>
            <div class="text-sm text-gray-500">Burgers</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-3xl mb-2"><i class="fa-solid fa-calendar-days text-blue-500"></i></div>
            <div class="text-2xl font-bold text-gray-800">{{ $commandesAujourdhui }}</div>
            <div class="text-sm text-gray-500">Commandes aujourd'hui</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-3xl mb-2"><i class="fa-solid fa-check text-green-500"></i></div>
            <div class="text-2xl font-bold text-gray-800">{{ $commandesValidees }}</div>
            <div class="text-sm text-gray-500">Validées aujourd'hui</div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="text-3xl mb-2"><i class="fa-solid fa-coins text-yellow-500"></i></div>
            <div class="text-2xl font-bold text-gray-800">{{ number_format($recettesJour, 0, ',', ' ') }} FCFA</div>
            <div class="text-sm text-gray-500">Recettes du jour</div>
        </div>
    </div>

    {{-- Graphiques --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        {{-- Commandes par mois --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Commandes par mois</h2>
            <canvas id="commandesParMois" height="120"></canvas>
        </div>

        {{-- Produits par catégorie --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Produits vendus par catégorie (ce mois)</h2>
            <canvas id="produitsParCategorie" height="80"></canvas>
        </div>

    </div>

    {{-- Commandes récentes --}}
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Commandes récentes</h2>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Client</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left">Statut</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach($commandesRecentes as $commande)
                <tr>
                    <td class="px-4 py-3">#{{ $commande->id }}</td>
                    <td class="px-4 py-3">{{ $commande->user?->name ?? 'Compte supprimé' }}</td>
                    <td class="px-4 py-3 font-semibold">{{ number_format($commande->total_price, 0, ',', ' ') }} FCFA</td>
                    <td class="px-4 py-3">
                        @php
                            $colors = [
                                'en_attente'     => 'bg-yellow-100 text-yellow-700',
                                'en_preparation' => 'bg-blue-100 text-blue-700',
                                'prete'          => 'bg-green-100 text-green-700',
                                'payee'          => 'bg-indigo-100 text-indigo-700',
                                'annulee'        => 'bg-red-100 text-red-700',
                            ];
                            $labels = [
                                'en_attente'     => 'En attente',
                                'en_preparation' => 'En préparation',
                                'prete'          => 'Prête',
                                'payee'          => 'Payée',
                                'annulee'        => 'Annulée',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs {{ $colors[$commande->status] ?? '' }}">
                            {{ $labels[$commande->status] ?? $commande->status }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Graphique commandes par mois
        new Chart(document.getElementById('commandesParMois'), {
            type: 'bar',
            data: {
                labels: @json($moisLabels),
                datasets: [{
                    label: 'Commandes',
                    data: @json($commandesData),
                    backgroundColor: 'rgba(193, 127, 58, 0.7)',
                    borderColor: 'rgba(193, 127, 58, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });

        // Graphique produits par catégorie
        new Chart(document.getElementById('produitsParCategorie'), {
            type: 'doughnut',
            data: {
                labels: @json($categoriesLabels),
                datasets: [{
                    data: @json($categoriesData),
                    backgroundColor: [
                        'rgba(193, 127, 58, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                    ],
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
@endpush
