@component('mail::message')
    # Votre commande est prête !

    Bonjour **{{ $commande->user->name }}**,

    Votre commande **#{{ $commande->id }}** est prête. Veuillez trouver votre facture en pièce jointe.

    **Total : {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA**

    À tout de suite !

    {{ config('app.name') }}
@endcomponent
