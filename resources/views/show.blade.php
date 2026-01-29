@extends('layouts.client')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-indigo-600 inline-flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('home', ['category' => $product->category_id]) }}" class="ml-1 text-gray-500 hover:text-indigo-600 md:ml-2">
                        {{ $product->category->name }}
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-gray-400 font-semibold md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 mb-16">
        <div class="flex flex-col lg:flex-row">
            <!-- Product Image -->
            <div class="lg:w-1/2 p-8 lg:p-12 bg-gray-50 flex items-center justify-center">
                <div class="relative w-full aspect-square rounded-2xl overflow-hidden shadow-2xl group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center h-full bg-indigo-50 text-indigo-200">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Details -->
            <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                <div class="mb-6">
                    <span class="bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4 inline-block">
                        {{ $product->category->name }}
                    </span>
                    <h1 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4 tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="text-3xl font-black text-indigo-600">${{ number_format($product->price, 2) }}</span>
                        <div class="h-6 w-px bg-gray-200"></div>
                        <span class="text-sm font-medium {{ $product->stock > 10 ? 'text-green-600' : 'text-amber-500' }}">
                            {{ $product->stock }} units in stock
                        </span>
                    </div>
                </div>

                <div class="prose prose-indigo max-w-none text-gray-600 mb-10 leading-relaxed">
                    <p>{{ $product->note }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-10">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Reference</span>
                        <span class="font-mono text-gray-900 font-semibold">{{ $product->reference }}</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Created At</span>
                        <span class="text-gray-900 font-semibold">{{ $product->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mb-16">
            <h2 class="text-3xl font-black text-gray-900 mb-8 tracking-tight">You might also like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                        <div class="relative aspect-[4/3] overflow-hidden bg-gray-200">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-center object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="flex items-center justify-center h-full bg-indigo-50 text-indigo-200">
                                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 truncate">
                                <a href="{{ route('products.show', $related->id) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ $related->name }}
                                </a>
                            </h3>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-black text-indigo-600">${{ number_format($related->price, 2) }}</span>
                                <a href="{{ route('products.show', $related->id) }}" class="p-2 bg-gray-50 text-gray-400 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
