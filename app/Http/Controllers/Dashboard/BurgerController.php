<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Burger;
use App\Models\Category;
use Illuminate\Http\Request;

class BurgerController extends Controller
{
    public function index()
    {
        $burgers = Burger::with('category')->latest()->paginate(10);
        return view('dashboard.burgers.index', compact('burgers'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.burgers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category_id'  => 'required|exists:categories,id',
            'is_available' => 'boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('burgers', 'public');
        }

        Burger::create($validated);

        return redirect()->route('dashboard.burgers.index')
            ->with('success', 'Burger créé avec succès.');
    }

    public function edit(Burger $burger)
    {
        $categories = Category::all();
        return view('dashboard.burgers.edit', compact('burger', 'categories'));
    }

    public function update(Request $request, Burger $burger)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category_id'  => 'required|exists:categories,id',
            'is_available' => 'boolean',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('burgers', 'public');
        }

        $burger->update($validated);

        return redirect()->route('dashboard.burgers.index')
            ->with('success', 'Burger mis à jour avec succès.');
    }

    public function destroy(Burger $burger)
    {
        if ($burger->image) {
            \Storage::disk('public')->delete($burger->image);
        }

        $burger->delete();

        return redirect()->route('dashboard.burgers.index')
            ->with('success', 'Burger supprimé avec succès.');
    }
}
