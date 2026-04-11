<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with(['commande.user', 'gestionnaire'])
            ->latest()
            ->paginate(10);

        $totalJour    = Paiement::whereDate('paid_at', today())->sum('amount');
        $totalMois    = Paiement::whereRaw('EXTRACT(MONTH FROM paid_at) = ?', [now()->month])
            ->whereRaw('EXTRACT(YEAR FROM paid_at) = ?', [now()->year])
            ->sum('amount');
        $totalGeneral = Paiement::sum('amount');

        return view('dashboard.paiements.index', compact(
            'paiements',
            'totalJour',
            'totalMois',
            'totalGeneral'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'commande_id' => 'required|exists:commandes,id',
        ]);

        $commande = Commande::findOrFail($validated['commande_id']);

        if ($commande->isPaid()) {
            return redirect()->back()
                ->with('error', 'Cette commande est déjà payée.');
        }

        if ($commande->status !== 'prete') {
            return redirect()->back()
                ->with('error', 'La commande doit être prête avant le paiement.');
        }

        Paiement::create([
            'commande_id'     => $commande->id,
            'gestionnaire_id' => auth()->id(),
            'amount'          => $commande->total_price,
            'method'          => 'especes',
            'paid_at'         => now(),
        ]);

        $commande->update(['status' => 'payee']);


        $commande->load(['details.burger']);

        foreach ($commande->details as $detail) {
            if ($detail->burger) {
                $detail->burger->decrement('stock', $detail->quantity);
            }
        }

        return redirect()->route('dashboard.commandes.show', $commande)
            ->with('success', 'Paiement enregistré avec succès.');
    }

    public function show(Paiement $paiement)
    {
        $paiement->load(['commande.details.burger', 'commande.user', 'gestionnaire']);
        return view('dashboard.paiements.show', compact('paiement'));
    }
}
