{{-- resources/views/pages/pre-wedding.blade.php --}}
@extends('layouts.app')
@section('title', 'Pre-Wedding')

@section('content')

<section class="relative py-32 overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at center, rgba(212,160,23,0.12) 0%, transparent 65%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#D4A017;">Romance & Love</p>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6">Pre-Wedding Photography</h1>
        <div class="gold-divider mb-6"></div>
        <p class="text-xl text-gray-300 max-w-2xl mx-auto">
            Your love story deserves a beautiful prologue. Let us tell it through stunning photographs.
        </p>
    </div>
</section>

{{-- Pre-Wedding Details --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">The Experience</p>
                <h2 class="text-4xl font-serif font-bold text-navy mb-6">Your Love, Our Canvas</h2>
                <div class="w-16 h-1 rounded-full mb-8" style="background: linear-gradient(90deg, #7B5A00, #D4A017);"></div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    A pre-wedding photo shoot is more than just a session — it's an intimate experience that captures 
                    the essence of your relationship before you walk down the aisle. We create a relaxed, 
                    fun atmosphere where your love shines naturally.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    From golden hour beach shoots to rustic heritage locations, we scout and suggest the perfect 
                    backdrops that match your personality as a couple.
                </p>
                <div class="space-y-4">
                    @foreach([
                        ['icon' => '📍', 'title' => 'Location Scouting', 'desc' => 'We find the perfect spots that match your vision'],
                        ['icon' => '👗', 'title' => 'Styling Consultation', 'desc' => 'Outfit coordination and color palette advice'],
                        ['icon' => '📷', 'title' => 'Candid & Posed', 'desc' => 'A mix of natural moments and artistic portraits'],
                        ['icon' => '✨', 'title' => 'Expert Editing', 'desc' => 'Professional retouching that enhances naturally'],
                    ] as $feature)
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                                 style="background: linear-gradient(135deg, rgba(123,90,0,0.08), rgba(212,160,23,0.12));">
                                {{ $feature['icon'] }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-navy">{{ $feature['title'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $feature['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @foreach(['💑', '🌅', '🌸', '📸'] as $emoji)
                    <div class="rounded-2xl flex items-center justify-center shadow-md"
                         style="background: linear-gradient(135deg, #0B1120, #0F172A); aspect-ratio: 1; font-size: 3rem;">
                        {{ $emoji }}
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Packages --}}
        <div class="text-center mb-16">
            <h2 class="section-title">Pre-Wedding Packages</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                [
                    'name' => 'Basic',
                    'price' => '₹6,000',
                    'features' => ['2 hour session', '1 location', '50 edited photos', 'Digital delivery'],
                    'popular' => false,
                ],
                [
                    'name' => 'Classic',
                    'price' => '₹10,000',
                    'features' => ['4 hour session', '2 locations', '100+ edited photos', '2 outfit changes', 'Digital + USB delivery', 'WhatsApp previews'],
                    'popular' => true,
                ],
                [
                    'name' => 'Premium',
                    'price' => '₹18,000',
                    'features' => ['Full day session', '3+ locations', '200+ edited photos', 'Unlimited outfits', 'Short film (2 min)', 'Priority delivery', 'Print album'],
                    'popular' => false,
                ],
            ] as $pkg)
                <div class="rounded-2xl overflow-hidden shadow-lg card-hover relative
                             {{ $pkg['popular'] ? 'ring-2 scale-105' : '' }}"
                     style="{{ $pkg['popular'] ? 'ring-color: #B8860B;' : '' }}; border: 1px solid rgba(184,134,11,0.15);">
                    @if($pkg['popular'])
                        <div class="text-center py-2 text-xs font-bold text-white uppercase tracking-widest"
                             style="background: linear-gradient(90deg, #7B5A00, #D4A017, #B8860B);">
                            ⭐ Most Popular
                        </div>
                    @endif
                    <div class="p-8 bg-white">
                        <h3 class="text-2xl font-serif font-bold text-navy mb-2">{{ $pkg['name'] }}</h3>
                        <p class="text-3xl font-bold mb-6 gold-text">{{ $pkg['price'] }}</p>
                        <ul class="space-y-3 mb-8">
                            @foreach($pkg['features'] as $feat)
                                <li class="flex items-center gap-2 text-sm text-gray-600">
                                    <div class="w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0"
                                         style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('contact') }}"
                           class="{{ $pkg['popular'] ? 'btn-gold' : 'btn-outline-gold' }} w-full justify-center">
                            Book This Package
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection