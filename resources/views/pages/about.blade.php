{{-- resources/views/pages/about.blade.php --}}
@extends('layouts.app')
@section('title', 'About Us')

@section('content')

{{-- Hero --}}
<section class="relative py-32 overflow-hidden" style="background: linear-gradient(135deg, #0B1120, #0F172A);">
    <div class="absolute inset-0" style="background: radial-gradient(ellipse at 30% 50%, rgba(212,160,23,0.1) 0%, transparent 60%);"></div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#D4A017;">Our Story</p>
        <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mb-6">About PK Photography</h1>
        <div class="gold-divider mb-6"></div>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto">
            A passion for capturing life's most beautiful moments, one frame at a time.
        </p>
    </div>
</section>

{{-- About Content --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">Who We Are</p>
                <h2 class="text-4xl font-serif font-bold text-navy mb-6">
                    Telling Stories Through the Lens
                </h2>
                <div class="w-16 h-1 rounded-full mb-8"
                     style="background: linear-gradient(90deg, #7B5A00, #D4A017);"></div>
                <p class="text-gray-600 leading-relaxed mb-6">
                    PK Photography was founded with a single mission — to preserve the most precious moments of your life 
                    through the art of photography. With over 8 years of experience, we have captured over 500 weddings 
                    across Tamil Nadu.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Our team of passionate photographers and videographers combine technical expertise with artistic vision 
                    to create images that don't just document events — they tell stories. Every frame is crafted with care, 
                    emotion, and the understanding that you will cherish these memories forever.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    @foreach([
                        ['number' => '500+', 'label' => 'Weddings Captured'],
                        ['number' => '10K+', 'label' => 'Photos Delivered'],
                        ['number' => '8+',   'label' => 'Years Experience'],
                        ['number' => '50+',  'label' => 'Awards Won'],
                    ] as $stat)
                        <div class="p-5 rounded-2xl text-center" style="background: linear-gradient(135deg, #F8FAFC, #FFF8E7);">
                            <div class="text-3xl font-bold font-serif gold-text mb-1">{{ $stat['number'] }}</div>
                            <div class="text-xs text-gray-500 uppercase tracking-wider">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl overflow-hidden shadow-2xl"
                     style="background: linear-gradient(135deg, #0F172A, #1E293B); aspect-ratio: 4/5; display: flex; align-items: center; justify-content: center;">
                    <div class="text-center p-10">
                        <x-logo class="h-32 mx-auto mb-6" />
                        <p class="text-gold-light text-xl font-serif italic" style="color:#D4A017;">
                            "Every Picture Tells A Story"
                        </p>
                    </div>
                </div>
                {{-- Decorative elements --}}
                <div class="absolute -bottom-6 -right-6 w-32 h-32 rounded-2xl rotate-12 -z-10"
                     style="background: linear-gradient(135deg, rgba(184,134,11,0.15), rgba(212,160,23,0.1)); border: 1px solid rgba(184,134,11,0.2);"></div>
                <div class="absolute -top-6 -left-6 w-24 h-24 rounded-2xl -rotate-12 -z-10"
                     style="background: linear-gradient(135deg, rgba(184,134,11,0.1), rgba(212,160,23,0.08)); border: 1px solid rgba(184,134,11,0.15);"></div>
            </div>
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="py-24 bg-brand-bg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-sm font-semibold uppercase tracking-widest mb-3" style="color:#B8860B;">The Creators</p>
            <h2 class="section-title">Meet Our Team</h2>
            <div class="gold-divider"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach([
                ['name' => 'Praveen Kumar', 'role' => 'Lead Photographer & Founder', 'initials' => 'PK', 'bio' => '8+ years of wedding photography with a passion for storytelling.'],
                ['name' => 'Kavitha R.',    'role' => 'Portrait & Lifestyle Photographer', 'initials' => 'KR', 'bio' => 'Specializes in natural light portraits and candid moments.'],
                ['name' => 'Murali S.',     'role' => 'Cinematographer', 'initials' => 'MS', 'bio' => 'Award-winning filmmaker creating cinematic wedding stories.'],
            ] as $member)
                <div class="text-center card-hover">
                    <div class="w-32 h-32 rounded-full mx-auto mb-5 flex items-center justify-center text-3xl font-bold text-white shadow-xl"
                         style="background: linear-gradient(135deg, #0B1120, #0F172A); border: 3px solid #B8860B;">
                        <span class="gold-text">{{ $member['initials'] }}</span>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-navy mb-1">{{ $member['name'] }}</h3>
                    <p class="text-sm font-medium mb-3" style="color:#B8860B;">{{ $member['role'] }}</p>
                    <p class="text-sm text-gray-500">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection