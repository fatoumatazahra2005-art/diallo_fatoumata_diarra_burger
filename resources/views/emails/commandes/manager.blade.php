<x-mail::message>
    # Nouvelle commande reçue

    Une nouvelle commande **#{{ $commande->id }}** vient d'être passée par **{{ $commande->user->name }}**.

    **Total : {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA**

    <x-mail::button :url="url('/dashboard/commandes/' . $commande->id)">
        Voir la commande
    </x-mail::button>

    {{ config('app.name') }}
</x-mail::message>
