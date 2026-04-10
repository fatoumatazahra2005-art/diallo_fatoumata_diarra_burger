<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function index()
    {
        $produits = Menu::paginate(4);
        return view('gallery', compact('produits'));
    }
}
