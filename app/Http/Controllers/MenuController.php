<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;

class MenuController extends Controller
{


    public function home()
    {
        $burgers = Burger::with('category')
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->take(3)
            ->get();

        return view('home', compact('burgers'));
    }
}
