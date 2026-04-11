{{-- resources/views/pages/services.blade.php --}}
@extends('layouts.app')
@section('title', 'Services')

@section('content')

{{-- Hero --}}
<section class="relative py-32 overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 70% 50%, rgba(212,160,23,0.1) 0%, transparent 60%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#D4A017;">What We Offer</p>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6">Our Services</h1>
        <div class="gold-divider"></div>
    </div>
</section>

{{-- Services Grid --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @foreach([
            [
                'icon' => '💍',
                'title' => 'Wedding Photography',
                'price' => '₹25,000',
                'desc' => 'Complete wedding day coverage from Mehendi to Reception. Our team captures every ritual, every emotion, every candid moment with professional equipment.',
                'includes' => ['Full day coverage (8-10 hours)', '2 Photographers + 1 Videographer', '500+ edited HD photos', 'Wedding film (5-8 min)', 'Online gallery for 1 year', 'USB drive with all photos'],
                'popular' => true,
            ],
            [
                'icon' => '👫',
                'title' => 'Pre-Wedding Shoot',
                'price' => '₹8,000',
                'desc' => 'Romantic pre-wedding photography session at your chosen location. We craft intimate stories of your love before the big day.',
                'includes' => ['3-4 hour session', '2 outfit changes', '100+ edited photos', 'Location scouting', 'Props arrangement', 'Digital delivery'],
                'popular' => false,
            ],
            [
                'icon' => '👨‍👩‍👧',
                'title' => 'Family Portrait',
                'price' => '₹3,500',
                'desc' => 'Professional family portrait sessions that capture the love and bonds that make your family unique.',
                'includes' => ['2 hour session', 'Studio or outdoor', '50+ edited photos', 'Professional lighting', 'Multiple setups', 'Quick delivery'],
                'popular' => false,
            ],
            [
                'icon' => '🎭',
                'title' => 'Event Coverage',
                'price' => '₹12,000',
                'desc' => 'Corporate events, birthday parties, engagements — we cover all types of events with professionalism.',
                'includes' => ['Half/Full day options', 'Candid photography', '300+ photos', 'Event highlights video', 'Same-week delivery', 'Print-ready files'],
                'popular' => false,
            ],
            [
                'icon' => '🎬',
                'title' => 'Wedding Film',
                'price' => '₹18,000',
                'desc' => 'Cinematic wedding films that tell your love story beautifully. From tears to laughter — every moment preserved.',
                'includes' => ['4K Cinematic video', 'Drone aerial shots', 'Full day coverage', 'Highlight reel (3-5 min)', 'Full ceremony video', 'Digital + USB delivery'],
                'popular' => false,
            ],
            [
                'icon' => '📸',
                'title' => 'Photo Products',
                'price' => 'From ₹299',
                'desc' => 'Transform your precious photos into beautiful products — frames, mugs, cups, and custom gifts.',
                'includes' => ['Custom photo frames', 'Personalized mugs', 'Tea cup sets', 'Photo books', 'Canvas prints', 'Gift packaging'],
                'popular' => false,
            ],
        ] as $service)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-16 pb-16 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0 items-center">
                <div class="{{ $loop->even ? 'lg:order-2' : '' }}">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl"
                             style="background: linear-gradient(135deg, rgba(123,90,0,0.1), rgba(212,160,23,0.15));">
                            {{ $service['icon'] }}
                        </div>
                        @if($service['popular'])
                            <span class="text-xs font-bold px-3 py-1 rounded-full text-white"
                                  style="background: linear-gradient(135deg, #7B5A00, #D4A017);">⭐ Most Popular</span>
                        @endif
                    </div>
                    <h2 class="text-3xl font-serif font-bold text-navy mb-2">{{ $service['title'] }}</h2>
                    <p class="text-2xl font-bold mb-4 gold-text">{{ $service['price'] }}</p>
                    <p class="text-gray-600 leading-relaxed mb-6">{{ $service['desc'] }}</p>
                    <ul class="grid grid-cols-2 gap-2 mb-8">
                        @foreach($service['includes'] as $item)
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0"
                                     style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex gap-3">
                        <a href="{{ route('contact') }}" class="btn-gold">Book Now</a>
                        <a href="https://wa.me/919994141294" target="_blank"
                           class="btn-outline-gold">WhatsApp</a>
                    </div>
                </div>

                <div class="{{ $loop->even ? 'lg:order-1' : '' }}">
                    <div class="rounded-3xl overflow-hidden shadow-xl"
                         style="background: linear-gradient(135deg, #0B1120, #0F172A); aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center;">
                        <div class="text-8xl">{{ $service['icon'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection