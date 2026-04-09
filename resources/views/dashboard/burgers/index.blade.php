@extends('layouts.dashboard')

@section('title', 'Burgers')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Burgers</h2>
        <a href="{{ route('dashboard.burgers.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition text-sm">
            + Nouveau Burger
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-4">Image</th>
                <th class="px-6 py-4">Nom</th>
                <th class="px-6 py-4">Catégorie</th>
                <th class="px-6 py-4">Prix</th>
                <th class="px-6 py-4">Stock</th>
                <th class="px-6 py-4">Disponible</th>
                <th class="px-6 py-4">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($burgers as $burger)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        @if($burger->image && file_exists(storage_path('app/public/burgers/' . $burger->image)))
                            <img src="{{ asset('storage/burgers/' . $burger->image) }}"
                                 alt="{{ $burger->name }}"
                                 class="w-12 h-12 rounded-lg object-cover">
                        @else
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center text-2xl"><i class="fas fa-hamburger"></i></div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $burger->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $burger->category->name }}</td>
                    <td class="px-6 py-4 font-semibold">{{ number_format($burger->price, 2) }} FCFA</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs {{ $burger->stock <= 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                            {{ $burger->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs {{ $burger->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $burger->is_available ? 'Oui' : 'Non' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">
                        <a href="{{ route('dashboard.burgers.edit', $burger) }}"
                           class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs transition">
                            Modifier
                        </a>
                        <form action="{{ route('dashboard.burgers.destroy', $burger) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer ce burger ?')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs transition">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-10 text-center text-gray-400">Aucun burger trouvé.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if($burgers->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $burgers->links() }}
            </div>
        @endif
    </div>
@endsection
