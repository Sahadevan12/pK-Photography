{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login — PK Photography</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN v3 --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            DEFAULT: '#B8860B',
                            light: '#D4A017',
                            dark: '#7B5A00',
                        },
                        navy: {
                            DEFAULT: '#0F172A',
                            light: '#1E293B',
                        },
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'Georgia', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                            '100%': { backgroundPosition: '0% 50%' },
                        },
                        spin: {
                            '0%': { transform: 'rotate(0deg)' },
                            '100%': { transform: 'rotate(360deg)' },
                        }
                    },
                    animation: {
                        float: 'float 3s ease-in-out infinite',
                        fadeInUp: 'fadeInUp 0.8s ease-out forwards',
                        shimmer: 'shimmer 3s ease infinite',
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js CDN --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ── Base ─────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background: linear-gradient(135deg, #0B1120 0%, #0F172A 50%, #0B1120 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* ── Background Glow Effects ──────── */
        .bg-glow-1 {
            position: absolute;
            top: 10%;
            right: 10%;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212,160,23,0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .bg-glow-2 {
            position: absolute;
            bottom: 10%;
            left: 10%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(184,134,11,0.06) 0%, transparent 70%);
            pointer-events: none;
        }

        .bg-glow-3 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(212,160,23,0.04) 0%, transparent 60%);
            pointer-events: none;
        }

        /* ── Floating Dots ────────────────── */
        .dot {
            position: absolute;
            border-radius: 50%;
            background: #D4A017;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(30px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes shimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ── Login Card ───────────────────── */
        .login-card {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(184, 134, 11, 0.25);
            border-radius: 1.5rem;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            animation: fadeInUp 0.7s ease-out forwards;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5),
                        0 0 0 1px rgba(184, 134, 11, 0.1),
                        inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }

        /* ── Gold Top Border on Card ──────── */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 10%;
            right: 10%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #D4A017, transparent);
            border-radius: 9999px;
        }

        /* ── Input Fields ─────────────────── */
        .login-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(184, 134, 11, 0.25);
            border-radius: 0.75rem;
            color: white;
            font-size: 0.875rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.2s ease;
        }

        .login-input::placeholder {
            color: rgba(156, 163, 175, 0.7);
        }

        .login-input:focus {
            border-color: #D4A017;
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(212, 160, 23, 0.15);
        }

        /* ── Submit Button ────────────────── */
        .btn-login {
            width: 100%;
            padding: 1rem;
            border-radius: 0.875rem;
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            background-size: 200% 200%;
            animation: shimmer 3s ease infinite;
            box-shadow: 0 4px 20px rgba(184, 134, 11, 0.4);
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 30px rgba(212, 160, 23, 0.5);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        /* ── Gold Text ────────────────────── */
        .gold-text {
            background: linear-gradient(135deg, #7B5A00, #D4A017, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Error Box ────────────────────── */
        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            color: #FCA5A5;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ── Credentials Hint ─────────────── */
        .hint-box {
            background: rgba(212, 160, 23, 0.06);
            border: 1px dashed rgba(212, 160, 23, 0.3);
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
            margin-top: 1.25rem;
        }

        /* ── Label ────────────────────────── */
        .login-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #9CA3AF;
            margin-bottom: 0.5rem;
            letter-spacing: 0.01em;
        }

        /* ── Divider ──────────────────────── */
        .gold-divider {
            width: 3rem;
            height: 3px;
            background: linear-gradient(90deg, #7B5A00, #D4A017, #B8860B);
            border-radius: 9999px;
            margin: 0.75rem auto 1.5rem;
        }

        /* ── Checkbox ─────────────────────── */
        .login-checkbox {
            width: 1rem;
            height: 1rem;
            border-radius: 0.25rem;
            accent-color: #B8860B;
            cursor: pointer;
        }

        /* ── Back Link ────────────────────── */
        .back-link {
            color: rgba(156, 163, 175, 0.7);
            font-size: 0.8125rem;
            text-decoration: none;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .back-link:hover {
            color: #D4A017;
        }

        /* ── Loading Spinner ──────────────── */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .spinner {
            width: 1.125rem;
            height: 1.125rem;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        /* ── Password Toggle ──────────────── */
        .pw-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(156, 163, 175, 0.7);
            transition: color 0.2s ease;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .pw-toggle:hover {
            color: #D4A017;
        }
    </style>
</head>

<body>

    {{-- Background Glows --}}
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>
    <div class="bg-glow-3"></div>

    {{-- Floating Dots --}}
    <div class="dot" style="width:8px;height:8px;top:15%;left:12%;opacity:0.3;animation:float 4s ease-in-out infinite;"></div>
    <div class="dot" style="width:5px;height:5px;top:70%;left:8%;opacity:0.2;animation:float 5s ease-in-out infinite 1s;"></div>
    <div class="dot" style="width:6px;height:6px;top:30%;right:15%;opacity:0.25;animation:float 3.5s ease-in-out infinite 0.5s;"></div>
    <div class="dot" style="width:4px;height:4px;top:80%;right:20%;opacity:0.2;animation:float 4.5s ease-in-out infinite 1.5s;"></div>
    <div class="dot" style="width:10px;height:10px;top:50%;left:5%;opacity:0.15;animation:float 6s ease-in-out infinite 2s;"></div>

    {{-- Login Card --}}
    <div class="login-card" x-data="{ showPassword: false, loading: false }">

        {{-- Logo SVG --}}
        <div class="text-center mb-6">
            <svg viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg"
                 class="mx-auto" style="width:160px; height:80px;" fill="none">
                <defs>
                    <linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%"   stop-color="#7B5A00"/>
                        <stop offset="50%"  stop-color="#D4A017"/>
                        <stop offset="100%" stop-color="#B8860B"/>
                    </linearGradient>
                    <linearGradient id="g2" x1="100%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%"   stop-color="#D4A017"/>
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
                <circle cx="80" cy="38" r="34" fill="none" stroke="url(#g1)" stroke-width="1" opacity="0.4"/>
                <text x="48" y="58" font-family="Playfair Display, Georgia, serif"
                      font-size="52" font-weight="700" font-style="italic"
                      fill="url(#g1)" filter="url(#glow)">p</text>
                <text x="78" y="55" font-family="Playfair Display, Georgia, serif"
                      font-size="48" font-weight="800"
                      fill="url(#g2)" filter="url(#glow)">K</text>
                <line x1="20" y1="68" x2="160" y2="68" stroke="url(#g1)" stroke-width="1.2" opacity="0.7"/>
                <text x="90" y="82" font-family="Playfair Display, Georgia, serif"
                      font-size="10" font-weight="600" letter-spacing="5"
                      fill="url(#g1)" text-anchor="middle">PHOTOGRAPHY</text>
                <text x="90" y="95" font-family="Georgia, serif"
                      font-size="5.5" letter-spacing="2"
                      fill="#B8860B" text-anchor="middle" opacity="0.85">EVERY PICTURE TELLS A STORY</text>
            </svg>
        </div>

        {{-- Title --}}
        <div class="text-center mb-6">
            <h1 class="text-white font-bold text-2xl mb-1"
                style="font-family: 'Playfair Display', serif;">
                Admin Login
            </h1>
            <div class="gold-divider"></div>
            <p class="text-gray-400 text-sm">
                Sign in to manage your studio
            </p>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="error-box">
                <span>❌</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="error-box">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}"
              @submit="loading = true">
            @csrf

            {{-- Email --}}
            <div class="mb-5">
                <label class="login-label">
                    📧 Email Address
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email', 'admin@pkphotography.com') }}"
                       required
                       autofocus
                       autocomplete="email"
                       class="login-input"
                       placeholder="admin@pkphotography.com"/>
                @error('email')
                    <p class="mt-1.5 text-xs" style="color: #FCA5A5;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label class="login-label">
                    🔒 Password
                </label>
                <div style="position: relative;">
                    <input :type="showPassword ? 'text' : 'password'"
                           name="password"
                           required
                           autocomplete="current-password"
                           class="login-input"
                           style="padding-right: 3rem;"
                           placeholder="••••••••"/>
                    <button type="button"
                            class="pw-toggle"
                            @click="showPassword = !showPassword">
                        {{-- Eye Open --}}
                        <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        {{-- Eye Closed --}}
                        <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs" style="color: #FCA5A5;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox"
                           name="remember"
                           class="login-checkbox"
                           {{ old('remember') ? 'checked' : '' }}/>
                    <span class="text-sm text-gray-400">Remember me</span>
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit" class="btn-login">
                <span class="spinner" :class="{ 'block': loading, 'hidden': !loading }"
                      style="display:none;" x-show="loading"></span>
                <span x-show="!loading">🔐 Sign In to Admin</span>
                <span x-show="loading" class="text-sm">Signing in...</span>
            </button>
        </form>

        {{-- Credentials Hint (Dev Only) --}}
        @if(config('app.debug'))
            <div class="hint-box">
                <p class="text-xs mb-2" style="color: rgba(212,160,23,0.6);">
                    🔑 Default Login Credentials
                </p>
                <p class="text-sm font-mono mb-1" style="color: #D4A017;">
                    admin@pkphotography.com
                </p>
                <p class="text-sm font-mono" style="color: #D4A017;">
                    admin@123
                </p>
            </div>
        @endif

        {{-- Back Link --}}
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="back-link">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Website
            </a>
        </div>
    </div>

    {{-- Bottom tagline --}}
    <div style="position: fixed; bottom: 1.5rem; left: 0; right: 0; text-align: center;">
        <p style="color: rgba(184,134,11,0.4); font-size: 0.75rem; letter-spacing: 0.15em; font-style: italic;">
            "Every Picture Tells A Story"
        </p>
    </div>

</body>
</html>