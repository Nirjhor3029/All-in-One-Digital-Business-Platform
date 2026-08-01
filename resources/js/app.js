import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav');
    if (nav) {
        window.addEventListener('scroll', () => {
            nav.classList.toggle('shadow-sm', window.scrollY > 50);
        });
    }
});
