<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Burger;
use App\Models\Commande;
use App\Models\DetailsCommande;
use App\Mail\CommandeConfirmationMail;
use App\Mail\NouvelleCommandeManagerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommandeClientController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['details.burger', 'paiement'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('client.commandes.index', compact('commandes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'burgers'            => 'required|array|min:1',
            'burgers.*.id'       => 'required|exists:burgers,id',
            'burgers.*.quantity' => 'required|integer|min:1',
        ]);

        // Vérifier le stock de chaque burger
        foreach ($validated['burgers'] as $item) {
            $burger = Burger::findOrFail($item['id']);

            if (!$burger->is_available || $burger->stock < $item['quantity']) {
                return redirect()->back()
                    ->with('error', "Le burger {$burger->name} n'est pas disponible en quantité suffisante.");
            }
        }

        // Créer la commande
        $commande = Commande::create([
            'user_id'     => auth()->id(),
            'status'      => 'en_attente',
            'total_price' => 0,
        ]);

        $total = 0;

        // Créer les détails
        foreach ($validated['burgers'] as $item) {
            $burger = Burger::findOrFail($item['id']);

            DetailsCommande::create([
                'commande_id' => $commande->id,
                'burger_id'   => $burger->id,
                'quantity'    => $item['quantity'],
                'unit_price'  => $burger->price,
            ]);

            $burger->decrement('stock', $item['quantity']);
            $total += $burger->price * $item['quantity'];
        }

        // Mettre à jour le total
        $commande->update(['total_price' => $total]);

        // Recharger la commande avec ses relations pour les emails
        $commande->load(['user', 'details.burger']);

        // Email confirmation au client
        Mail::to($commande->user->email)
            ->send(new CommandeConfirmationMail($commande));

        // Notification au gestionnaire
        Mail::to(config('mail.manager_email'))
            ->send(new NouvelleCommandeManagerMail($commande));

        return redirect()->route('client.commandes.index')
            ->with('success', 'Commande passée avec succès.');
    }

    public function show(Commande $commande)
    {
        if ($commande->user_id !== auth()->id()) {
            abort(403);
        }

        $commande->load(['details.burger', 'paiement']);
        return view('client.commandes.show', compact('commande'));
    }
}
