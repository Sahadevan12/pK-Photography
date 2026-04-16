{{-- resources/views/pages/home.blade.php --}}
@extends('layouts.app')
@section('title', 'Home')
@push('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
@endpush

@section('content')

{{-- ═══════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════ --}}
<section class="relative min-h-screen flex flex-col justify-center overflow-hidden"
         style="background: linear-gradient(135deg, #F8FAFC 0%, #FFF8E7 50%, #F8FAFC 100%);">

    {{-- Decorative background shapes --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full opacity-20"
             style="background: radial-gradient(circle, #D4A017 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full opacity-15"
             style="background: radial-gradient(circle, #B8860B 0%, transparent 70%);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-5"
             style="background: radial-gradient(circle, #D4A017 0%, transparent 60%);"></div>
    </div>

    {{-- Floating decorative dots --}}
    <div class="absolute inset-0 pointer-events-none">
        @for($i = 0; $i < 12; $i++)
            <div class="absolute rounded-full animate-float"
                 style="
                     width: {{ rand(4, 10) }}px; height: {{ rand(4, 10) }}px;
                     background: #D4A017; opacity: {{ rand(10, 30)/100 }};
                     top: {{ rand(10, 90) }}%; left: {{ rand(5, 95) }}%;
                     animation-delay: {{ rand(0, 3000)/1000 }}s;
                     animation-duration: {{ rand(3, 6) }}s;
                 ">
            </div>
        @endfor
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-10 w-full">

        {{-- ─── Hero Text ─── --}}
        <div class="text-center mb-12 animate-fadeInUp">

            {{-- Top badge --}}
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full text-sm font-medium mb-8"
                 style="background: linear-gradient(135deg, rgba(123,90,0,0.08), rgba(212,160,23,0.12)); border: 1px solid rgba(184,134,11,0.25); color: #7B5A00;">
                <span class="w-2 h-2 rounded-full animate-pulse" style="background: #D4A017;"></span>
                Professional Wedding Photography Studio
            </div>

            {{-- Main Heading --}}
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-serif font-bold leading-tight mb-6"
                style="color: #0B1120; max-width: 860px; margin-left: auto; margin-right: auto;">
                Capturing your
                <span class="relative inline-block">
                    <span class="gold-text">wedding's magic,</span>
                    <svg class="absolute -bottom-2 left-0 w-full" height="8" viewBox="0 0 200 8" preserveAspectRatio="none">
                        <path d="M0 6 Q50 0 100 6 Q150 12 200 6" stroke="url(#underlineGrad)" stroke-width="2" fill="none"/>
                        <defs>
                            <linearGradient id="underlineGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                <stop offset="0%" stop-color="#7B5A00"/>
                                <stop offset="50%" stop-color="#D4A017"/>
                                <stop offset="100%" stop-color="#B8860B"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
                <br>
                one moment at a time
            </h1>

            {{-- Sub-text --}}
            <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed mb-10">
                Capturing the love, joy, and magic of your wedding day,
                preserving <span class="font-medium" style="color: #B8860B;">timeless memories</span> to cherish forever
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('contact') }}"
                   class="btn-gold text-base px-10 py-4 relative overflow-hidden group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>🎉 Get 50% off in this winter</span>
                </a>

                <a href="{{ route('gallery') }}"
                   class="btn-outline-gold text-base px-10 py-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    View Portfolio
                </a>
            </div>

            {{-- Stats --}}
            <div class="flex flex-wrap justify-center gap-10 mt-14">
                @foreach([
                    ['number' => '500+', 'label' => 'Weddings Captured'],
                    ['number' => '10K+', 'label' => 'Happy Moments'],
                    ['number' => '8+',   'label' => 'Years Experience'],
                    ['number' => '50+',  'label' => 'Awards Won'],
                ] as $stat)
                    <div class="text-center">
                        <div class="text-3xl font-serif font-bold gold-text">{{ $stat['number'] }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ─── Dynamic Hero Image Gallery Strip ─── --}}
        @if($heroImages->count() > 0)
            <div class="relative mt-6">
                {{-- Fade edges --}}
                <div class="absolute left-0 top-0 bottom-0 w-24 z-10 pointer-events-none"
                     style="background: linear-gradient(to right, rgba(248,250,252,1), transparent);"></div>
                <div class="absolute right-0 top-0 bottom-0 w-24 z-10 pointer-events-none"
                     style="background: linear-gradient(to left, rgba(248,250,252,1), transparent);"></div>

                <div class="flex gap-6 overflow-x-auto py-6 px-4 scrollbar-thin"
                     style="scrollbar-color: #B8860B transparent;">
                    @foreach($heroImages as $index => $image)
                        <div class="flex-shrink-0 rounded-2xl overflow-hidden shadow-xl transform transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer
                                    {{ $index % 2 === 0 ? 'rotate-[-2deg] hover:rotate-0' : 'rotate-[2deg] hover:rotate-0' }}"
                             style="border: 3px solid rgba(184,134,11,0.2);">
                            <div class="relative w-44 h-60 md:w-48 md:h-64 group">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="{{ $image->title ?? 'Wedding Photography' }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     loading="lazy"/>
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                            flex items-end p-3"
                                     style="background: linear-gradient(to top, rgba(15,23,42,0.8), transparent);">
                                    @if($image->title)
                                        <p class="text-white text-xs font-medium">{{ $image->title }}</p>
                                    @endif
                                </div>
                                {{-- Gold corner accent --}}
                                <div class="absolute top-2 right-2 w-6 h-6 rounded-full opacity-80"
                                     style="background: linear-gradient(135deg, #D4A017, #7B5A00);"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Scroll hint for mobile --}}
            <div class="flex justify-center items-center gap-2 mt-3 text-xs text-gray-400 md:hidden">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Swipe to explore
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </div>
        @else
            {{-- Empty State for Hero Images --}}
            <div class="text-center py-12 text-gray-400">
                <p class="text-sm">No hero images yet.
                    @auth <a href="{{ route('admin.hero-images.create') }}" class="underline" style="color:#B8860B;">Add from Admin</a> @endauth
                </p>
            </div>
        @endif
    </div>
</section>

<div style="background:white; border-top:1px solid rgba(184,134,11,0.15);
            border-bottom:1px solid rgba(184,134,11,0.15); padding:0.875rem 1rem;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div style="display:flex; align-items:center; justify-content:center;
                    gap:1rem; flex-wrap:wrap;">
            <span style="font-size:0.875rem; color:#6B7280;">
                📦 Already placed an order?
            </span>
            <a href="{{ route('order.track') }}"
               style="display:inline-flex; align-items:center; gap:0.5rem;
                      padding:0.5rem 1.25rem; border-radius:9999px;
                      font-size:0.8125rem; font-weight:700; text-decoration:none;
                      color:#B8860B; border:1.5px solid #B8860B;
                      transition:all 0.2s ease; background:rgba(184,134,11,0.04);"
               onmouseover="this.style.background='linear-gradient(135deg,#7B5A00,#D4A017)';
                            this.style.color='white';
                            this.style.borderColor='transparent'"
               onmouseout="this.style.background='rgba(184,134,11,0.04)';
                           this.style.color='#B8860B';
                           this.style.borderColor='#B8860B'">
                🔍 Track Your Order
            </a>
        </div>
    </div>
</div>


{{-- ═══════════════════════════════════════════
     SERVICES SECTION
═══════════════════════════════════════════ --}}
<section class="py-24" style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7, #F8FAFC);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">What We Do</p>
            <h2 class="section-title">Our Photography Services</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                [
                    'icon' => '💍', 
                    'title' => 'Wedding Photography', 
                    'desc' => 'Complete wedding day coverage capturing every precious moment from ceremony to reception.',
                    'features' => ['Full day coverage', 'Edited HD photos', 'Online gallery']
                ],
                [
                    'icon' => '👫', 
                    'title' => 'Pre-Wedding Shoots', 
                    'desc' => 'Romantic pre-wedding sessions at stunning locations to tell your love story.',
                    'features' => ['Custom locations', '2-3 hour session', 'Multiple outfits']
                ],
                [
                    'icon' => '👨‍👩‍👧', 
                    'title' => 'Portrait Sessions', 
                    'desc' => 'Professional portrait photography for individuals, couples, and families.',
                    'features' => ['Studio & outdoor', 'Professional lighting', 'Quick delivery']
                ],
                [
                    'icon' => '🎭', 
                    'title' => 'Event Photography', 
                    'desc' => 'Capturing corporate events, birthdays, and special celebrations beautifully.',
                    'features' => ['All event types', 'Candid shots', 'Fast turnaround']
                ],
                [
                    'icon' => '🎬', 
                    'title' => 'Videography', 
                    'desc' => 'Cinematic wedding films and event videos that you will treasure forever.',
                    'features' => ['4K video', 'Drone footage', 'Professional editing']
                ],
                [
                    'icon' => '🖼️', 
                    'title' => 'Photo Products', 
                    'desc' => 'Premium photo frames, mugs, and personalized gifts with your memories.',
                    'features' => ['Custom printing', 'Premium quality', 'Gift packaging']
                ],
            ] as $service)
                <div class="bg-white rounded-2xl p-8 shadow-md card-hover border border-gray-100 group">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl mb-6 transition-transform duration-300 group-hover:scale-110"
                         style="background: linear-gradient(135deg, rgba(123,90,0,0.08), rgba(212,160,23,0.12));">
                        {{ $service['icon'] }}
                    </div>
                    <h3 class="text-xl font-serif font-bold text-navy mb-3 group-hover:text-gold transition-colors">
                        {{ $service['title'] }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $service['desc'] }}</p>
                    <ul class="space-y-2">
                        @foreach($service['features'] as $feature)
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <svg class="w-4 h-4 flex-shrink-0" style="color:#B8860B;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════
     FEATURED CATEGORIES
═══════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">Our Shop</p>
            <h2 class="section-title">Premium Gift Collections</h2>
            <div class="gold-divider"></div>
            <p class="section-subtitle mt-4">Personalized gifts that preserve your precious memories forever</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                   class="group relative rounded-2xl overflow-hidden shadow-md card-hover"
                   style="aspect-ratio: 3/4; background: linear-gradient(135deg, #0F172A, #1E293B);">

                    @if($category->image_path)
                        <img src="{{ asset('storage/' . $category->image_path) }}"
                             alt="{{ $category->name }}"
                             class="absolute inset-0 w-full h-full object-cover opacity-70 group-hover:opacity-50 transition-opacity duration-300"/>
                    @else
                        {{-- Placeholder gradient --}}
                        <div class="absolute inset-0 opacity-30"
                             style="background: linear-gradient(135deg, #7B5A00, #D4A017);"></div>
                    @endif

                    {{-- Overlay --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-end p-5 text-center"
                         style="background: linear-gradient(to top, rgba(11,17,32,0.9) 0%, transparent 60%);">
                        <h3 class="text-white font-serif font-semibold text-lg mb-2">{{ $category->name }}</h3>
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-3 py-1 rounded-full"
                              style="background: rgba(212,160,23,0.2); color: #D4A017; border: 1px solid rgba(212,160,23,0.3);">
                            Shop Now →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════
     THREE.JS PARTICLE SECTION (NOT HERO)
═══════════════════════════════════════════ --}}
<section class="relative py-32 overflow-hidden" style="background: #0B1120;">
    {{-- Three.js Canvas --}}
    <canvas id="three-canvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>

    <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-4" style="color:#D4A017;">Our Philosophy</p>
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 leading-tight">
            Every Frame is a
            <span class="gold-text">Masterpiece</span>
        </h2>
        <div class="gold-divider mb-8"></div>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
            We don't just take photographs — we craft visual stories that transcend time.
            Each image is composed with artistic precision and heartfelt emotion.
        </p>
        <a href="{{ route('services') }}" class="btn-gold px-10 py-4">
            Explore Our Services
        </a>
    </div>
</section>


{{-- ═══════════════════════════════════════════
     FEATURED PRODUCTS
═══════════════════════════════════════════ --}}
@if($featuredProducts->count() > 0)
<section class="py-24 bg-brand-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">Featured Items</p>
            <h2 class="section-title">Bestselling Products</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
            @foreach($featuredProducts as $product)
                <a href="{{ route('shop.show', $product->slug) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-md card-hover">

                    {{-- Product Image --}}
                    <div class="relative overflow-hidden" style="aspect-ratio: 4/3;">
                        <img src="{{ asset('storage/' . $product->main_image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                             loading="lazy"
                             onerror="this.src='https://via.placeholder.com/400x300/0F172A/D4A017?text=PK+Photo'"/>

                        {{-- Badges --}}
                        <div class="absolute top-3 left-3 flex flex-col gap-2">
                            @if($product->sale_price)
                                <span class="text-xs font-bold px-3 py-1 rounded-full text-white"
                                      style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                    -{{ $product->discount_percent }}%
                                </span>
                            @endif
                            @if($product->allow_custom_image)
                                <span class="text-xs font-medium px-2 py-1 rounded-full"
                                      style="background: rgba(15,23,42,0.8); color: #D4A017;">
                                    📸 Custom
                                </span>
                            @endif
                        </div>

                        {{-- Quick add overlay --}}
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-300
                                    flex items-center justify-center"
                             style="background: rgba(11,17,32,0.4);">
                            <span class="px-6 py-2.5 rounded-full text-sm font-semibold text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300"
                                  style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                View Product
                            </span>
                        </div>
                    </div>

                    {{-- Product Info --}}
                    <div class="p-4">
                        <p class="text-xs font-medium uppercase tracking-wider mb-1"
                           style="color:#B8860B;">{{ $product->category->name }}</p>
                        <h3 class="font-semibold text-navy text-sm mb-2 group-hover:text-gold transition-colors line-clamp-2">
                            {{ $product->name }}
                        </h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-base font-bold" style="color:#B8860B;">
                                    ₹{{ number_format($product->current_price, 0) }}
                                </span>
                                @if($product->sale_price)
                                    <span class="text-sm text-gray-400 line-through">
                                        ₹{{ number_format($product->price, 0) }}
                                    </span>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('shop.index') }}" class="btn-outline-gold px-10 py-4">
                View All Products
            </a>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════
     GALLERY PREVIEW
═══════════════════════════════════════════ --}}
@if($galleryImages->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">Our Work</p>
            <h2 class="section-title">Portfolio Highlights</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galleryImages as $index => $img)
                <div class="group relative rounded-2xl overflow-hidden shadow-md card-hover
                             {{ $index === 0 ? 'row-span-2' : '' }}"
                     style="{{ $index === 0 ? 'grid-row: span 2;' : '' }}">
                    <img src="{{ asset('storage/' . $img->image_path) }}"
                         alt="{{ $img->title ?? 'Gallery Image' }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         style="{{ $index === 0 ? 'height: 100%; min-height: 300px;' : 'height: 200px;' }}"
                         loading="lazy"/>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300
                                flex items-center justify-center"
                         style="background: linear-gradient(135deg, rgba(123,90,0,0.6), rgba(212,160,23,0.4));">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('gallery') }}" class="btn-gold px-10 py-4">
                See Full Gallery
            </a>
        </div>
    </div>
</section>
@endif


{{-- ═══════════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">Love Stories</p>
            <h2 class="section-title">What Our Couples Say</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8"
             x-data="{ current: 0 }">
            @foreach([
                [
                    'name' => 'Priya & Arjun',
                    'event' => 'Wedding, Chennai 2024',
                    'text' => 'PK Photography captured our wedding so beautifully! Every photo feels like a painting. We will treasure these memories forever.',
                    'rating' => 5,
                    'initials' => 'PA'
                ],
                [
                    'name' => 'Sneha & Karthik',
                    'event' => 'Pre-Wedding Shoot',
                    'text' => 'The pre-wedding shoot was absolutely magical. They made us so comfortable and the photos are stunning!',
                    'rating' => 5,
                    'initials' => 'SK'
                ],
                [
                    'name' => 'Divya & Ravi',
                    'event' => 'Wedding, Coimbatore 2023',
                    'text' => 'Professional, creative, and incredibly talented. Our wedding album is something we show everyone with pride.',
                    'rating' => 5,
                    'initials' => 'DR'
                ],
            ] as $testimonial)
                <div class="bg-brand-bg rounded-2xl p-8 shadow-sm card-hover relative">
                    {{-- Quote mark --}}
                    <div class="text-6xl font-serif leading-none mb-4 -mt-2 opacity-30" style="color:#D4A017;">"</div>

                    {{-- Stars --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <svg class="w-5 h-5" style="color:#D4A017;" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">
                        "{{ $testimonial['text'] }}"
                    </p>

                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-sm"
                             style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                            {{ $testimonial['initials'] }}
                        </div>
                        <div>
                            <p class="font-semibold text-navy text-sm">{{ $testimonial['name'] }}</p>
                            <p class="text-xs text-gray-400">{{ $testimonial['event'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ═══════════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════════ --}}
<section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgba(212,160,23,0.1) 0%, transparent 70%);"></div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">
            Ready to Capture Your<br>
            <span class="gold-text">Perfect Moments?</span>
        </h2>
        <p class="text-gray-300 text-lg mb-10 max-w-xl mx-auto">
            Book your session today and get 50% off on winter packages.
            Limited slots available!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="btn-gold px-10 py-4 text-base">
                📅 Book a Session
            </a>
            <a href="https://wa.me/919994141294" target="_blank"
               class="inline-flex items-center justify-center gap-2 px-10 py-4 rounded-full font-semibold text-white transition-all duration-300 hover:scale-105"
               style="background: linear-gradient(135deg, #25D366, #128C7E); box-shadow: 0 4px 20px rgba(37,211,102,0.3);">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
                </svg>
                WhatsApp Us Now
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// ─── Three.js Particle Animation ───────────────────────────────────
(function() {
    const canvas = document.getElementById('three-canvas');
    if (!canvas || typeof THREE === 'undefined') return;

    const scene    = new THREE.Scene();
    const camera   = new THREE.PerspectiveCamera(60, canvas.offsetWidth / canvas.offsetHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });

    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);
    camera.position.z = 50;

    // Create particles
    const geometry = new THREE.BufferGeometry();
    const count    = 1800;
    const positions = new Float32Array(count * 3);
    const colors    = new Float32Array(count * 3);

    const goldColors = [
        [0.84, 0.53, 0.04],  // #D4A017
        [0.72, 0.40, 0.04],  // #B8860B
        [0.48, 0.35, 0.00],  // #7B5A00
        [1.0,  0.85, 0.50],  // light gold
    ];

    for (let i = 0; i < count; i++) {
        positions[i * 3]     = (Math.random() - 0.5) * 200;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 100;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 80;

        const color = goldColors[Math.floor(Math.random() * goldColors.length)];
        colors[i * 3]     = color[0];
        colors[i * 3 + 1] = color[1];
        colors[i * 3 + 2] = color[2];
    }

    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color',    new THREE.BufferAttribute(colors, 3));

    const material = new THREE.PointsMaterial({
        size:         0.5,
        vertexColors: true,
        transparent:  true,
        opacity:      0.85,
        sizeAttenuation: true,
    });

    const particles = new THREE.Points(geometry, material);
    scene.add(particles);

    // Mouse interaction
    let mouseX = 0, mouseY = 0;
    document.addEventListener('mousemove', (e) => {
        mouseX = (e.clientX / window.innerWidth  - 0.5) * 2;
        mouseY = (e.clientY / window.innerHeight - 0.5) * 2;
    });

    // Resize handler
    window.addEventListener('resize', () => {
        camera.aspect = canvas.offsetWidth / canvas.offsetHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);
    });

    // Animation loop
    let frame = 0;
    function animate() {
        requestAnimationFrame(animate);
        frame += 0.003;

        particles.rotation.y  = frame + mouseX * 0.15;
        particles.rotation.x  = mouseY * 0.1;
        particles.rotation.z  = frame * 0.3;

        renderer.render(scene, camera);
    }
    animate();
})();
</script>
@endpush