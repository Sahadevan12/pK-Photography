{{-- resources/views/shop/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Shop')

@section('content')

<section class="relative py-24 overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 40% 50%, rgba(212,160,23,0.1) 0%, transparent 60%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#D4A017;">Photo Products</p>
        <h1 class="text-5xl font-serif font-bold text-white mb-6">Our Shop</h1>
        <div class="gold-divider mb-4"></div>
        <p class="text-gray-300">Premium personalized photo products delivered to your door</p>
    </div>
</section>

<section class="py-16 bg-brand-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filters & Search Bar --}}
        <form method="GET" action="{{ route('shop.index') }}"
              class="flex flex-col md:flex-row gap-4 mb-12 p-5 bg-white rounded-2xl shadow-sm">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-100 focus:outline-none text-sm"
                       onfocus="this.style.borderColor='#B8860B'"
                       onblur="this.style.borderColor=''"
                       placeholder="Search products..."/>
            </div>

            {{-- Category Filter --}}
            <select name="category"
                    class="px-4 py-3 rounded-xl border-2 border-gray-100 focus:outline-none text-sm bg-white min-w-[180px]"
                    onfocus="this.style.borderColor='#B8860B'"
                    onblur="this.style.borderColor=''">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            {{-- Sort --}}
            <select name="sort"
                    class="px-4 py-3 rounded-xl border-2 border-gray-100 focus:outline-none text-sm bg-white min-w-[160px]"
                    onfocus="this.style.borderColor='#B8860B'"
                    onblur="this.style.borderColor=''">
                <option value="">Latest First</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>

            <button type="submit" class="btn-gold px-7">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filter
            </button>
        </form>

        {{-- Category Tabs --}}
        <div class="flex flex-wrap gap-3 mb-10">
            <a href="{{ route('shop.index') }}"
               class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ !request('category') ? 'text-white' : 'text-gray-600 bg-white border border-gray-200 hover:border-gold hover:text-gold' }}"
               style="{{ !request('category') ? 'background: linear-gradient(135deg, #7B5A00, #D4A017);' : '' }}">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('shop.index', ['category' => $cat->slug]) }}"
                   class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ request('category') === $cat->slug ? 'text-white' : 'text-gray-600 bg-white border border-gray-200 hover:border-gold hover:text-gold' }}"
                   style="{{ request('category') === $cat->slug ? 'background: linear-gradient(135deg, #7B5A00, #D4A017);' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        {{-- Results Count --}}
        <p class="text-sm text-gray-500 mb-8">
            Showing <span class="font-semibold text-navy">{{ $products->total() }}</span> products
            @if(request('category')) in <span class="font-semibold" style="color:#B8860B;">{{ request('category') }}</span> @endif
        </p>

        {{-- Products Grid --}}
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl overflow-hidden shadow-md card-hover">

                        {{-- Product Image --}}
                        <a href="{{ route('shop.show', $product->slug) }}"
                           class="relative block overflow-hidden" style="aspect-ratio: 1;">
                            <img src="{{ asset('storage/' . $product->main_image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='https://via.placeholder.com/400x400/0F172A/D4A017?text=PK+Photo'"/>

                            {{-- Badges --}}
                            <div class="absolute top-3 left-3 flex flex-col gap-2">
                                @if($product->sale_price)
                                    <span class="text-xs font-bold px-2.5 py-1 rounded-full text-white"
                                          style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                        -{{ $product->discount_percent }}%
                                    </span>
                                @endif
                                @if($product->allow_custom_image)
                                    <span class="text-xs font-medium px-2 py-1 rounded-full"
                                          style="background: rgba(15,23,42,0.85); color: #D4A017;">
                                        📸 Custom
                                    </span>
                                @endif
                            </div>

                            {{-- Hover Overlay --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                        flex items-center justify-center"
                                 style="background: rgba(11,17,32,0.4);">
                                <span class="px-6 py-2.5 rounded-full text-sm font-semibold text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                      style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                    Quick View
                                </span>
                            </div>
                        </a>

                        {{-- Product Info --}}
                        <div class="p-5">
                            <p class="text-xs font-medium uppercase tracking-wider mb-1" style="color:#B8860B;">
                                {{ $product->category->name }}
                            </p>
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <h3 class="font-semibold text-navy text-sm mb-1 group-hover:text-gold transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            @if($product->short_description)
                                <p class="text-xs text-gray-400 mb-3 line-clamp-2">{{ $product->short_description }}</p>
                            @endif

                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <span class="text-lg font-bold" style="color:#B8860B;">
                                        ₹{{ number_format($product->current_price, 0) }}
                                    </span>
                                    @if($product->sale_price)
                                        <span class="text-sm text-gray-400 line-through ml-1.5">
                                            ₹{{ number_format($product->price, 0) }}
                                        </span>
                                    @endif
                                </div>
                                @if($product->stock > 0)
                                    <span class="text-xs text-green-600 font-medium">✓ In Stock</span>
                                @else
                                    <span class="text-xs text-red-500 font-medium">Out of Stock</span>
                                @endif
                            </div>

                            <a href="{{ route('shop.show', $product->slug) }}"
                               class="block w-full text-center py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 hover:opacity-90"
                               style="background: linear-gradient(135deg, #0B1120, #1E293B); color: white;">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-14">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-8xl mb-6">🛍️</div>
                <h3 class="text-2xl font-serif font-bold text-navy mb-3">No Products Found</h3>
                <p class="text-gray-500 mb-6">Try adjusting your filters or search term.</p>
                <a href="{{ route('shop.index') }}" class="btn-gold">Clear Filters</a>
            </div>
        @endif
    </div>
</section>

@endsection