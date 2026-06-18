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
                'bg-section': '#F6F8F9',
                'bg-light':   '#F4F7F8',

                // Accent colors
                'accent': {
                    DEFAULT: '#A93656',
                    main:    '#A93656',
                    hover:   '#96304C',
                    light:   '#C95A73',
                    dark:    '#7F2A42',
                },
                'gold': {
                    DEFAULT: '#247F8A',
                    light:   '#58BAC5',
                    dark:    '#1F4A57',
                },
                'mint': {
                    DEFAULT: '#247F8A',
                    light:   '#58BAC5',
                    dark:    '#1F4A57',
                },
                'sky-soft': '#58BAC5',
                'brand-blue': {
                    DEFAULT: '#247F8A',
                    light:   '#58BAC5',
                    dark:    '#1F4A57',
                },

                // Text
                'text-primary': '#333333',
                'text-heading': '#233445',
                'text-muted':   '#4F5963',
                'text-subtle':  '#8A949E',

                // Border
                'border-card':  '#58BAC5',
                'border-soft':  '#C8D9DF',
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
                'card':   '0 18px 45px rgba(36, 127, 138, 0.13)',
                'card-hover': '0 22px 60px rgba(169, 54, 86, 0.18)',
                'glow':   '0 18px 45px rgba(150, 48, 76, 0.24)',
            },

            backgroundImage: {
                'gradient-accent': 'linear-gradient(135deg, #A93656 0%, #C95A73 100%)',
                'gradient-dark':   'linear-gradient(180deg, #FFFFFF 0%, #F6F8F9 100%)',
                'gradient-hero':   'linear-gradient(135deg, #FFFFFF 0%, #F4E3E8 48%, #D9EDF0 100%)',
                'gradient-card':   'linear-gradient(135deg, #FFFFFF 0%, #F6F8F9 100%)',
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
