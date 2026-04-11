{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PK Photography') — Every Picture Tells A Story</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- ✅ Tailwind CSS CDN v3 --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- ✅ Tailwind Config via CDN --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            DEFAULT: '#B8860B',
                            light:   '#D4A017',
                            dark:    '#7B5A00',
                        },
                        navy: {
                            DEFAULT: '#0F172A',
                            light:   '#1E293B',
                        },
                        brand: {
                            bg:   '#F8FAFC',
                            text: '#0B1120',
                        },
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'Georgia', 'serif'],
                        sans:  ['Inter', 'sans-serif'],
                    },
                    keyframes: {
                        shimmer: {
                            '0%':   { backgroundPosition: '0% 50%'   },
                            '50%':  { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%'   },
                        },
                        fadeInUp: {
                            '0%':   { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)'    },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)'   },
                            '50%':      { transform: 'translateY(-10px)' },
                        },
                    },
                    animation: {
                        shimmer:  'shimmer 3s ease infinite',
                        fadeInUp: 'fadeInUp 0.8s ease-out forwards',
                        float:    'float 3s ease-in-out infinite',
                    },
                }
            }
        }
    </script>

    {{-- ✅ Alpine.js CDN --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ✅ Three.js CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    {{-- ✅ All Custom CSS --}}
    <style>
        /* ── Base ─────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            background-color: #F8FAFC;
            color: #0B1120;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Gold Gradient Button ─────────────── */
        .btn-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.875rem;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            background-size: 200% 200%;
            box-shadow: 0 4px 20px rgba(184, 134, 11, 0.35);
        }
        .btn-gold:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(212, 160, 23, 0.5);
            color: white;
        }
        .btn-gold:active { transform: scale(0.97); }

        /* ── Outline Gold Button ──────────────── */
        .btn-outline-gold {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 2rem;
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
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(184, 134, 11, 0.3);
        }

        /* ── Gold Text ────────────────────────── */
        .gold-text {
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Gold Divider ─────────────────────── */
        .gold-divider {
            width: 6rem;
            height: 4px;
            margin: 1rem auto;
            border-radius: 9999px;
            background: linear-gradient(90deg, #7B5A00, #D4A017, #B8860B);
        }

        /* ── Section Title ────────────────────── */
        .section-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: #6B7280;
            max-width: 42rem;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.75;
        }

        /* ── Card Hover ───────────────────────── */
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* ── Admin Sidebar ────────────────────── */
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

        /* ── Filter Button ────────────────────── */
        .filter-btn {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 2px solid #E5E7EB;
            color: #6B7280;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            background: white;
        }
        .filter-btn:hover {
            border-color: #B8860B;
            color: #B8860B;
        }
        .filter-btn.active {
            background: linear-gradient(135deg, #7B5A00, #D4A017) !important;
            color: white !important;
            border-color: transparent !important;
        }

        /* ── Input Gold ───────────────────────── */
        .input-gold {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 2px solid #E5E7EB;
            font-size: 0.875rem;
            outline: none;
            transition: all 0.2s ease;
            background: white;
            color: #0B1120;
        }
        .input-gold:focus {
            border-color: #B8860B;
            box-shadow: 0 0 0 3px rgba(184, 134, 11, 0.15);
        }

        /* ── Animations ───────────────────────── */
        @keyframes shimmer {
            0%   { background-position: 0% 50%;   }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%;   }
        }
        @keyframes fadeInUp {
            0%   { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0);    }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px);   }
            50%      { transform: translateY(-10px); }
        }
        .animate-shimmer  { animation: shimmer  3s ease infinite;         }
        .animate-fadeInUp { animation: fadeInUp 0.8s ease-out forwards;   }
        .animate-float    { animation: float    3s ease-in-out infinite;  }

        /* ── Scrollbar ────────────────────────── */
        ::-webkit-scrollbar       { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #F8FAFC;     }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(#B8860B, #D4A017);
            border-radius: 3px;
        }

        /* ── Line Clamp ───────────────────────── */
        .line-clamp-1,
        .line-clamp-2,
        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
        .line-clamp-1 { -webkit-line-clamp: 1; }
        .line-clamp-2 { -webkit-line-clamp: 2; }
        .line-clamp-3 { -webkit-line-clamp: 3; }

        /* ── Scrollbar thin ───────────────────── */
        .scrollbar-thin { scrollbar-width: thin; }

        /* ── No underline utility ─────────────── */
        .no-underline { text-decoration: none; }
    </style>

    @stack('head')
</head>

<body class="antialiased">

    {{-- Navbar --}}
    <x-navbar />

    {{-- ✅ Flash: Success --}}
    @if(session('success'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-24 right-4 z-[100] max-w-sm w-full">
            <div class="flex items-center gap-3 px-5 py-4 rounded-2xl text-white text-sm shadow-2xl"
                 style="background: linear-gradient(135deg, #0F172A, #1E293B);
                        border: 1px solid rgba(184,134,11,0.4);">
                <span>✅</span>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-auto opacity-70 hover:opacity-100 text-lg">×</button>
            </div>
        </div>
    @endif

    {{-- ✅ Flash: Error --}}
    @if(session('error'))
        <div x-data="{ show: true }"
             x-show="show"
             x-init="setTimeout(() => show = false, 4000)"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed top-24 right-4 z-[100] max-w-sm w-full">
            <div class="flex items-center gap-3 px-5 py-4 rounded-2xl text-white text-sm shadow-2xl"
                 style="background: #7f1d1d; border: 1px solid rgba(239,68,68,0.4);">
                <span>❌</span>
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="ml-auto opacity-70 hover:opacity-100 text-lg">×</button>
            </div>
        </div>
    @endif

    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- ✅ Floating WhatsApp Button --}}
    <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '919994141294') }}"
       target="_blank"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full flex items-center justify-center shadow-2xl transition-all duration-300 hover:scale-110 animate-float"
       style="background: linear-gradient(135deg, #25D366, #128C7E);
              box-shadow: 0 8px 25px rgba(37,211,102,0.4);"
       title="Chat on WhatsApp">
        <svg class="w-7 h-7 fill-white" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z M12 0C5.374 0 0 5.373 0 12c0 2.917 1.04 5.59 2.747 7.676L.947 23.999l4.42-1.778A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/>
        </svg>
    </a>

    @stack('scripts')
</body>
</html>