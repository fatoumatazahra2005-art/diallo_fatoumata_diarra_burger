<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuProposController extends Controller
{
    public function index()
    {
        $menus = Menu::all(); // récupère tous les menus
        return view('menu', compact('menus')); // transmet $menus à la vue
    }
}
