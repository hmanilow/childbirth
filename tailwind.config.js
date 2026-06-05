import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Filament/**/*.php',
        './app/Http/Livewire/**/*.php',
    ],

    theme: {
        extend: {
            colors: {
                // Base backgrounds
                'bg-base':    '#FFFFFF',
                'bg-card':    '#FFFFFF',
                'bg-section': '#F8F9FA',
                'bg-light':   '#F8F9FA',

                // Accent colors
                'accent': {
                    DEFAULT: '#E05A7C',
                    main:    '#E05A7C',
                    hover:   '#E73F6C',
                    light:   '#FF7A9E',
                    dark:    '#E73F6C',
                },
                'gold': {
                    DEFAULT: '#4EC9D9',
                    light:   '#7ED9E6',
                    dark:    '#2C3E50',
                },
                'mint': {
                    DEFAULT: '#4EC9D9',
                    light:   '#7ED9E6',
                    dark:    '#2C3E50',
                },
                'sky-soft': '#7ED9E6',
                'brand-blue': {
                    DEFAULT: '#4EC9D9',
                    light:   '#7ED9E6',
                    dark:    '#2C3E50',
                },

                // Text
                'text-primary': '#333333',
                'text-heading': '#2C3E50',
                'text-muted':   '#5F6872',
                'text-subtle':  '#8A949E',

                // Border
                'border-card':  '#7ED9E6',
                'border-soft':  '#E2EDF2',
            },

            fontFamily: {
                heading: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                body:    ['"Inter"', ...defaultTheme.fontFamily.sans],
                sans:    ['"Inter"', ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                'hero':    ['clamp(2.5rem, 5vw, 3.75rem)', { lineHeight: '1.1' }],
                'section': ['clamp(1.8rem, 3vw, 2.5rem)',  { lineHeight: '1.2' }],
                'card':    ['clamp(1.1rem, 2vw, 1.375rem)', { lineHeight: '1.3' }],
            },

            spacing: {
                'section': '7rem',
                'section-sm': '4rem',
            },

            borderRadius: {
                'card': '10px',
                'btn':  '8px',
            },

            boxShadow: {
                'card':   '0 18px 45px rgba(78, 201, 217, 0.14)',
                'card-hover': '0 22px 60px rgba(224, 90, 124, 0.18)',
                'glow':   '0 18px 45px rgba(231, 63, 108, 0.24)',
            },

            backgroundImage: {
                'gradient-accent': 'linear-gradient(135deg, #E05A7C 0%, #FF7A9E 100%)',
                'gradient-dark':   'linear-gradient(180deg, #FFFFFF 0%, #F8F9FA 100%)',
                'gradient-hero':   'linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 48%, #EAFBFD 100%)',
                'gradient-card':   'linear-gradient(135deg, #FFFFFF 0%, #F8F9FA 100%)',
            },

            animation: {
                'fade-up':   'fadeUp 0.6s ease-out forwards',
                'fade-in':   'fadeIn 0.4s ease-out forwards',
                'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
            },

            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '1' },
                    '50%':      { opacity: '0.7' },
                },
            },
        },
    },

    plugins: [forms, typography],
};
