{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — PK Photography</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CDN v3 --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: { DEFAULT: '#B8860B', light: '#D4A017', dark: '#7B5A00' },
                        navy: { DEFAULT: '#0F172A', light: '#1E293B' },
                        brand: { bg: '#F8FAFC', text: '#0B1120' },
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'Georgia', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    {{-- Alpine.js CDN --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Same custom CSS styles --}}
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F1F5F9;
            -webkit-font-smoothing: antialiased;
        }
        .admin-sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            color: #D1D5DB;
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            text-decoration: none;
            width: 100%;
            border: none;
            background: none;
            cursor: pointer;
        }
        .admin-sidebar-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }
        .admin-sidebar-link.active {
            color: white;
            background: linear-gradient(135deg, rgba(123,90,0,0.4), rgba(212,160,23,0.3));
            border-left: 3px solid #D4A017;
        }
        .gold-text {
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .btn-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            box-shadow: 0 4px 15px rgba(184,134,11,0.3);
        }
        .btn-gold:hover {
            transform: scale(1.05);
            color: white;
        }
        .btn-outline-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            color: #B8860B;
            border: 2px solid #B8860B;
            background: transparent;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-outline-gold:hover {
            background: linear-gradient(135deg, #7B5A00, #D4A017);
            color: white;
            border-color: transparent;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb { background: #B8860B; border-radius: 3px; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); }
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>

    @stack('head')
</head>
<body x-data="{ sidebarOpen: false }">

<div class="flex h-screen overflow-hidden">

    {{-- ── SIDEBAR ── --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed lg:static inset-y-0 left-0 z-50 w-64 flex flex-col transition-transform duration-300"
           style="background: linear-gradient(180deg, #0B1120 0%, #0F172A 60%, #0B1120 100%);">

        {{-- Logo --}}
        <div class="flex items-center justify-center py-6 px-4"
             style="border-bottom: 1px solid rgba(184,134,11,0.2);">
            <x-logo class="h-14" />
        </div>

        {{-- Admin Badge --}}
        <div class="mx-4 mt-4 mb-2 px-3 py-2 rounded-xl text-center text-xs font-semibold tracking-widest uppercase"
             style="background: linear-gradient(135deg, rgba(123,90,0,0.3), rgba(212,160,23,0.2));
                    color: #D4A017;
                    border: 1px solid rgba(184,134,11,0.2);">
            ⚙️ Admin Panel
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">

            <a href="{{ route('admin.dashboard') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <div class="pt-3 pb-1 px-2">
                <p class="text-xs font-semibold uppercase tracking-widest"
                   style="color: rgba(212,160,23,0.5);">Content</p>
            </div>

            <a href="{{ route('admin.hero-images.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.hero-images*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Hero Images
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Gallery
            </a>

            <div class="pt-3 pb-1 px-2">
                <p class="text-xs font-semibold uppercase tracking-widest"
                   style="color: rgba(212,160,23,0.5);">E-Commerce</p>
            </div>

            <a href="{{ route('admin.categories.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Products
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Orders
                @php $pendingCount = \App\Models\Order::where('status','pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto text-xs px-2 py-0.5 rounded-full font-bold bg-red-500 text-white">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.uploads.index') }}"
               class="admin-sidebar-link {{ request()->routeIs('admin.uploads*') ? 'active' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                Customer Uploads
            </a>

            <div class="pt-3 pb-1 px-2">
                <p class="text-xs font-semibold uppercase tracking-widest"
                   style="color: rgba(212,160,23,0.5);">Account</p>
            </div>

            <a href="{{ route('home') }}" target="_blank" class="admin-sidebar-link">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Website
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="admin-sidebar-link text-red-400 hover:text-red-300">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>

        {{-- User Info --}}
        <div class="p-4" style="border-top: 1px solid rgba(184,134,11,0.2);">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-white text-sm"
                     style="background: linear-gradient(135deg, #7B5A00, #D4A017);">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-white text-sm font-semibold">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs" style="color: #B8860B;">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         class="fixed inset-0 z-40 bg-black/60 lg:hidden"></div>

    {{-- ── MAIN CONTENT ── --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- Top Bar --}}
        <header class="bg-white px-6 py-4 flex items-center justify-between"
                style="border-bottom: 1px solid #E5E7EB; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-xl font-bold text-navy"
                    style="font-family: 'Playfair Display', serif; color: #0F172A;">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-400 hidden md:block">
                    {{ now()->format('D, d M Y') }}
                </span>
            </div>
        </header>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show"
                 x-init="setTimeout(() => show = false, 4000)"
                 class="mx-6 mt-4 flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-medium"
                 style="background: #f0fdf4; border: 1px solid #86efac; color: #166534;">
                ✅ {{ session('success') }}
                <button @click="show = false" class="ml-auto font-bold">×</button>
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show"
                 x-init="setTimeout(() => show = false, 4000)"
                 class="mx-6 mt-4 flex items-center gap-3 px-5 py-3 rounded-xl text-sm font-medium"
                 style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;">
                ❌ {{ session('error') }}
                <button @click="show = false" class="ml-auto font-bold">×</button>
            </div>
        @endif

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>