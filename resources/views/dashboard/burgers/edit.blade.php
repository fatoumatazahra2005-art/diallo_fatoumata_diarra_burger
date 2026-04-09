@extends('layouts.dashboard')

@section('title', 'Modifier Burger')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Modifier — {{ $burger->name }}</h2>
        <a href="{{ route('dashboard.burgers.index') }}"
           class="text-sm text-gray-500 hover:text-gray-700"><i class="fas fa-arrow-left"></i> Retour</a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <form action="{{ route('dashboard.burgers.update', $burger) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('dashboard.burgers._form')
            <div class="mt-6 flex gap-3">
                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg text-sm transition">
                    Mettre à jour
                </button>
                <a href="{{ route('dashboard.burgers.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg text-sm transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
