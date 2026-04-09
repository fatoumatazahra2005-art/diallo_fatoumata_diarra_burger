<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class ManagerOrderController extends Controller
{
    public function index()
    {
        $orders = Commande::with(['user', 'items.burger'])
            ->latest()
            ->get();

        return view('dashboard.commandes.index', compact('orders'));
    }

    public function updateStatus(Request $request, Commande $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,preparing,ready,paid,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour.');
    }
}
