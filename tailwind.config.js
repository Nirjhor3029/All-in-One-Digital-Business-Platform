import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary:       { DEFAULT: '#000000', light: '#333333' },
                'on-primary':  '#ffffff',
                accent:        { DEFAULT: '#000000', hover: '#333333', light: '#f5f3f3' },
                highlight:     '#000000',
                success:       '#10B981',
                danger:        '#ba1a1a',
                warning:       '#F59E0B',
                muted:         '#5d5f5f',
                secondary:     { DEFAULT: '#5d5f5f', hover: '#333333' },
                'on-secondary': '#ffffff',

                surface:        '#fbf9f9',
                'on-surface':   '#1b1c1c',
                background:     '#fbf9f9',
                'on-background': '#1b1c1c',
                'surface-dim':  '#dbdad9',
                'surface-bright': '#fbf9f9',
                'surface-container-lowest': '#ffffff',
                'surface-container-low':    '#f5f3f3',
                'surface-container':        '#efeded',
                'surface-container-high':   '#e9e8e7',
                'surface-container-highest': '#e3e2e2',
                'surface-variant': '#e3e2e2',
                'on-surface-variant': '#4c4546',
                'outline': '#7e7576',
                'outline-variant': '#cfc4c5',
                'tertiary-container': '#1a1c1c',
                'on-tertiary-container': '#838484',
                'surface-tint': '#5e5e5e',
                'inverse-surface': '#303031',
                'inverse-on-surface': '#f2f0f0',
                'inverse-primary': '#c6c6c6',
            },
            fontFamily: {
                sans:    ['Inter', 'Hind Siliguri', 'Noto Sans Bengali', ...defaultTheme.fontFamily.sans],
                display: ['Inter', 'Hind Siliguri', 'Noto Sans Bengali', 'sans-serif'],
                mono:    ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
                'headline-xl': ['Noto Sans Bengali', 'Inter', 'sans-serif'],
                'headline-lg': ['Noto Sans Bengali', 'Inter', 'sans-serif'],
                'headline-md': ['Noto Sans Bengali', 'Inter', 'sans-serif'],
                'body-lg':     ['Inter', 'Noto Sans Bengali', 'sans-serif'],
                'body-md':     ['Inter', 'Noto Sans Bengali', 'sans-serif'],
                'label-sm':    ['Inter', 'sans-serif'],
            },
            fontSize: {
                'headline-xl':       ['64px', { lineHeight: '1.1', letterSpacing: '-0.04em', fontWeight: '700' }],
                'headline-xl-mobile': ['40px', { lineHeight: '1.2', letterSpacing: '-0.02em', fontWeight: '700' }],
                'headline-lg':       ['32px', { lineHeight: '1.3', letterSpacing: '-0.02em', fontWeight: '600' }],
                'headline-md':       ['24px', { lineHeight: '1.4', fontWeight: '600' }],
                'body-lg':           ['18px', { lineHeight: '1.6', fontWeight: '400' }],
                'body-md':           ['16px', { lineHeight: '1.6', fontWeight: '400' }],
                'label-sm':          ['12px', { lineHeight: '1', letterSpacing: '0.05em', fontWeight: '600' }],
            },
            spacing: {
                'margin-mobile': '24px',
                'margin-desktop': '64px',
                'container-max': '1280px',
                'gutter': '24px',
                'section-gap': '120px',
                'unit': '8px',
            },
            boxShadow: {
                card: '0 1px 2px rgba(0,0,0,0.04)',
                'card-hover': '0 1px 4px rgba(0,0,0,0.08)',
            },
            borderRadius: {
                DEFAULT: '0.25rem',
                btn:  '0.25rem',
                card: '0.5rem',
                lg:   '0.375rem',
                xl:   '0.5rem',
                '2xl': '0.75rem',
            },
        },
    },

    plugins: [forms, typography],
};
