@extends('layouts.admin')

@section('title', 'Nouveau Produit')
@section('page-title', 'Créer un Produit')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-gray-700">Nom du produit</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('name') border-red-500 @enderror"
                        placeholder="Ex: iPhone 15 Pro">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Référence -->
                <div class="space-y-2">
                    <label for="reference" class="text-sm font-semibold text-gray-700">Référence (SKU)</label>
                    <input type="text" name="reference" id="reference" value="{{ old('reference') }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('reference') border-red-500 @enderror"
                        placeholder="Ex: IP15P-256-BLK">
                    @error('reference') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Catégorie -->
                <div class="space-y-2">
                    <label for="category_id" class="text-sm font-semibold text-gray-700">Catégorie</label>
                    <select name="category_id" id="category_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('category_id') border-red-500 @enderror">
                        <option value="">Sélectionnez une catégorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Prix -->
                <div class="space-y-2">
                    <label for="price" class="text-sm font-semibold text-gray-700">Prix (DH)</label>
                    <div class="relative">
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" 
                            class="w-full pl-4 pr-12 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('price') border-red-500 @enderror"
                            placeholder="0.00">
                        <span class="absolute right-4 top-2 text-gray-400 font-medium">DH</span>
                    </div>
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Stock -->
                <div class="space-y-2">
                    <label for="stock" class="text-sm font-semibold text-gray-700">Stock Initial</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('stock') border-red-500 @enderror">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Image -->
                <div class="space-y-2">
                    <label for="image" class="text-sm font-semibold text-gray-700">Image du produit</label>
                    <input type="file" name="image" id="image" 
                        class="w-full px-4 py-1.5 border border-gray-300 rounded-lg file:mr-4 file:py-1 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all @error('image') border-red-500 @enderror">
                    @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="note" class="text-sm font-semibold text-gray-700">Description / Notes</label>
                <textarea name="note" id="note" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('note') border-red-500 @enderror"
                    placeholder="Informations supplémentaires sur le produit...">{{ old('note') }}</textarea>
                @error('note') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 flex items-center justify-end space-x-4 border-t border-gray-100">
                <a href="{{ route('products.index') }}" class="px-6 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-medium">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm shadow-blue-200">
                    Enregistrer le produit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
