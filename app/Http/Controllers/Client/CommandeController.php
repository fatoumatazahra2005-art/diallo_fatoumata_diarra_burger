<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class CommandeController extends Controller
{
    public function index()
    {

        $commandes = auth()->user()
            ->commandes()
            ->with('details.burger')
            ->latest()
            ->get();

        return view('client.commandes.index', compact('commandes'));
    }
}
