<?php

namespace App\Http\Controllers;

use App\Models\Burger;
use App\Models\Category;

class BurgerPublicController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $burgers = Burger::with('category')
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->when(request('search'), fn($q) => $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(request('search')) . '%']))
            ->when(request('category'), fn($q) => $q->where('category_id', request('category')))
            ->when(request('prix'), function ($q) {
                if (request('prix') === 'asc')  return $q->orderBy('price', 'asc');
                if (request('prix') === 'desc') return $q->orderBy('price', 'desc');
            })
            ->get();

        return view('burgers.index', compact('burgers', 'categories'));
    }
}
