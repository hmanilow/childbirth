import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

const themeColor = (name) => `rgb(var(--color-${name}-rgb) / <alpha-value>)`;

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
                'bg-base':    themeColor('bg-main'),
                'bg-card':    themeColor('card'),
                'bg-section': themeColor('bg-soft'),
                'bg-light':   themeColor('card-muted'),
                'bg-muted':   themeColor('bg-muted'),
                'bg-cool':    themeColor('bg-cool'),

                // Accent colors
                'accent': {
                    DEFAULT: themeColor('primary'),
                    main:    themeColor('primary'),
                    hover:   themeColor('primary-hover'),
                    light:   themeColor('primary-soft'),
                    dark:    themeColor('primary-hover'),
                },
                'gold': {
                    DEFAULT: themeColor('secondary'),
                    light:   themeColor('secondary-soft'),
                    dark:    themeColor('secondary-dark'),
                },
                'mint': {
                    DEFAULT: themeColor('secondary'),
                    light:   themeColor('secondary-soft'),
                    dark:    themeColor('secondary-dark'),
                },
                'sky-soft': themeColor('bg-cool'),
                'brand-blue': {
                    DEFAULT: themeColor('secondary'),
                    light:   themeColor('secondary-soft'),
                    dark:    themeColor('secondary-dark'),
                },

                // Text
                'text-primary': themeColor('text-main'),
                'text-heading': themeColor('text-main'),
                'text-muted':   themeColor('text-muted'),
                'text-subtle':  themeColor('text-soft'),

                // Border
                'border-card':  themeColor('secondary'),
                'border-soft':  themeColor('border'),
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
                'card':   '0 18px 50px rgba(var(--color-shadow-rgb), 0.14)',
                'card-hover': '0 22px 60px rgba(var(--color-shadow-rgb), 0.2)',
                'glow':   '0 16px 38px rgba(var(--color-primary-rgb), 0.24)',
            },

            backgroundImage: {
                'gradient-accent': 'linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-soft) 100%)',
                'gradient-dark':   'linear-gradient(180deg, var(--color-card) 0%, var(--color-card-muted) 100%)',
                'gradient-hero':   'linear-gradient(135deg, var(--color-bg-main) 0%, var(--color-bg-soft) 52%, var(--color-bg-cool) 100%)',
                'gradient-card':   'linear-gradient(135deg, var(--color-card) 0%, var(--color-card-muted) 100%)',
                'gradient-card-muted': 'linear-gradient(135deg, var(--color-card) 0%, var(--color-card-muted) 52%, var(--color-secondary-soft) 100%)',
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
