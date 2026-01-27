@extends('layouts.admin')

@section('title', 'Modifier la Catégorie')
@section('page-title', 'Édition : ' . $category->name)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('categories.update', $category) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="name" class="text-sm font-semibold text-gray-700">Nom de la catégorie</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('name') border-red-500 @enderror"
                        placeholder="Ex: Électronique, Vêtements, etc.">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="description" class="text-sm font-semibold text-gray-700">Description (Optionnel)</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all @error('description') border-red-500 @enderror"
                        placeholder="Décrivez brièvement cette catégorie...">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center justify-end space-x-4 border-t border-gray-100">
                    <a href="{{ route('categories.index') }}"
                        class="px-6 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors font-medium">
                        Annuler
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium shadow-sm shadow-blue-200">
                        Mettre à jour la catégorie
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection