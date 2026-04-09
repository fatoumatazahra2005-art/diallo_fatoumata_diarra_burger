<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Mail\CommandePreteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['user', 'details.burger', 'paiement'])
            ->latest()
            ->paginate(10);

        return view('dashboard.commandes.index', compact('commandes'));
    }

    public function show(Commande $commande)
    {
        $commande->load(['user', 'details.burger', 'paiement']);
        return view('dashboard.commandes.show', compact('commande'));
    }

    public function update(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'status' => 'required|in:en_attente,en_preparation,prete,payee,annulee',
        ]);

        if (in_array($commande->status, ['payee', 'annulee'])) {
            return back()->with('error', 'Impossible de modifier une commande payée ou annulée.');
        }

        // Ordre logique des statuts
        $ordre = [
            'en_attente'     => 1,
            'en_preparation' => 2,
            'prete'          => 3,
            'payee'          => 4,
            'annulee'        => 5,
        ];

        $statusActuel  = $ordre[$commande->status] ?? 0;
        $nouveauStatus = $ordre[$validated['status']] ?? 0;


        if ($nouveauStatus < $statusActuel && $validated['status'] !== 'annulee') {
            return back()->with('error', 'Impossible de revenir à un statut précédent.');
        }

        $oldStatus = $commande->status;
        $commande->update($validated);

        // Envoyer facture PDF quand statut passe à "prete"
        if ($validated['status'] === 'prete' && $oldStatus !== 'prete') {
            $commande->load(['user', 'details.burger']);
            Mail::to($commande->user->email)->send(new CommandePreteMail($commande));
        }

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(Commande $commande)
    {
        if (in_array($commande->status, ['payee'])) {
            return redirect()->back()
                ->with('error', 'Impossible d\'annuler une commande déjà payée.');
        }

        $commande->update(['status' => 'annulee']);

        return redirect()->route('dashboard.commandes.index')
            ->with('success', 'Commande annulée avec succès.');
    }
}
