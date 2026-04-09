<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        h1   { color: #e85d04; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th   { background: #e85d04; color: white; padding: 8px; text-align: left; }
        td   { padding: 8px; border-bottom: 1px solid #eee; }
        .total { font-weight: bold; font-size: 15px; text-align: right; margin-top: 10px; }
    </style>
</head>
<body>
<h1>ISI Burger — Facture</h1>
<p><strong>Commande :</strong> #{{ $commande->id }}</p>
<p><strong>Client :</strong> {{ $commande->user->name }}</p>
<p><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>

<table>
    <thead>
    <tr>
        <th>Burger</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Sous-total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($commande->details as $detail)
        <tr>
            <td>{{ $detail->burger->nom }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->unit_price, 0, ',', ' ') }} FCFA</td>
            <td>{{ number_format($detail->quantity * $detail->unit_price, 0, ',', ' ') }} FCFA</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="total">Total : {{ number_format($commande->total_price, 0, ',', ' ') }} FCFA</div>
</body>
</html>
