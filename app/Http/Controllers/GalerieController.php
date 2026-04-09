<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function index()
    {
        $produits = Menu::paginate(4); // récupère tous les produits pour la galerie
        return view('gallery', compact('produits'));
    }
}
