@extends('layouts.admin')

@section('title', 'Liste des Produits')
@section('page-title', 'Produits')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50/50">
        <h3 class="text-lg font-semibold text-gray-800">Tous les produits</h3>
        <div class="flex space-x-3">
            <a href="{{ route('products.archived') }}" class="inline-flex items-center px-4 py-2 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg hover:bg-amber-100 transition-colors text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Voir l'archive
            </a>
            <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium shadow-sm shadow-blue-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nouveau Produit
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold">Produit</th>
                    <th class="px-6 py-4 font-semibold">Référence</th>
                    <th class="px-6 py-4 font-semibold">Catégorie</th>
                    <th class="px-6 py-4 font-semibold">Prix</th>
                    <th class="px-6 py-4 font-semibold">Stock</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-10 h-10 rounded-lg object-cover mr-3 border border-gray-100" alt="{{ $product->name }}">
                            @else
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mr-3 border border-gray-100">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <span class="font-medium text-gray-900">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $product->reference }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded-md text-xs font-medium">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-900 font-semibold">{{ number_format($product->price, 2) }} DH</td>
                    <td class="px-6 py-4">
                        @if($product->stock <= 5)
                            <span class="text-red-600 font-medium text-sm flex items-center">
                                <span class="w-2 h-2 bg-red-600 rounded-full mr-2"></span>
                                {{ $product->stock }} (Critique)
                            </span>
                        @else
                            <span class="text-gray-600 text-sm">{{ $product->stock }} en stock</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('products.edit', $product) }}" class="inline-flex p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Modifier">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Êtes-vous sûr de vouloir archiver ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Archiver">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <span class="text-lg font-medium">Aucun produit trouvé</span>
                            <a href="{{ route('products.create') }}" class="mt-2 text-blue-600 hover:underline">Créer votre premier produit</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <td colspan="6" class="px-6 py-4">
                        {{ $products->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
