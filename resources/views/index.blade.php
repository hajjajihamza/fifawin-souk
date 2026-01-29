@extends('layouts.client')

@section('title', 'Home')

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar / Categories -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Categories</h2>
                <div class="space-y-2">
                    <a href="{{ route('home') }}"
                       class="block px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out {{ !request('category') ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
                        All Products
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('home', ['category' => $category->id]) }}"
                           class="block px-4 py-2 rounded-lg text-sm font-medium transition duration-150 ease-in-out {{ request('category') == $category->id ? 'bg-indigo-600 text-white' : 'text-gray-600 hover:bg-gray-50 hover:text-indigo-600' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-3xl font-extrabold text-gray-900">
                    @if(request('category'))
                        {{ $categories->find(request('category'))->name }}
                    @else
                        Discover Everything
                    @endif
                </h1>
                <span class="text-sm text-gray-500 font-medium">Showing {{ $products->count() }} of {{ $products->total() }} products</span>
            </div>

            @if($products->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="mt-4 text-sm font-medium text-gray-900">No products found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your filters.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div
                            class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                            <div class="relative aspect-w-4 aspect-h-3 overflow-hidden bg-gray-200 h-64">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-center object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full bg-indigo-50 text-indigo-200">
                                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 left-4">
                                            <span
                                                class="bg-white/90 backdrop-blur-sm text-indigo-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                                                {{ $product->category->name }}
                                            </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                    </h3>
                                    <span
                                        class="text-2xl font-black text-gray-900">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <p class="text-gray-500 text-sm line-clamp-2 mb-4 leading-relaxed">
                                    {{ $product->note }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span
                                            class="flex h-2 w-2 rounded-full {{ $product->stock > 10 ? 'bg-green-500' : 'bg-amber-500' }} mr-2"></span>
                                        <span class="text-xs font-medium text-gray-500">
                                            {{ $product->stock }} units in stock
                                        </span>
                                    </div>
                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition duration-150 flex items-center group-hover:translate-x-1">
                                        View details
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
