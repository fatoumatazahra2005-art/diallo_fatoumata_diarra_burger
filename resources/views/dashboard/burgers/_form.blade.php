@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
        <input type="text" name="name"
               value="{{ old('name', $burger->name ?? '') }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (FCFA)</label>
        <input type="number" name="price" step="0.01"
               value="{{ old('price', $burger->price ?? '') }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
        <input type="number" name="stock"
               value="{{ old('stock', $burger->stock ?? 0) }}"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
        <select name="category_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            <option value="">-- Choisir --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $burger->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">{{ old('description', $burger->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
        @isset($burger->image)
            <img src="{{ asset('storage/' . $burger->image) }}"
                 class="w-16 h-16 rounded-lg object-cover mb-2">
        @endisset
        <input type="file" name="image"
               class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm">
    </div>

    <div class="flex items-center mt-6">
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_available" value="1"
                   {{ old('is_available', $burger->is_available ?? true) ? 'checked' : '' }}
                   class="w-4 h-4 accent-orange-500">
            <span class="text-sm font-medium text-gray-700">Disponible</span>
        </label>
    </div>
</div>
