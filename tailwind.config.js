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
                primary:   { DEFAULT: '#0F172A', light: '#1E293B' },
                accent:    { DEFAULT: '#6366F1', hover: '#4F46E5', light: '#EEF2FF' },
                highlight: { DEFAULT: '#F59E0B' },
                success:   '#10B981',
                danger:    '#EF4444',
                warning:   '#F59E0B',
                muted:     '#64748B',
                surface:   '#F8FAFC',
            },
            fontFamily: {
                sans:    ['Inter', 'Hind Siliguri', ...defaultTheme.fontFamily.sans],
                display: ['Syne', 'sans-serif'],
                mono:    ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },
            boxShadow: {
                card: '0 4px 24px rgba(0,0,0,0.08)',
                'card-hover': '0 12px 40px rgba(0,0,0,0.14)',
            },
            borderRadius: {
                card: '12px',
                btn:  '8px',
            },
        },
    },

    plugins: [forms, typography],
};
