@extends('layouts.dashboard')

@section('title', 'Nouvelle Catégorie')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Nouvelle Catégorie</h2>
        <a href="{{ route('dashboard.categories.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 max-w-lg">
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>
            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg text-sm transition">
                    Créer
                </button>
                <a href="{{ route('dashboard.categories.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg text-sm transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
