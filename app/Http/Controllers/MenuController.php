<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $burgers = Burger::with('category')
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
            ->when(request('search'), fn($q) => $q->where('name', 'like', '%'.request('search').'%'))
            ->when(request('prix'), function($q) {
                if (request('prix') === 'asc') return $q->orderBy('price', 'asc');
                if (request('prix') === 'desc') return $q->orderBy('price', 'desc');
            })
            ->get();

        return view('menu', compact('burgers', 'categories'));
    }

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
