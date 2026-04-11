{{-- resources/views/components/navbar.blade.php --}}
<nav x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 20)"
     :class="scrolled ? 'bg-white/95 shadow-lg backdrop-blur-md' : 'bg-white'"
     class="sticky top-0 z-50 transition-all duration-300"
     style="border-bottom: 1px solid rgba(184,134,11,0.15);">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}" style="text-decoration:none;">
                <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"
                     style="width:130px; height:65px;" fill="none">
                    <defs>
                        <linearGradient id="ng1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%"   stop-color="#7B5A00"/>
                            <stop offset="50%"  stop-color="#D4A017"/>
                            <stop offset="100%" stop-color="#B8860B"/>
                        </linearGradient>
                        <linearGradient id="ng2" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%"   stop-color="#D4A017"/>
                            <stop offset="100%" stop-color="#7B5A00"/>
                        </linearGradient>
                    </defs>
                    <circle cx="80" cy="38" r="34" fill="none" stroke="url(#ng1)" stroke-width="1" opacity="0.4"/>
                    <text x="48" y="58" font-family="Playfair Display, Georgia, serif"
                          font-size="52" font-weight="700" font-style="italic"
                          fill="url(#ng1)">p</text>
                    <text x="78" y="55" font-family="Playfair Display, Georgia, serif"
                          font-size="48" font-weight="800"
                          fill="url(#ng2)">K</text>
                    <line x1="20" y1="68" x2="160" y2="68" stroke="url(#ng1)" stroke-width="1.2" opacity="0.7"/>
                    <text x="90" y="82" font-family="Playfair Display, Georgia, serif"
                          font-size="10" font-weight="600" letter-spacing="5"
                          fill="url(#ng1)" text-anchor="middle">PHOTOGRAPHY</text>
                    <text x="90" y="95" font-family="Georgia, serif"
                          font-size="5.5" letter-spacing="2"
                          fill="#B8860B" text-anchor="middle" opacity="0.85">
                        EVERY PICTURE TELLS A STORY
                    </text>
                </svg>
            </a>

            {{-- ── Desktop Nav Links ── --}}
            <div class="hidden lg:flex items-center gap-1">
                @php
                    $navLinks = [
                        ['name' => 'Home',        'route' => 'home'],
                        ['name' => 'About',       'route' => 'about'],
                        ['name' => 'Services',    'route' => 'services'],
                        ['name' => 'Pre-Wedding', 'route' => 'pre-wedding'],
                        ['name' => 'Gallery',     'route' => 'gallery'],
                        ['name' => 'Shop',        'route' => 'shop.index'],
                        ['name' => 'Contact',     'route' => 'contact'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       style="text-decoration:none;
                              padding: 0.5rem 1rem;
                              border-radius: 9999px;
                              font-size: 0.875rem;
                              font-weight: 500;
                              transition: all 0.2s ease;
                              {{ request()->routeIs($link['route'])
                                    ? 'color:#B8860B; font-weight:600;'
                                    : 'color:#0F172A;' }}"
                       onmouseover="this.style.color='#B8860B'"
                       onmouseout="this.style.color='{{ request()->routeIs($link['route']) ? '#B8860B' : '#0F172A' }}'">
                        {{ $link['name'] }}
                    </a>
                @endforeach
            </div>

            {{-- ── Right Side: Cart Only (NO Admin Button) ── --}}
            <div class="hidden lg:flex items-center gap-3">

                {{-- Cart Button --}}
                <a href="{{ route('cart.index') }}"
                   class="relative p-2 rounded-full transition-all duration-200"
                   style="color:#0F172A; text-decoration:none;"
                   onmouseover="this.style.color='#B8860B'"
                   onmouseout="this.style.color='#0F172A'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>

                    {{-- Cart Count Badge --}}
                    @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 text-xs text-white rounded-full
                                     flex items-center justify-center font-bold"
                              style="background: linear-gradient(135deg, #B8860B, #D4A017);">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Book Now Button --}}
                <a href="{{ route('contact') }}"
                   style="display:inline-flex; align-items:center; gap:0.5rem;
                          padding:0.625rem 1.5rem; border-radius:9999px;
                          font-weight:600; font-size:0.875rem; color:white;
                          text-decoration:none; transition:all 0.3s ease;
                          background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
                          box-shadow: 0 4px 15px rgba(184,134,11,0.35);"
                   onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 8px 25px rgba(184,134,11,0.5)'"
                   onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(184,134,11,0.35)'">
                    📅 Book Now
                </a>

                {{-- ✅ ADMIN BUTTON — ONLY VISIBLE WHEN LOGGED IN --}}
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       style="display:inline-flex; align-items:center; gap:0.5rem;
                              padding:0.625rem 1.25rem; border-radius:9999px;
                              font-weight:600; font-size:0.75rem; color:#B8860B;
                              text-decoration:none; transition:all 0.2s ease;
                              border: 1.5px solid rgba(184,134,11,0.4);
                              background: rgba(184,134,11,0.05);"
                       onmouseover="this.style.background='rgba(184,134,11,0.1)'"
                       onmouseout="this.style.background='rgba(184,134,11,0.05)'">
                        ⚙️ Admin
                    </a>
                @endauth
                {{-- ❌ NOT LOGGED IN = NO ADMIN BUTTON SHOWN --}}
            </div>

            {{-- ── Mobile Menu Toggle ── --}}
            <button @click="open = !open"
                    class="lg:hidden p-2 rounded-xl transition-colors"
                    style="color:#0F172A;">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white py-4 px-4 space-y-1"
         style="border-top: 1px solid rgba(184,134,11,0.1);">

        @foreach($navLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="block px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
               style="text-decoration:none;
                      {{ request()->routeIs($link['route'])
                            ? 'color:#B8860B; background:rgba(184,134,11,0.08); font-weight:600;'
                            : 'color:#0F172A;' }}"
               onmouseover="this.style.background='rgba(184,134,11,0.06)'; this.style.color='#B8860B'"
               onmouseout="this.style.background='{{ request()->routeIs($link['route']) ? 'rgba(184,134,11,0.08)' : 'transparent' }}';
                           this.style.color='{{ request()->routeIs($link['route']) ? '#B8860B' : '#0F172A' }}'">
                {{ $link['name'] }}
            </a>
        @endforeach

        {{-- Mobile Bottom Buttons --}}
        <div class="pt-3 flex flex-col gap-2"
             style="border-top: 1px solid rgba(184,134,11,0.1);">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}"
               class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold"
               style="background: rgba(184,134,11,0.08);
                      color:#B8860B;
                      text-decoration:none;">
                🛒 Cart
                @if($cartCount > 0)
                    <span class="w-5 h-5 text-xs text-white rounded-full flex items-center justify-center font-bold"
                          style="background: linear-gradient(135deg, #B8860B, #D4A017);">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            {{-- Book Now --}}
            <a href="{{ route('contact') }}"
               class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white"
               style="background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
                      text-decoration:none;">
                📅 Book Now
            </a>

            {{-- ✅ MOBILE ADMIN — ONLY IF LOGGED IN --}}
            @auth
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold"
                   style="background: rgba(15,23,42,0.08);
                          color:#0F172A;
                          text-decoration:none;
                          border: 1px solid rgba(184,134,11,0.2);">
                    ⚙️ Admin Panel
                </a>
            @endauth
            {{-- ❌ GUEST = NO ADMIN BUTTON --}}
        </div>
    </div>
</nav>