{{-- resources/views/components/logo.blade.php --}}
@props(['class' => 'h-16'])

<div {{ $attributes->merge(['class' => "inline-flex flex-col items-center $class"]) }}>
    <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg" class="w-auto h-full" fill="none">
        <defs>
            <linearGradient id="goldGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%"   stop-color="#7B5A00"/>
                <stop offset="50%"  stop-color="#D4A017"/>
                <stop offset="100%" stop-color="#B8860B"/>
            </linearGradient>
            <linearGradient id="goldGradient2" x1="100%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%"   stop-color="#D4A017"/>
                <stop offset="50%"  stop-color="#B8860B"/>
                <stop offset="100%" stop-color="#7B5A00"/>
            </linearGradient>
            <filter id="glow">
                <feGaussianBlur stdDeviation="1.5" result="coloredBlur"/>
                <feMerge>
                    <feMergeNode in="coloredBlur"/>
                    <feMergeNode in="SourceGraphic"/>
                </feMerge>
            </filter>
        </defs>

        {{-- Decorative circle background --}}
        <circle cx="80" cy="38" r="34" fill="none" stroke="url(#goldGradient)" stroke-width="1" opacity="0.4"/>

        {{-- "p" Letter --}}
        <text x="48" y="58"
              font-family="Playfair Display, Georgia, serif"
              font-size="52"
              font-weight="700"
              font-style="italic"
              fill="url(#goldGradient)"
              filter="url(#glow)"
              opacity="1">p</text>

        {{-- "K" Letter — overlapping --}}
        <text x="78" y="55"
              font-family="Playfair Display, Georgia, serif"
              font-size="48"
              font-weight="800"
              fill="url(#goldGradient2)"
              filter="url(#glow)">K</text>

        {{-- Horizontal gold line --}}
        <line x1="20" y1="68" x2="160" y2="68" stroke="url(#goldGradient)" stroke-width="1.2" opacity="0.7"/>

        {{-- PHOTOGRAPHY text --}}
        <text x="90" y="82"
              font-family="Playfair Display, Georgia, serif"
              font-size="10"
              font-weight="600"
              letter-spacing="5"
              fill="url(#goldGradient)"
              text-anchor="middle">PHOTOGRAPHY</text>

        {{-- Tagline --}}
        <text x="90" y="95"
              font-family="Georgia, serif"
              font-size="5.5"
              font-weight="400"
              letter-spacing="2"
              fill="#B8860B"
              text-anchor="middle"
              opacity="0.85">EVERY PICTURE TELLS A STORY</text>
    </svg>
</div>