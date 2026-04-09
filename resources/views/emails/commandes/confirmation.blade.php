@component('mail::message')
    # Commande confirmée !

    Bonjour **{{ $commande->user->name }}**,

    Votre commande **#{{ $commande->id }}** a bien été reçue.

    @component('mail::table')
        | Burger | Qté | Prix |
        |:-------|:----|-----:|
        @foreach($commande->details as $detail)
            | {{ $detail->burger->nom }} | {{ $detail->quantity }} | {{ number_format($detail->unit_price, 0, ',', ' ') }} FCFA |
        @endforeach
    @endcomponent

    **Total : {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA**

    Merci pour votre confiance !

    {{ config('app.name') }}
@endcomponent
