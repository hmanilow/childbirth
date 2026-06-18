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
                'bg-section': '#F5F7F8',
                'bg-light':   '#EEF1F1',

                // Accent colors
                'accent': {
                    DEFAULT: '#9F3F58',
                    main:    '#9F3F58',
                    hover:   '#842F48',
                    light:   '#C96D78',
                    dark:    '#842F48',
                },
                'gold': {
                    DEFAULT: '#2F8F8A',
                    light:   '#67BFBA',
                    dark:    '#27666F',
                },
                'mint': {
                    DEFAULT: '#2F8F8A',
                    light:   '#67BFBA',
                    dark:    '#27666F',
                },
                'sky-soft': '#BFD4DA',
                'brand-blue': {
                    DEFAULT: '#2F8F8A',
                    light:   '#67BFBA',
                    dark:    '#27666F',
                },

                // Text
                'text-primary': '#343434',
                'text-heading': '#223241',
                'text-muted':   '#56616A',
                'text-subtle':  '#87919A',

                // Border
                'border-card':  '#67BFBA',
                'border-soft':  '#C4D4DA',
            },

            fontFamily: {
                heading: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
                body:    ['"Inter"', ...defaultTheme.fontFamily.sans],
                sans:    ['"Inter"', ...defaultTheme.fontFamily.sans],
            },

            fontSize: {
                'hero':    ['3.75rem', { lineHeight: '1.1' }],
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
                'card':   '0 18px 45px rgba(47, 143, 138, 0.13)',
                'card-hover': '0 22px 60px rgba(159, 63, 88, 0.18)',
                'glow':   '0 18px 45px rgba(132, 47, 72, 0.24)',
            },

            backgroundImage: {
                'gradient-accent': 'linear-gradient(135deg, #9F3F58 0%, #C96D78 100%)',
                'gradient-dark':   'linear-gradient(180deg, #FFFFFF 0%, #F5F7F8 100%)',
                'gradient-hero':   'linear-gradient(135deg, #FFFFFF 0%, #DED0D3 48%, #BFD4DA 100%)',
                'gradient-card':   'linear-gradient(135deg, #FFFFFF 0%, #EEF1F1 100%)',
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
