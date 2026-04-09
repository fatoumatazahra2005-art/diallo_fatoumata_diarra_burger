<?php

namespace App\Http\Controllers;

use App\Mail\CommandeConfirmationMail;
use App\Mail\NouvelleCommandeManagerMail;
use App\Models\Commande;
use App\Models\DetailsCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Connectez-vous pour commander'], 401);
        }

        $panier = $request->input('panier');

        if (empty($panier)) {
            return response()->json(['message' => 'Votre panier est vide'], 400);
        }

        $total = 0;
        foreach ($panier as $article) {
            $total += $article['prix'] * $article['quantite'];
        }

        $commande = Commande::create([
            'user_id'     => auth()->id(),
            'status'      => Commande::STATUS_EN_ATTENTE,
            'total_price' => $total,
            'notes'       => $request->input('notes', ''),
        ]);

        foreach ($panier as $article) {
            DetailsCommande::create([
                'commande_id' => $commande->id,
                'burger_id'   => $article['id'],
                'quantity'    => $article['quantite'],
                'unit_price'  => $article['prix'],
            ]);
        }

        $commande->load(['details.burger', 'user']);

        // Email confirmation au client
        try {
            Mail::to($commande->user->email)
                ->send(new CommandeConfirmationMail($commande));
            Log::info('Email confirmation envoyé à ' . $commande->user->email);
        } catch (\Exception $e) {
            Log::error('Erreur email confirmation : ' . $e->getMessage());
        }

        // Notification au gestionnaire
        try {
            Mail::to(config('mail.manager_email'))
                ->send(new NouvelleCommandeManagerMail($commande));
            Log::info('Email gestionnaire envoyé à ' . config('mail.manager_email'));
        } catch (\Exception $e) {
            Log::error('Erreur email gestionnaire : ' . $e->getMessage());
        }

        return response()->json([
            'message'     => 'Commande passée avec succès !',
            'commande_id' => $commande->id,
        ]);
    }
}
