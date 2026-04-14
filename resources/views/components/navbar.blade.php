{{-- resources/views/components/navbar.blade.php --}}
<style>
    /* ✅ Hamburger — Mobile Only */
    #hamburgerBtn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Hide on tablet and desktop */
    @media (min-width: 1024px) {
        #hamburgerBtn {
            display: none !important;
        }
    }

    /* ✅ Desktop Nav — Show on lg+ */
    #desktopNav {
        display: none;
    }

    @media (min-width: 1024px) {
        #desktopNav {
            display: flex;
            align-items: center;
            gap: 0.125rem;
        }
    }

    /* ✅ Desktop Right Buttons — Show on lg+ */
    #desktopActions {
        display: none;
    }

    @media (min-width: 1024px) {
        #desktopActions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    }

    /* ✅ Mobile Menu — Hidden by default */
    #mobileMenu {
        display: none;
    }

    @media (max-width: 1023px) {
        #mobileMenu.is-open {
            display: block;
        }
    }
</style>

<nav x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 20)"
     :style="scrolled
        ? 'background:rgba(255,255,255,0.97); box-shadow:0 4px 20px rgba(0,0,0,0.08); backdrop-filter:blur(12px);'
        : 'background:white;'"
     style="position:sticky; top:0; z-index:50; transition:all 0.3s ease;
            border-bottom:1px solid rgba(184,134,11,0.15);">

    <div style="max-width:80rem; margin:0 auto; padding:0 1rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; height:5rem;">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}"
               style="text-decoration:none; flex-shrink:0;">
                <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"
                     style="width:120px; height:60px;" fill="none">
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
                    <circle cx="80" cy="38" r="34" fill="none"
                            stroke="url(#ng1)" stroke-width="1" opacity="0.4"/>
                    <text x="48" y="58"
                          font-family="Playfair Display, Georgia, serif"
                          font-size="52" font-weight="700" font-style="italic"
                          fill="url(#ng1)">p</text>
                    <text x="78" y="55"
                          font-family="Playfair Display, Georgia, serif"
                          font-size="48" font-weight="800"
                          fill="url(#ng2)">K</text>
                    <line x1="20" y1="68" x2="160" y2="68"
                          stroke="url(#ng1)" stroke-width="1.2" opacity="0.7"/>
                    <text x="90" y="82"
                          font-family="Playfair Display, Georgia, serif"
                          font-size="10" font-weight="600" letter-spacing="5"
                          fill="url(#ng1)" text-anchor="middle">PHOTOGRAPHY</text>
                    <text x="90" y="95"
                          font-family="Georgia, serif"
                          font-size="5.5" letter-spacing="2"
                          fill="#B8860B" text-anchor="middle" opacity="0.85">
                        EVERY PICTURE TELLS A STORY
                    </text>
                </svg>
            </a>

            {{-- ✅ Desktop Nav Links (Hidden on mobile) --}}
            <div id="desktopNav">
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
                    @php $isActive = request()->routeIs($link['route']); @endphp
                    <a href="{{ route($link['route']) }}"
                       style="text-decoration:none;
                              padding:0.5rem 0.875rem;
                              border-radius:9999px;
                              font-size:0.8125rem;
                              font-weight:{{ $isActive ? '700' : '500' }};
                              color:{{ $isActive ? '#B8860B' : '#0F172A' }};
                              background:{{ $isActive ? 'rgba(184,134,11,0.08)' : 'transparent' }};
                              transition:all 0.2s ease;"
                       onmouseover="this.style.color='#B8860B';
                                    this.style.background='rgba(184,134,11,0.06)'"
                       onmouseout="this.style.color='{{ $isActive ? '#B8860B' : '#0F172A' }}';
                                   this.style.background='{{ $isActive ? 'rgba(184,134,11,0.08)' : 'transparent' }}'">
                        {{ $link['name'] }}
                    </a>
                @endforeach

                {{-- ✅ Track Order --}}
                @php $isTrack = request()->routeIs('order.track*'); @endphp
                <a href="{{ route('order.track') }}"
                   style="text-decoration:none;
                          display:inline-flex; align-items:center; gap:0.375rem;
                          padding:0.4rem 0.875rem;
                          border-radius:9999px;
                          font-size:0.8125rem;
                          font-weight:600;
                          transition:all 0.2s ease;
                          {{ $isTrack
                              ? 'background:linear-gradient(135deg,#7B5A00,#D4A017); color:white;'
                              : 'color:#B8860B; border:1.5px solid rgba(184,134,11,0.4); background:rgba(184,134,11,0.04);' }}"
                   onmouseover="this.style.background='linear-gradient(135deg,#7B5A00,#D4A017)';
                                this.style.color='white';
                                this.style.borderColor='transparent'"
                   onmouseout="this.style.background='{{ $isTrack ? 'linear-gradient(135deg,#7B5A00,#D4A017)' : 'rgba(184,134,11,0.04)' }}';
                               this.style.color='{{ $isTrack ? 'white' : '#B8860B' }}';
                               this.style.borderColor='{{ $isTrack ? 'transparent' : 'rgba(184,134,11,0.4)' }}'">
                    🔍 Track Order
                </a>
            </div>

            {{-- ✅ Desktop Action Buttons (Hidden on mobile) --}}
            <div id="desktopActions">

                {{-- Cart --}}
                @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                <a href="{{ route('cart.index') }}"
                   style="position:relative; padding:0.5rem; border-radius:9999px;
                          color:#0F172A; text-decoration:none; transition:all 0.2s;
                          display:flex; align-items:center; justify-content:center;"
                   onmouseover="this.style.color='#B8860B';
                                this.style.background='rgba(184,134,11,0.06)'"
                   onmouseout="this.style.color='#0F172A';
                               this.style.background='transparent'">
                    <svg style="width:1.375rem; height:1.375rem;"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span style="position:absolute; top:-0.25rem; right:-0.25rem;
                                     width:1.125rem; height:1.125rem; font-size:0.65rem;
                                     color:white; border-radius:9999px; font-weight:700;
                                     display:flex; align-items:center; justify-content:center;
                                     background:linear-gradient(135deg,#B8860B,#D4A017);">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Book Now --}}
                <a href="{{ route('contact') }}"
                   style="display:inline-flex; align-items:center; gap:0.375rem;
                          padding:0.5rem 1.25rem; border-radius:9999px;
                          font-weight:600; font-size:0.8125rem; color:white;
                          text-decoration:none; transition:all 0.3s ease;
                          background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                          box-shadow:0 4px 15px rgba(184,134,11,0.35);"
                   onmouseover="this.style.transform='scale(1.05)';
                                this.style.boxShadow='0 8px 25px rgba(184,134,11,0.5)'"
                   onmouseout="this.style.transform='scale(1)';
                               this.style.boxShadow='0 4px 15px rgba(184,134,11,0.35)'">
                    📅 Book Now
                </a>

                {{-- Admin (Logged in only) --}}
                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       style="display:inline-flex; align-items:center; gap:0.375rem;
                              padding:0.5rem 1rem; border-radius:9999px;
                              font-weight:600; font-size:0.75rem; color:#B8860B;
                              text-decoration:none; transition:all 0.2s ease;
                              border:1.5px solid rgba(184,134,11,0.4);
                              background:rgba(184,134,11,0.05);"
                       onmouseover="this.style.background='rgba(184,134,11,0.12)'"
                       onmouseout="this.style.background='rgba(184,134,11,0.05)'">
                        ⚙️ Admin
                    </a>
                @endauth
            </div>

            {{-- ✅ Hamburger Button (Mobile ONLY) --}}
            <button id="hamburgerBtn"
                    @click="open = !open"
                    style="background:none; border:none; cursor:pointer;
                           padding:0.5rem; color:#0F172A; border-radius:0.5rem;
                           transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(184,134,11,0.08)'"
                    onmouseout="this.style.background='none'">

                {{-- Hamburger Icon (3 lines) --}}
                <svg x-show="!open"
                     style="width:1.625rem; height:1.625rem;"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                {{-- Close Icon (X) --}}
                <svg x-show="open"
                     style="width:1.625rem; height:1.625rem;"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ✅ Mobile Menu (Only shows on mobile when open) --}}
    <div id="mobileMenu"
         :class="open ? 'is-open' : ''"
         x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         style="background:white;
                border-top:1px solid rgba(184,134,11,0.12);
                padding:1rem 1rem 1.25rem;">

        {{-- Mobile Nav Links --}}
        <div style="display:flex; flex-direction:column; gap:0.25rem; margin-bottom:1rem;">
            @foreach($navLinks as $link)
                @php $isActive = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   style="display:block; padding:0.75rem 1rem; border-radius:0.75rem;
                          font-size:0.9375rem; font-weight:{{ $isActive ? '700' : '500' }};
                          text-decoration:none;
                          color:{{ $isActive ? '#B8860B' : '#0F172A' }};
                          background:{{ $isActive ? 'rgba(184,134,11,0.08)' : 'transparent' }};
                          transition:all 0.2s;"
                   onmouseover="this.style.background='rgba(184,134,11,0.06)';
                                this.style.color='#B8860B'"
                   onmouseout="this.style.background='{{ $isActive ? 'rgba(184,134,11,0.08)' : 'transparent' }}';
                               this.style.color='{{ $isActive ? '#B8860B' : '#0F172A' }}'">
                    {{ $link['name'] }}
                </a>
            @endforeach
        </div>

        {{-- Track Order Card --}}
        <a href="{{ route('order.track') }}"
           style="display:flex; align-items:center; gap:0.75rem;
                  padding:1rem; border-radius:1rem; margin-bottom:1rem;
                  text-decoration:none; transition:all 0.2s;
                  background:linear-gradient(135deg,rgba(123,90,0,0.06),rgba(212,160,23,0.1));
                  border:1.5px solid rgba(184,134,11,0.25);"
           onmouseover="this.style.background='linear-gradient(135deg,rgba(123,90,0,0.1),rgba(212,160,23,0.15))'"
           onmouseout="this.style.background='linear-gradient(135deg,rgba(123,90,0,0.06),rgba(212,160,23,0.1))'">
            <div style="width:2.5rem; height:2.5rem; border-radius:0.75rem; flex-shrink:0;
                        display:flex; align-items:center; justify-content:center;
                        font-size:1.25rem;
                        background:linear-gradient(135deg,rgba(123,90,0,0.1),rgba(212,160,23,0.15));">
                🔍
            </div>
            <div>
                <p style="font-weight:700; color:#0F172A; font-size:0.9375rem; margin:0;">
                    Track My Order
                </p>
                <p style="font-size:0.75rem; color:#B8860B; margin:0;">
                    Check your order status
                </p>
            </div>
            <svg style="width:1rem; height:1rem; color:#B8860B; margin-left:auto;"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Mobile Action Buttons --}}
        <div style="display:flex; flex-direction:column; gap:0.625rem;
                    padding-top:0.75rem;
                    border-top:1px solid rgba(184,134,11,0.1);">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}"
               style="display:flex; align-items:center; justify-content:center;
                      gap:0.5rem; padding:0.875rem; border-radius:0.875rem;
                      text-decoration:none; font-weight:600; font-size:0.9375rem;
                      background:rgba(184,134,11,0.08); color:#B8860B;">
                🛒 Cart
                @if($cartCount > 0)
                    <span style="width:1.375rem; height:1.375rem; border-radius:9999px;
                                 display:flex; align-items:center; justify-content:center;
                                 font-size:0.7rem; font-weight:700; color:white;
                                 background:linear-gradient(135deg,#B8860B,#D4A017);">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            {{-- Book Now --}}
            <a href="{{ route('contact') }}"
               style="display:flex; align-items:center; justify-content:center;
                      gap:0.5rem; padding:0.875rem; border-radius:0.875rem;
                      text-decoration:none; font-weight:700; font-size:0.9375rem;
                      color:white;
                      background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                      box-shadow:0 4px 15px rgba(184,134,11,0.3);">
                📅 Book a Session
            </a>

            {{-- Admin --}}
            @auth
                <a href="{{ route('admin.dashboard') }}"
                   style="display:flex; align-items:center; justify-content:center;
                          gap:0.5rem; padding:0.875rem; border-radius:0.875rem;
                          text-decoration:none; font-weight:600; font-size:0.875rem;
                          color:#0F172A; border:1.5px solid rgba(184,134,11,0.25);
                          background:rgba(184,134,11,0.04);">
                    ⚙️ Admin Panel
                </a>
            @endauth
        </div>
    </div>
</nav>