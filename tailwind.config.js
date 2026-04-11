// tailwind.config.js
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
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
                shimmer:   'shimmer 3s ease infinite',
                fadeInUp:  'fadeInUp 0.8s ease-out forwards',
                float:     'float 3s ease-in-out infinite',
            },
        },
    },
    plugins: [],
};