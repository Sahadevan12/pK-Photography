{{-- resources/views/shop/show.blade.php --}}
@extends('layouts.app')
@section('title', $product->name)

@section('content')

<div class="py-16 bg-brand-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-10">
            <a href="{{ route('home') }}" class="hover:text-gold transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-gold transition-colors">Shop</a>
            <span>/</span>
            <span class="font-medium text-navy">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 mb-20">

            {{-- Product Images --}}
            <div x-data="{ mainImage: '{{ asset('storage/' . $product->main_image) }}' }">
                {{-- Main Image --}}
                <div class="relative rounded-3xl overflow-hidden shadow-xl mb-4" style="aspect-ratio: 1;">
                    <img :src="mainImage"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                         onerror="this.src='https://via.placeholder.com/600x600/0F172A/D4A017?text=PK+Photo'"/>
                    @if($product->sale_price)
                        <div class="absolute top-4 left-4 px-4 py-2 rounded-full text-white font-bold text-sm"
                             style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                            🔥 -{{ $product->discount_percent }}% OFF
                        </div>
                    @endif
                </div>

                {{-- Gallery Thumbnails --}}
                @if($product->gallery_images)
                    <div class="flex gap-3 overflow-x-auto py-2">
                        <button @click="mainImage = '{{ asset('storage/' . $product->main_image) }}'"
                                class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition-all"
                                :class="mainImage === '{{ asset('storage/' . $product->main_image) }}' ? 'border-gold' : 'border-transparent'"
                                style="border-color: #B8860B;">
                            <img src="{{ asset('storage/' . $product->main_image) }}" class="w-full h-full object-cover"/>
                        </button>
                        @foreach($product->gallery_images as $gallery)
                            <button @click="mainImage = '{{ asset('storage/' . $gallery) }}'"
                                    class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition-all"
                                    :class="mainImage === '{{ asset('storage/' . $gallery) }}' ? '' : 'border-transparent'"
                                    style=":class dynamic border">
                                <img src="{{ asset('storage/' . $gallery) }}" class="w-full h-full object-cover"/>
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Product Details --}}
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest mb-2" style="color:#B8860B;">
                    {{ $product->category->name }}
                </p>
                <h1 class="text-3xl md:text-4xl font-serif font-bold text-navy mb-4">{{ $product->name }}</h1>

                {{-- Price --}}
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-3xl font-bold" style="color:#B8860B;">
                        ₹{{ number_format($product->current_price, 2) }}
                    </span>
                    @if($product->sale_price)
                        <span class="text-xl text-gray-400 line-through">
                            ₹{{ number_format($product->price, 2) }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-sm font-bold text-white"
                              style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                            Save ₹{{ number_format($product->price - $product->sale_price, 0) }}
                        </span>
                    @endif
                </div>

                {{-- Short Description --}}
                @if($product->short_description)
                    <p class="text-gray-600 leading-relaxed mb-6">{{ $product->short_description }}</p>
                @endif

                <div class="h-px mb-6" style="background: linear-gradient(90deg, rgba(184,134,11,0.3), transparent);"></div>

                {{-- Add to Cart Form --}}
                <form action="{{ route('cart.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>

                    {{-- Quantity --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-navy mb-2">Quantity</label>
                        <div class="flex items-center gap-3"
                             x-data="{ qty: 1 }">
                            <button type="button" @click="qty = Math.max(1, qty - 1)"
                                    class="w-10 h-10 rounded-full border-2 flex items-center justify-center font-bold text-navy transition-all hover:border-gold"
                                    style="border-color: #e5e7eb;">
                                −
                            </button>
                            <input type="number" name="quantity" :value="qty" x-model="qty"
                                   min="1" max="10"
                                   class="w-16 text-center py-2 rounded-xl border-2 border-gray-200 font-semibold text-sm focus:outline-none"
                                   onfocus="this.style.borderColor='#B8860B'"
                                   onblur="this.style.borderColor=''"/>
                            <button type="button" @click="qty = Math.min(10, qty + 1)"
                                    class="w-10 h-10 rounded-full border-2 flex items-center justify-center font-bold text-navy transition-all hover:border-gold"
                                    style="border-color: #e5e7eb;">
                                +
                            </button>
                        </div>
                    </div>

                    {{-- Custom Image Upload --}}
                    @if($product->allow_custom_image)
                        <div class="mb-6 p-5 rounded-2xl"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.05), rgba(212,160,23,0.08)); border: 1px dashed rgba(184,134,11,0.4);">
                            <label class="block text-sm font-semibold text-navy mb-2">
                                📸 {{ $product->custom_image_label ?? 'Upload Your Photo' }}
                                <span class="text-xs text-gray-500 font-normal ml-1">(Optional)</span>
                            </label>
                            <input type="file" name="custom_image" accept="image/*"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:text-white transition-all"
                                   style="file:background: linear-gradient(135deg, #7B5A00, #D4A017);"/>
                            <p class="text-xs text-gray-400 mt-2">JPG, PNG, WEBP up to 5MB. We'll print your photo on this product.</p>
                        </div>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex gap-4">
                        <button type="submit" class="btn-gold flex-1 justify-center py-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Add to Cart
                        </button>
                        <a href="{{ route('cart.index') }}"
                           class="btn-outline-gold flex-1 text-center justify-center">
                            View Cart
                        </a>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        @foreach([
                            ['icon' => '🚚', 'label' => 'Free Delivery', 'sub' => 'Above ₹999'],
                            ['icon' => '🔒', 'label' => 'Secure Pay', 'sub' => 'WhatsApp Order'],
                            ['icon' => '✨', 'label' => 'Premium Quality', 'sub' => 'Guaranteed'],
                        ] as $badge)
                            <div class="p-3 rounded-xl" style="background: #F8FAFC;">
                                <div class="text-2xl mb-1">{{ $badge['icon'] }}</div>
                                <p class="text-xs font-semibold text-navy">{{ $badge['label'] }}</p>
                                <p class="text-xs text-gray-400">{{ $badge['sub'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Description --}}
        @if($product->description)
            <div class="bg-white rounded-3xl p-10 shadow-sm mb-14">
                <h2 class="text-2xl font-serif font-bold text-navy mb-6">Product Description</h2>
                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>
        @endif

        {{-- Related Products --}}
        @if($related->count() > 0)
            <div>
                <h2 class="text-3xl font-serif font-bold text-navy mb-8 text-center">You Might Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
                    @foreach($related as $relProduct)
                        <a href="{{ route('shop.show', $relProduct->slug) }}"
                           class="group bg-white rounded-2xl overflow-hidden shadow-md card-hover">
                            <div class="relative overflow-hidden" style="aspect-ratio: 1;">
                                <img src="{{ asset('storage/' . $relProduct->main_image) }}"
                                     alt="{{ $relProduct->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-navy text-sm mb-2 group-hover:text-gold transition-colors line-clamp-2">
                                    {{ $relProduct->name }}
                                </h3>
                                <span class="text-base font-bold" style="color:#B8860B;">
                                    ₹{{ number_format($relProduct->current_price, 0) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

@endsection