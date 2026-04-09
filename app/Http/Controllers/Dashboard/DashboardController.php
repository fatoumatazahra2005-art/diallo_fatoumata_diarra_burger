<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Burger;
use App\Models\Commande;
use App\Models\DetailsCommande;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats journalières
        $totalBurgers        = Burger::count();
        $commandesAujourdhui = Commande::whereDate('created_at', today())
            ->whereNotIn('status', ['annulee'])
            ->count();
        $commandesValidees   = Commande::whereDate('created_at', today())
            ->where('status', 'payee')
            ->count();
        $recettesJour        = Paiement::whereDate('paid_at', today())
            ->sum('amount');
        $commandesRecentes   = Commande::with('user')->latest()->take(5)->get();

        // Nombre de commandes par mois (année en cours)
        $commandesParMois = Commande::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as mois'),
            DB::raw('EXTRACT(YEAR FROM created_at) as annee'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('annee', 'mois')
            ->orderBy('mois')
            ->get();

        $moisLabels    = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        $commandesData = array_fill(0, 12, 0);
        foreach ($commandesParMois as $item) {
            $commandesData[(int)$item->mois - 1] = $item->total;
        }

        // Produits vendus par catégorie ce mois-ci
        $produitsParCategorie = DetailsCommande::select(
            'categories.name as categorie',
            DB::raw('SUM(details_commandes.quantity) as total')
        )
            ->join('burgers', 'details_commandes.burger_id', '=', 'burgers.id')
            ->join('categories', 'burgers.category_id', '=', 'categories.id')
            ->join('commandes', 'details_commandes.commande_id', '=', 'commandes.id')
            ->whereRaw('EXTRACT(MONTH FROM commandes.created_at) = ?', [now()->month])
            ->whereRaw('EXTRACT(YEAR FROM commandes.created_at) = ?', [now()->year])
            ->groupBy('categories.name')
            ->get();

        $categoriesLabels = $produitsParCategorie->pluck('categorie')->toArray();
        $categoriesData   = $produitsParCategorie->pluck('total')->toArray();

        return view('dashboard.index', compact(
            'totalBurgers',
            'commandesAujourdhui',
            'commandesValidees',
            'recettesJour',
            'commandesRecentes',
            'moisLabels',
            'commandesData',
            'categoriesLabels',
            'categoriesData'
        ));
    }
}
