@extends('layouts.dashboard')

@section('title', 'Catégories')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Catégories</h2>
        <a href="{{ route('dashboard.categories.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition text-sm">
            + Nouvelle Catégorie
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="px-6 py-4">#</th>
                <th class="px-6 py-4">Nom</th>
                <th class="px-6 py-4">Slug</th>
                <th class="px-6 py-4">Burgers</th>
                <th class="px-6 py-4">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($categories as $category)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-400">{{ $category->id }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs">
                            {{ $category->burgers_count }} burger(s)
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">
                        <a href="{{ route('dashboard.categories.edit', $category) }}"
                           class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs transition">
                            Modifier
                        </a>
                        <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Supprimer cette catégorie ?')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs transition">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-400">Aucune catégorie trouvée.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
