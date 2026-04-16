{{-- resources/views/components/navbar.blade.php --}}
<style>
    /* ── Base nav link style ──────────────────────────── */
    .nav-link {
        position: relative;
        text-decoration: none;
        padding: 0.55rem 1.1rem;
        border-radius: 9999px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #0F172A;
        letter-spacing: 0.01em;
        transition: all 0.25s ease;
        white-space: nowrap;
    }

    /* Hover state */
    .nav-link:hover {
        color: #B8860B;
        background: rgba(184, 134, 11, 0.07);
    }

    /* Active state — gold filled pill */
    .nav-link.active {
        font-weight: 700;
        color: #7B5A00;
        background: linear-gradient(135deg,
            rgba(123,90,0,0.10),
            rgba(212,160,23,0.14));
        box-shadow: 0 2px 10px rgba(184,134,11,0.12);
    }

    .nav-link.active:hover {
        color: #7B5A00;
        background: linear-gradient(135deg,
            rgba(123,90,0,0.14),
            rgba(212,160,23,0.18));
    }

    /* Animated underline bar on hover (non-active) */
    .nav-link:not(.active)::after {
        content: '';
        position: absolute;
        bottom: 4px;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 60%;
        height: 2px;
        border-radius: 9999px;
        background: linear-gradient(90deg, #7B5A00, #D4A017);
        transition: transform 0.25s ease;
    }

    .nav-link:not(.active):hover::after {
        transform: translateX(-50%) scaleX(1);
    }

    /* ── Track Order pill ─────────────────────────────── */
    .nav-track {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1.15rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        transition: all 0.25s ease;
        color: #B8860B;
        border: 1.5px solid rgba(184,134,11,0.35);
        background: rgba(184,134,11,0.05);
        white-space: nowrap;
    }

    .nav-track:hover,
    .nav-track.active {
        background: linear-gradient(135deg, #7B5A00, #D4A017);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 14px rgba(184,134,11,0.35);
        transform: translateY(-1px);
    }

    /* ── Cart icon button ─────────────────────────────── */
    .nav-cart {
        position: relative;
        padding: 0.55rem;
        border-radius: 9999px;
        color: #0F172A;
        text-decoration: none;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-cart:hover {
        color: #B8860B;
        background: rgba(184,134,11,0.07);
        transform: translateY(-1px);
    }

    /* ── Book Now button ──────────────────────────────── */
    .nav-book {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.575rem 1.375rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.875rem;
        letter-spacing: 0.015em;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
        background-size: 200% 200%;
        box-shadow: 0 4px 18px rgba(184,134,11,0.38);
        white-space: nowrap;
    }

    .nav-book:hover {
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 8px 28px rgba(212,160,23,0.52);
    }

    .nav-book:active {
        transform: translateY(0) scale(0.98);
    }

    /* ── Admin pill ───────────────────────────────────── */
    .nav-admin {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.8rem;
        color: #B8860B;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1.5px solid rgba(184,134,11,0.35);
        background: rgba(184,134,11,0.05);
    }

    .nav-admin:hover {
        background: rgba(184,134,11,0.12);
        transform: translateY(-1px);
    }

    /* ── Hamburger: mobile only ───────────────────────── */
    #hamburgerBtn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @media (min-width: 1024px) {
        #hamburgerBtn { display: none !important; }
    }

    /* ── Desktop nav: lg+ only ────────────────────────── */
    #desktopNav {
        display: none;
    }

    @media (min-width: 1024px) {
        #desktopNav {
            display: flex;
            align-items: center;
            gap: 0.2rem;          /* gap between each nav link */
        }
    }

    /* ── Desktop actions: lg+ only ───────────────────── */
    #desktopActions {
        display: none;
    }

    @media (min-width: 1024px) {
        #desktopActions {
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }
    }

    /* ── Mobile menu ──────────────────────────────────── */
    #mobileMenu { display: none; }

    @media (max-width: 1023px) {
        #mobileMenu.is-open { display: block; }
    }

    /* ── Mobile nav links ─────────────────────────────── */
    .mobile-nav-link {
        display: block;
        padding: 0.8rem 1rem;
        border-radius: 0.875rem;
        font-size: 1rem;
        font-weight: 500;
        text-decoration: none;
        color: #0F172A;
        background: transparent;
        transition: all 0.2s ease;
        letter-spacing: 0.01em;
    }

    .mobile-nav-link:hover {
        background: rgba(184,134,11,0.07);
        color: #B8860B;
        padding-left: 1.375rem;
    }

    .mobile-nav-link.active {
        font-weight: 700;
        color: #B8860B;
        background: rgba(184,134,11,0.09);
    }
</style>

<nav x-data="{ open: false, scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 20)"
     :style="scrolled
        ? 'background:rgba(255,255,255,0.97); box-shadow:0 4px 24px rgba(0,0,0,0.09); backdrop-filter:blur(14px);'
        : 'background:white;'"
     style="position:sticky; top:0; z-index:50; transition:all 0.3s ease;
            border-bottom:1px solid rgba(184,134,11,0.13);">

    <div style="width:100%; padding:0 3rem;">
        <div style="display:flex; align-items:center; justify-content:space-between;
                    height:5.5rem;">

            {{-- ── Logo ─────────────────────────────── --}}
            <a href="{{ route('home') }}"
               style="text-decoration:none; flex-shrink:0;
                      transition:transform 0.25s ease;"
               onmouseover="this.style.transform='scale(1.03)'"
               onmouseout="this.style.transform='scale(1)'">
                <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"
                     style="width:140px; height:70px;" fill="none">
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

            {{-- ── Desktop Nav Links ───────────────── --}}
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
                       class="nav-link {{ $isActive ? 'active' : '' }}">
                        {{ $link['name'] }}
                    </a>
                @endforeach

                {{-- Track Order --}}
                @php $isTrack = request()->routeIs('order.track*'); @endphp
                <a href="{{ route('order.track') }}"
                   class="nav-track {{ $isTrack ? 'active' : '' }}"
                   style="margin-left:0.35rem;">
                    🔍 Track Order
                </a>
            </div>

            {{-- ── Desktop Action Buttons ──────────── --}}
            <div id="desktopActions">

                {{-- Cart --}}
                @php $cartCount = collect(session('cart', []))->sum('quantity'); @endphp
                <a href="{{ route('cart.index') }}" class="nav-cart">
                    <svg style="width:1.45rem; height:1.45rem;"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4
                                 5M7 13l-2.293 2.293c-.63.63-.184
                                 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2
                                 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span style="position:absolute; top:-0.2rem; right:-0.2rem;
                                     width:1.15rem; height:1.15rem; font-size:0.65rem;
                                     color:white; border-radius:9999px; font-weight:700;
                                     display:flex; align-items:center; justify-content:center;
                                     background:linear-gradient(135deg,#B8860B,#D4A017);
                                     box-shadow:0 2px 6px rgba(184,134,11,0.4);">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- Book Now --}}
                <a href="{{ route('contact') }}" class="nav-book">
                    📅 Book Now
                </a>

                {{-- Admin --}}
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="nav-admin">
                        ⚙️ Admin
                    </a>
                @endauth
            </div>

            {{-- ── Hamburger (Mobile) ──────────────── --}}
            <button id="hamburgerBtn"
                    @click="open = !open"
                    style="background:none; border:none; cursor:pointer;
                           padding:0.5rem; color:#0F172A; border-radius:0.75rem;
                           transition:all 0.2s;"
                    onmouseover="this.style.background='rgba(184,134,11,0.09)'"
                    onmouseout="this.style.background='none'">
                <svg x-show="!open"
                     style="width:1.75rem; height:1.75rem;"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open"
                     style="width:1.75rem; height:1.75rem;"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- ── Mobile Menu ─────────────────────────────────── --}}
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
                padding:1.25rem 1.25rem 1.5rem;">

        {{-- Mobile Nav Links --}}
        <div style="display:flex; flex-direction:column; gap:0.2rem; margin-bottom:1rem;">
            @foreach($navLinks as $link)
                @php $isActive = request()->routeIs($link['route']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="mobile-nav-link {{ $isActive ? 'active' : '' }}">
                    {{ $link['name'] }}
                </a>
            @endforeach
        </div>

        {{-- Track Order Card --}}
        <a href="{{ route('order.track') }}"
           style="display:flex; align-items:center; gap:0.875rem;
                  padding:1rem 1.125rem; border-radius:1rem; margin-bottom:1rem;
                  text-decoration:none; transition:all 0.2s;
                  background:linear-gradient(135deg,rgba(123,90,0,0.06),rgba(212,160,23,0.1));
                  border:1.5px solid rgba(184,134,11,0.22);"
           onmouseover="this.style.background='linear-gradient(135deg,rgba(123,90,0,0.10),rgba(212,160,23,0.15))'"
           onmouseout="this.style.background='linear-gradient(135deg,rgba(123,90,0,0.06),rgba(212,160,23,0.1))'">
            <div style="width:2.75rem; height:2.75rem; border-radius:0.875rem; flex-shrink:0;
                        display:flex; align-items:center; justify-content:center;
                        font-size:1.3rem;
                        background:linear-gradient(135deg,rgba(123,90,0,0.1),rgba(212,160,23,0.15));">
                🔍
            </div>
            <div>
                <p style="font-weight:700; color:#0F172A; font-size:1rem; margin:0;">
                    Track My Order
                </p>
                <p style="font-size:0.8rem; color:#B8860B; margin:0.1rem 0 0;">
                    Check your order status
                </p>
            </div>
            <svg style="width:1rem; height:1rem; color:#B8860B; margin-left:auto; flex-shrink:0;"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Mobile Action Buttons --}}
        <div style="display:flex; flex-direction:column; gap:0.7rem;
                    padding-top:0.875rem;
                    border-top:1px solid rgba(184,134,11,0.1);">

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}"
               style="display:flex; align-items:center; justify-content:center;
                      gap:0.5rem; padding:0.9rem; border-radius:0.875rem;
                      text-decoration:none; font-weight:600; font-size:1rem;
                      letter-spacing:0.01em;
                      background:rgba(184,134,11,0.08); color:#B8860B;
                      transition:all 0.2s;"
               onmouseover="this.style.background='rgba(184,134,11,0.13)'"
               onmouseout="this.style.background='rgba(184,134,11,0.08)'">
                🛒 Cart
                @if($cartCount > 0)
                    <span style="width:1.5rem; height:1.5rem; border-radius:9999px;
                                 display:flex; align-items:center; justify-content:center;
                                 font-size:0.7rem; font-weight:700; color:white;
                                 background:linear-gradient(135deg,#B8860B,#D4A017);
                                 box-shadow:0 2px 6px rgba(184,134,11,0.35);">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            {{-- Book Now --}}
            <a href="{{ route('contact') }}"
               style="display:flex; align-items:center; justify-content:center;
                      gap:0.5rem; padding:0.9rem; border-radius:0.875rem;
                      text-decoration:none; font-weight:700; font-size:1rem;
                      letter-spacing:0.015em; color:white;
                      background:linear-gradient(135deg,#7B5A00,#D4A017,#B8860B);
                      box-shadow:0 4px 18px rgba(184,134,11,0.32);
                      transition:all 0.2s;"
               onmouseover="this.style.boxShadow='0 6px 24px rgba(184,134,11,0.45)'"
               onmouseout="this.style.boxShadow='0 4px 18px rgba(184,134,11,0.32)'">
                📅 Book a Session
            </a>
        </div>
    </div>
</nav>